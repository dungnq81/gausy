<?php

use Addons\Base\Singleton;

use Addons\Base_Slug\Base_Slug;
use Addons\Custom_Css\Custom_Css;
use Addons\Custom_Email\Custom_Email;
use Addons\Custom_Script\Custom_Script;
use Addons\Custom_Sorting\Custom_Sorting;
use Addons\Editor\Editor;
use Addons\Login_Security\Login_Security;
use Addons\Optimizer\Optimizer;
use Addons\Option_Page\Option_Page;
use Addons\Aspect_Ratio\Aspect_Ratio;
use Addons\Security\Security;
use Addons\Smtp\SMTP;
use Addons\Woocommerce\WooCommerce;

\defined( 'ABSPATH' ) || die;

/**
 * Addons Class
 *
 * @author Gaudev
 */
final class Addons {

	use Singleton;

	/** ----------------------------------------------- */

	private function init(): void {
		add_action( 'plugins_loaded', [ &$this, 'i18n' ], 1 );
		add_action( 'plugins_loaded', [ &$this, 'plugins_loaded' ], 11 );

		add_action( 'admin_enqueue_scripts', [ &$this, 'admin_enqueue_scripts' ], 39, 1 );
	}

	/** ----------------------------------------------- */

	/**
	 * Load localization file
	 *
	 * @return void
	 */
	public function i18n(): void {
		load_plugin_textdomain( ADDONS_TEXT_DOMAIN );
		load_plugin_textdomain( ADDONS_TEXT_DOMAIN, false, ADDONS_PATH . 'languages' );
	}

	/** ----------------------------------------------- */

	/**
	 * @return void
	 */
	public function plugins_loaded(): void {

		( Option_Page::get_instance() );
		( Aspect_Ratio::get_instance() );
		( SMTP::get_instance() );
		( Editor::get_instance() );
		( Optimizer::get_instance() );
		( Security::get_instance() );
		( Login_Security::get_instance() );
		( Base_Slug::get_instance() );
		( Custom_Email::get_instance() );
		( Custom_Sorting::get_instance() );
		( WooCommerce::get_instance() );
		( Custom_Script::get_instance() );
		( Custom_Css::get_instance() );
	}

	/** ----------------------------------------------- */

	/**
	 * @param $hook
	 *
	 * @return void
	 */
	public function admin_enqueue_scripts( $hook ): void {
		$version = ADDONS_VERSION;
		if ( WP_DEBUG ) {
			$version = date( 'YmdHis', current_time( 'U', 0 ) );
		}

		wp_enqueue_style( 'admin-addons-style', ADDONS_URL . 'assets/css/admin_addons.css', [], $version );
		wp_enqueue_script( 'admin-addons', ADDONS_URL . 'assets/js/admin_addons.js', [ 'jquery-core' ], $version, true );

		// options_enqueue_assets
		$allowed_pages = 'toplevel_page_gausy-settings';
		if ( $allowed_pages === $hook ) {

			if ( wp_style_is( 'select2-style' ) ) {
				wp_dequeue_style( 'select2-style' );
			}
			if ( wp_script_is( 'select2', 'registered' ) ) {
				wp_deregister_script( 'select2' );
			}

			wp_enqueue_style( 'select2-style', ADDONS_URL . 'assets/css/plugins/select2.min.css', [], $version );
			wp_register_script( 'select2', ADDONS_URL . 'assets/js/plugins/select2.full.min.js', [ 'jquery-core' ], $version, true );
			wp_enqueue_script( 'select2-addons', ADDONS_URL . 'assets/js/plugins/select2.js', [ 'select2' ], $version, true );

			$codemirror_settings = [
				'codemirror_css'  => wp_enqueue_code_editor( [ 'type' => 'text/css' ] ),
				'codemirror_html' => wp_enqueue_code_editor( [ 'type' => 'text/html' ] ),
			];

			wp_enqueue_style( 'wp-codemirror' );
			wp_localize_script( 'admin-addons', 'codemirror_settings', $codemirror_settings );
		}
	}
}
