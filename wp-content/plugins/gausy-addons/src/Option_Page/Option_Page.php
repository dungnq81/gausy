<?php

namespace Addons\Option_Page;

use Addons\Base\Singleton;

use Addons\Base_Slug\Base_Slug;
use Addons\Custom_Sorting\Custom_Sorting;
use Addons\Optimizer\Browser_Cache;
use Addons\Optimizer\Gzip;
use Addons\Optimizer\Ssl;
use Addons\Security\Dir;
use Addons\Security\Headers;
use Addons\Security\Opml;
use Addons\Security\Readme;
use Addons\Security\Xmlrpc;

\defined( 'ABSPATH' ) || die;

final class Option_Page {

	use Singleton;

	/** ----------------------------------------------- */

	/**
	 * @return void
	 */
	private function init(): void {

		add_action( 'admin_menu', [ &$this, 'admin_menu' ] );
		add_filter( 'menu_order', [ &$this, 'options_reorder_submenu' ] );
		add_filter( 'custom_menu_order', '__return_true' );

		// ajax for settings
		add_action( 'wp_ajax_submit_settings', [ &$this, 'ajax_submit_settings' ] );
	}

	/** ----------------------------------------------- */

	/**
	 * @return void
	 */
	public function admin_menu(): void {
		$menu_setting = add_menu_page(
			__( 'Gausy Settings', ADDONS_TEXT_DOMAIN ),
			__( 'Gausy', ADDONS_TEXT_DOMAIN ),
			'manage_options',
			'gausy-settings',
			[ &$this, '_gausy_menu_callback' ],
			'dashicons-admin-settings',
			80
		);

		$submenu_customize = add_submenu_page(
			'gausy-settings',
			__( 'Advanced', ADDONS_TEXT_DOMAIN ),
			__( 'Advanced', ADDONS_TEXT_DOMAIN ),
			'manage_options',
			'customize.php'
		);

		$submenu_log = add_submenu_page(
			'gausy-settings',
			__( 'Server Info', ADDONS_TEXT_DOMAIN ),
			__( 'Server Info', ADDONS_TEXT_DOMAIN ),
			'manage_options',
			'server-info',
			[ &$this, '_gausy_server_info_callback', ]
		);

		$submenu_info = add_submenu_page(
			'gausy-settings',
			__( 'Activity Log', ADDONS_TEXT_DOMAIN ),
			__( 'Activity Log', ADDONS_TEXT_DOMAIN ),
			'manage_options',
			'activity-log',
			[ &$this, '_gausy_activity_log_callback', ]
		);
	}

	/** ----------------------------------------------- */

	/**
	 * Reorder the submenu pages.
	 *
	 * @param array $menu_order The WP menu order.
	 */
	public function options_reorder_submenu( array $menu_order ): array {

		// Load the global submenu.
		global $submenu;

		if ( empty( $submenu['gausy-settings'] ) ) {
			return $menu_order;
		}

		// Change menu title
		$submenu['gausy-settings'][0][0] = __( 'Settings', ADDONS_TEXT_DOMAIN );

		return $menu_order;
	}

	/** ----------------------------------------------- */

	/**
	 * @return false|void
	 */
	public function ajax_submit_settings() {
		if ( ! wp_doing_ajax() ) {
			return false;
		}

		check_ajax_referer( '_wpnonce_settings_form_' . get_current_user_id() );
		$data = $_POST['_data'] ?? [];

		/** ---------------------------------------- */

		/** Aspect Ratio */
		$aspect_ratio_options        = [];
		$aspect_ratio_post_type_term = gausy_theme_setting_filters( 'aspect_ratio_post_type_term', [] );

		foreach ( $aspect_ratio_post_type_term as $ar ) {

			if ( isset( $data[ $ar . '-width' ], $data[ $ar . '-height' ] ) ) {
				$aspect_ratio_options[ 'ar-' . $ar . '-width' ]  = sanitize_text_field( $data[ $ar . '-width' ] );
				$aspect_ratio_options[ 'ar-' . $ar . '-height' ] = sanitize_text_field( $data[ $ar . '-height' ] );
			}
		}

		update_option( 'aspect_ratio__options', $aspect_ratio_options );

		/** ---------------------------------------- */

		/** SMTP Settings */
		if ( gausy_check_smtp_plugin_active() ) {
			$smtp_host     = ! empty( $data['smtp_host'] ) ? sanitize_text_field( $data['smtp_host'] ) : '';
			$smtp_auth     = ! empty( $data['smtp_auth'] ) ? sanitize_text_field( $data['smtp_auth'] ) : '';
			$smtp_username = ! empty( $data['smtp_username'] ) ? sanitize_text_field( $data['smtp_username'] ) : '';

			if ( ! empty( $data['smtp_password'] ) ) {

				// This removes slash (automatically added by WordPress) from the password when apostrophe is present
				$smtp_password = base64_encode( wp_unslash( trim( $data['smtp_password'] ) ) );
			}

			$smtp_encryption               = ! empty( $data['smtp_encryption'] ) ? sanitize_text_field( $data['smtp_encryption'] ) : '';
			$smtp_port                     = ! empty( $data['smtp_port'] ) ? sanitize_text_field( $data['smtp_port'] ) : '';
			$smtp_from_email               = ! empty( $data['smtp_from_email'] ) ? sanitize_email( $data['smtp_from_email'] ) : '';
			$smtp_from_name                = ! empty( $data['smtp_from_name'] ) ? sanitize_text_field( $data['smtp_from_name'] ) : '';
			$smtp_force_from_address       = ! empty( $data['smtp_force_from_address'] ) ? sanitize_text_field( $data['smtp_force_from_address'] ) : '';
			$smtp_disable_ssl_verification = ! empty( $data['smtp_disable_ssl_verification'] ) ? sanitize_text_field( $data['smtp_disable_ssl_verification'] ) : '';

			$smtp_options = [
				'smtp_host'                     => $smtp_host,
				'smtp_auth'                     => $smtp_auth,
				'smtp_username'                 => $smtp_username,
				'smtp_encryption'               => $smtp_encryption,
				'smtp_port'                     => $smtp_port,
				'smtp_from_email'               => $smtp_from_email,
				'smtp_from_name'                => $smtp_from_name,
				'smtp_force_from_address'       => $smtp_force_from_address,
				'smtp_disable_ssl_verification' => $smtp_disable_ssl_verification,
			];

			if ( ! empty( $smtp_password ) ) {
				$smtp_options['smtp_password'] = $smtp_password;
			}

			update_option( 'smtp__options', $smtp_options );
		}

		/** ---------------------------------------- */

		/** Optimizer */
		$optimizer_options_current = get_option( 'optimizer__options' );
		$https_enforce_current     = $optimizer_options_current['https_enforce'] ?? 0;

		$dns_prefetch     = ! empty( $data['dns_prefetch'] ) ? gausy_explode_multi( [ ',', ' ', PHP_EOL ], $data['dns_prefetch'] ) : [];
		$dns_prefetch     = array_map( 'sanitize_url', $dns_prefetch );

		$optimizer_options = [
			'https_enforce'          => ! empty( $data['https_enforce'] ) ? sanitize_text_field( $data['https_enforce'] ) : 0,
			'gzip'                   => ! empty( $data['gzip'] ) ? sanitize_text_field( $data['gzip'] ) : 0,
			'browser_caching'        => ! empty( $data['browser_caching'] ) ? sanitize_text_field( $data['browser_caching'] ) : 0,
			'heartbeat'              => ! empty( $data['heartbeat'] ) ? sanitize_text_field( $data['heartbeat'] ) : 0,
			'minify_html'            => ! empty( $data['minify_html'] ) ? sanitize_text_field( $data['minify_html'] ) : 0,
			'svgs'                   => ! empty( $data['svgs'] ) ? sanitize_text_field( $data['svgs'] ) : 'disable',
			'dns_prefetch'           => $dns_prefetch,
			'attached_media_cleaner' => ! empty( $data['attached_media_cleaner'] ) ? sanitize_text_field( $data['attached_media_cleaner'] ) : 0,
		];

		update_option( 'optimizer__options', $optimizer_options );

		// Ssl
		if ( $https_enforce_current !== $optimizer_options['https_enforce'] ) {
			( new Ssl() )->toggle_rules( $optimizer_options['https_enforce'] );
		}

		// Gzip + Caching
		( new Gzip() )->toggle_rules( $optimizer_options['gzip'] );
		( new Browser_Cache() )->toggle_rules( $optimizer_options['browser_caching'] );

		/** ---------------------------------------- */

		/** Security */
		$security_options = [
			'hide_wp_version'         => ! empty( $data['hide_wp_version'] ) ? sanitize_text_field( $data['hide_wp_version'] ) : '',
			'xml_rpc_off'             => ! empty( $data['xml_rpc_off'] ) ? sanitize_text_field( $data['xml_rpc_off'] ) : '',
			'wp_links_opml_off'       => ! empty( $data['wp_links_opml_off'] ) ? sanitize_text_field( $data['wp_links_opml_off'] ) : '',
			'remove_readme'           => ! empty( $data['remove_readme'] ) ? sanitize_text_field( $data['remove_readme'] ) : '',
			'rss_feed_off'            => ! empty( $data['rss_feed_off'] ) ? sanitize_text_field( $data['rss_feed_off'] ) : '',
			'lock_protect_system'     => ! empty( $data['lock_protect_system'] ) ? sanitize_text_field( $data['lock_protect_system'] ) : '',
			'advanced_xss_protection' => ! empty( $data['advanced_xss_protection'] ) ? sanitize_text_field( $data['advanced_xss_protection'] ) : '',
		];

		update_option( 'security__options', $security_options );

		// readme.html
		if ( $security_options['remove_readme'] ) {
			( new Readme() )->delete_readme();
		}

		( new Xmlrpc() )->toggle_rules( $security_options['xml_rpc_off'] );
		( new Opml() )->toggle_rules( $security_options['wp_links_opml_off'] );
		( new Dir() )->toggle_rules( $security_options['lock_protect_system'] );
		( new Headers() )->toggle_rules( $security_options['advanced_xss_protection'] );

		/** ---------------------------------------- */

		/** Login Security */
		$login_ips_access = ! empty( $data['login_ips_access'] ) ? $data['login_ips_access'] : '';
		$login_ips_access = is_array( $login_ips_access ) ? array_map( 'sanitize_text_field', $login_ips_access ) : sanitize_text_field( $login_ips_access );

		$disable_ips_access = ! empty( $data['disable_ips_access'] ) ? $data['disable_ips_access'] : '';
		$disable_ips_access = is_array( $disable_ips_access ) ? array_map( 'sanitize_text_field', $disable_ips_access ) : sanitize_text_field( $disable_ips_access );

		$login_security__options = [
			'custom_login_uri'          => ! empty( $data['custom_login_uri'] ) ? sanitize_text_field( $data['custom_login_uri'] ) : '',
			'illegal_users'             => ! empty( $data['illegal_users'] ) ? sanitize_text_field( $data['illegal_users'] ) : '',
			'login_ips_access'          => $login_ips_access,
			'disable_ips_access'        => $disable_ips_access,
			'limit_login_attempts'      => ! empty( $data['limit_login_attempts'] ) ? sanitize_text_field( $data['limit_login_attempts'] ) : '0',
			'two_factor_authentication' => ! empty( $data['two_factor_authentication'] ) ? sanitize_text_field( $data['two_factor_authentication'] ) : '',
		];

		update_option( 'login_security__options', $login_security__options );

		/** ---------------------------------------- */

		/** Social */
		$social_options = [];
		foreach ( gausy_theme_setting_filters( 'social_follows_links', [] ) as $i => $item ) {
			$social_options[ $i ] = [
				'url' => ! empty( $data[ $i . '-option' ] ) ? sanitize_url( $data[ $i . '-option' ] ) : '',
			];
		}

		update_option( 'social__options', $social_options );

		/** ---------------------------------------- */

		/** Remove base slug */
		$base_slug_reset = ! empty( $data['base_slug_reset'] ) ? sanitize_text_field( $data['base_slug_reset'] ) : '';
		if ( empty( $base_slug_reset ) ) {
			$custom_base_slug_options = [
				'base_slug_post_type' => ! empty( $data['base_slug_post_type'] ) ? array_map( 'sanitize_text_field', $data['base_slug_post_type'] ) : [],
				'base_slug_taxonomy'  => ! empty( $data['base_slug_taxonomy'] ) ? array_map( 'sanitize_text_field', $data['base_slug_taxonomy'] ) : [],
			];

			update_option( 'base_slug__options', $custom_base_slug_options );

			( Base_Slug::get_instance() )->flush_rules();

		} else {
			( Base_Slug::get_instance() )->reset_all();
		}

		/** ---------------------------------------- */

		/** Custom Email */
		$email_options = [];
		$custom_emails = gausy_theme_setting_filters( 'custom_emails', [] );

		if ( $custom_emails ) {
			foreach ( $custom_emails as $i => $ar ) {

				$email = ! empty( $data[ $i . '_email' ] ) ? $data[ $i . '_email' ] : '';
				$email = is_array( $email ) ? array_map( 'sanitize_text_field', $email ) : sanitize_text_field( $email );

				$email_options[ $i ] = $email;
			}

			update_option( 'custom_email__options', $email_options );
		}

		/** ---------------------------------------- */

		/** Custom Sorting */
		$order_reset = ! empty( $data['order_reset'] ) ? sanitize_text_field( $data['order_reset'] ) : '';
		if ( empty( $order_reset ) ) {
			$custom_order_options = [
				'order_post_type' => ! empty( $data['order_post_type'] ) ? array_map( 'sanitize_text_field', $data['order_post_type'] ) : [],
				'order_taxonomy'  => ! empty( $data['order_taxonomy'] ) ? array_map( 'sanitize_text_field', $data['order_taxonomy'] ) : [],
			];

			update_option( 'custom_sorting__options', $custom_order_options );

			( Custom_Sorting::get_instance() )->update_options();

		} else {
			( Custom_Sorting::get_instance() )->reset_all();
		}

		/** ---------------------------------------- */

        /** WooCommerce */
		if ( gausy_check_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			$woocommerce_options = [
				'remove_legacy_coupon'    => ! empty( $data['remove_legacy_coupon'] ) ? sanitize_text_field( $data['remove_legacy_coupon'] ) : '',
				'woocommerce_jsonld'      => ! empty( $data['woocommerce_jsonld'] ) ? sanitize_text_field( $data['woocommerce_jsonld'] ) : '',
				'woocommerce_default_css' => ! empty( $data['woocommerce_default_css'] ) ? sanitize_text_field( $data['woocommerce_default_css'] ) : '',
			];

			update_option( 'woocommerce__options', $woocommerce_options );

			if ( $woocommerce_options['remove_legacy_coupon'] ) {
				global $wpdb;

				$wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "wc_admin_notes SET status=%s WHERE name=%s", 'actioned', 'wc-admin-coupon-page-moved' ) );
				$wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "wc_admin_note_actions SET status=%s WHERE name=%s", 'actioned', 'remove-legacy-coupon-menu' ) );
			}
		}

		/** ---------------------------------------- */

		/** Custom Scripts */
		$html_header      = $data['html_header'] ?? '';
		$html_footer      = $data['html_footer'] ?? '';
		$html_body_top    = $data['html_body_top'] ?? '';
		$html_body_bottom = $data['html_body_bottom'] ?? '';

		$_header      = \gausy_update_custom_post_option( $html_header, 'html_header', 'text/html', true );
		$_footer      = \gausy_update_custom_post_option( $html_footer, 'html_footer', 'text/html', true );
		$_body_top    = \gausy_update_custom_post_option( $html_body_top, 'html_body_top', 'text/html', true );
		$_body_bottom = \gausy_update_custom_post_option( $html_body_bottom, 'html_body_bottom', 'text/html', true );

		/** ---------------------------------------- */

        /** Custom CSS */
		$html_custom_css = $data['html_custom_css'] ?? '';
		$_css = \gausy_update_custom_post_option( $html_custom_css, 'gausy_css', 'text/css' );

		/** ---------------------------------------- */

		gausy_clear_all_cache();
		gausy_message_success( __( 'Your settings have been saved.', ADDONS_TEXT_DOMAIN ), true );

		die();
	}

	/** ----------------------------------------------- */

	/**
	 * @return void
	 */
	public function _gausy_activity_log_callback(): void {}

	/** ----------------------------------------------- */

	/**
	 * @return void
	 */
	public function _gausy_menu_callback(): void {
		?>
        <div class="wrap" id="_container">
            <form id="_settings_form" method="post" enctype="multipart/form-data">

				<?php
				$nonce_field = wp_nonce_field( '_wpnonce_settings_form_' . get_current_user_id() ); ?>

                <div id="main" class="filter-tabs clearfix">

					<?php include __DIR__ . '/options_menu.php'; ?>
					<?php include __DIR__ . '/options_content.php'; ?>

                </div>
            </form>
        </div>
		<?php
	}

	/** ----------------------------------------------- */

	/**
	 * @return void
	 */
	public function _gausy_server_info_callback(): void {
        global $wpdb;

		?>
        <div class="wrap">
            <div id="main">
                <h2 class="hide-text"></h2>
                <div class="server-info-body">
                    <h2><?php
						echo __( 'Server info', ADDONS_TEXT_DOMAIN ) ?></h2>
                    <p class="desc"><?php
						echo __( 'System configuration information', ADDONS_TEXT_DOMAIN ) ?></p>
                    <div class="server-info-inner code">
                        <ul>
                            <li><?php echo sprintf( '<span>Platform:</span> %s', php_uname() ); ?></li>
                            <li><?php echo sprintf( '<span>Server:</span> %s', $_SERVER['SERVER_SOFTWARE'] ); ?></li>
                            <li><?php echo sprintf( '<span>Server IP:</span> %s', $_SERVER['SERVER_ADDR'] ); ?></li>

	                        <?php
	                        $cpu_info = file_get_contents('/proc/cpuinfo');
	                        preg_match('/^model name\s*:\s*(.+)$/m', $cpu_info, $matches);
	                        $cpu_model = isset($matches[1]) ? trim($matches[1]) : 'Unknown';
	                        ?>
                            <li><?php echo sprintf( '<span>CPU Info:</span> %s', $cpu_model ); ?></li>

                            <li><?php echo sprintf( '<span>Memory Limit:</span> %s', ini_get('memory_limit') ); ?></li>
                            <li><?php echo sprintf( '<span>PHP version:</span> %s', PHP_VERSION ); ?></li>
                            <li><?php echo sprintf( '<span>MySql version:</span> %s', $wpdb->db_version() ); ?></li>

                            <li><?php echo sprintf( '<span>WordPress version:</span> %s', get_bloginfo( 'version' ) ); ?></li>
                            <li><?php echo sprintf( '<span>WordPress multisite:</span> %s', ( is_multisite() ? 'Yes' : 'No' ) ); ?></li>
							<?php
							$openssl_status = __( 'Available', ADDONS_TEXT_DOMAIN );
							$openssl_text   = '';
							if ( ! defined( 'OPENSSL_ALGO_SHA1' ) && ! extension_loaded( 'openssl' ) ) {
								$openssl_status = __( 'Not available', ADDONS_TEXT_DOMAIN );
								$openssl_text   = __( ' (openssl extension is required in order to use any kind of encryption like TLS or SSL)', ADDONS_TEXT_DOMAIN );
							}
							?>
                            <li><?php echo sprintf( '<span>openssl:</span> %s%s', $openssl_status, $openssl_text ); ?></li>
                            <li><?php echo sprintf( '<span>allow_url_fopen:</span> %s', ( ini_get( 'allow_url_fopen' ) ? __( 'Enabled', ADDONS_TEXT_DOMAIN ) : __( 'Disabled', ADDONS_TEXT_DOMAIN ) ) ); ?></li>
							<?php
							$stream_socket_client_status = __( 'Not Available', ADDONS_TEXT_DOMAIN );
							$fsockopen_status            = __( 'Not Available', ADDONS_TEXT_DOMAIN );
							$socket_enabled              = false;

							if ( function_exists( 'stream_socket_client' ) ) {
								$stream_socket_client_status = __( 'Available', ADDONS_TEXT_DOMAIN );
								$socket_enabled              = true;
							}
							if ( function_exists( 'fsockopen' ) ) {
								$fsockopen_status = __( 'Available', ADDONS_TEXT_DOMAIN );
								$socket_enabled   = true;
							}

							$socket_text = '';
							if ( ! $socket_enabled ) {
								$socket_text = __( ' (In order to make a SMTP connection your server needs to have either stream_socket_client or fsockopen)', ADDONS_TEXT_DOMAIN );
							}
							?>
                            <li><?php echo sprintf( '<span>stream_socket_client:</span> %s', $stream_socket_client_status ); ?></li>
                            <li><?php echo sprintf( '<span>fsockopen:</span> %s%s', $fsockopen_status, $socket_text ); ?></li>

							<?php
							if ( $agent = $_SERVER['HTTP_USER_AGENT'] ?? null ) : ?>
                            <li><?php echo sprintf( '<span>User agent:</span> %s', $agent ); ?></li>
							<?php endif; ?>

                            <li><?php echo sprintf( '<span>IP:</span> %s', \gausy_ip_address() ); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}
