<?php
/**
 * Themes functions
 *
 * @author Gaudev
 */

\defined( 'ABSPATH' ) || die;

// --------------------------------------------------
// custom filter
// --------------------------------------------------

add_filter( 'gausy_menu_options_filters', '__menu_options_filters', 99 );

/**
 * @return array
 */
function __menu_options_filters(): array {
	return [
		'aspect_ratio'   => __( 'Aspect Ratio', TEXT_DOMAIN ),
		'smtp'           => __( 'SMTP', TEXT_DOMAIN ),
		'editor'         => __( 'Editor', TEXT_DOMAIN ),
		'optimizer'      => __( 'Optimizer', TEXT_DOMAIN ),
		'security'       => __( 'Security', TEXT_DOMAIN ),
		'login_security' => __( 'Login Security', TEXT_DOMAIN ),
		'social'         => __( 'Social', TEXT_DOMAIN ),
		'base_slug'      => __( 'Remove Base Slug', TEXT_DOMAIN ),
		'custom_email'   => __( 'Custom Email', TEXT_DOMAIN ),
		'custom_sorting' => __( 'Custom Sorting', TEXT_DOMAIN ),
		'woocommerce'    => __( 'WooCommerce', TEXT_DOMAIN ),
		'custom_script'  => __( 'Custom Script', TEXT_DOMAIN ),
		'custom_css'     => __( 'Custom CSS', TEXT_DOMAIN ),
	];
}

// --------------------------------------------------

add_filter( 'gausy_theme_setting_filters', '__theme_setting_filters', 99 );

/**
 * @param array $arr
 *
 * @return array
 */
function __theme_setting_filters( array $arr ): array {
	$arr_new = [

		// defer, delay script - default 5s.
		'defer_script'                      => [

			// defer.
			'contact-form-7'       => 'defer',
			'swv'                  => 'defer',
			'hoverintent-js'       => 'defer',
			'wc-single-product'    => 'defer',
			'sourcebuster-js'      => 'defer',
			'wc-order-attribution' => 'defer',

			// delay.
			'comment-reply'        => 'delay',
			'wp-embed'             => 'delay',
			'back-to-top'          => 'delay',
			'social-share'         => 'delay',
		],

		// defer style.
		'defer_style'                       => [
			'dashicons',
			'contact-form-7',
		],

		// Aspect Ratio - custom post-type and term.
		'aspect_ratio_post_type_term'       => [
			'post',
		],

		// Aspect Ratio default.
		'aspect_ratio_default'              => [
			'1-1',
			'2-1',
			'3-2',
			'4-3',
			'16-9',
			'21-9',
		],

		// Add ID to admin category page.
		'term_row_actions'                  => [
			'category',
			'post_tag',
		],

		// Add ID to admin post-page.
		'post_row_actions'                  => [
			'user',
			'post',
			'page',
		],

		// Terms thumbnail (term_thumb).
		'term_thumb_columns'                => [
			'category',
			'post_tag',
		],

		// Exclude thumb post_type columns.
		'post_type_exclude_thumb_columns'   => [],

		// Custom post_per_page.
		'posts_num_per_page'                => [],

		// Custom post-type & taxonomy.
		'post_type_terms'                   => [],

		// smtp_plugins_support.
		'smtp_plugins_support'              => [
			'wp_mail_smtp'     => 'wp-mail-smtp/wp_mail_smtp.php',
			'wp_mail_smtp_pro' => 'wp-mail-smtp-pro/wp_mail_smtp.php',
			'smtp_mailer'      => 'smtp-mailer/main.php',
			'gmail_smtp'       => 'gmail-smtp/main.php',
			'fluent-smtp'      => 'fluent-smtp/fluent-smtp.php',
		],

		//
		'language_plugins_support'          => [
			'polylang'     => 'polylang/polylang.php',
			'polylang_pro' => 'polylang-pro/polylang.php',
		],

		// Custom Email list.
		'custom_emails'                     => [
			'custom_contact' => __( 'Contact', TEXT_DOMAIN ),
		],

		// List of admin IDs allowed to install plugins.
		'allowed_users_ids_install_plugins' => [ 1 ],

		// Login security
		'login_security'                    => [

			// Custom admin-login URI.
			'custom_login_uri'            => '',

			// Allows customization of the Login URL in the admin options.
			'enable_custom_login_options' => false,

			// Allowlist IPs Login Access
			'allowlist_ips_login_access'  => [
				//'127.0.0.1',
			],

			// Blocked IPs Access
			'blocked_ips_login_access'    => [
				//'127.0.0.1',
			],
		],

		// Links social.
		'social_follows_links'              => [
			'facebook'  => [
				'name'  => 'Facebook',
				'icon'  => 'fa-brands fa-facebook',
				'color' => '#0866FF',
				'url'   => 'https://www.facebook.com',
			],
			'instagram' => [
				'name'  => 'Instagram',
				'icon'  => 'fa-brands fa-instagram',
				'color' => 'rgb(224, 241, 255)',
				'url'   => 'https://www.instagram.com',
			],
			'youtube'   => [
				'name'  => 'Youtube',
				'icon'  => 'fa-brands fa-youtube',
				'color' => 'rgb(255, 0, 0)',
				'url'   => 'https://www.youtube.com',
			],
			'twitter'   => [
				'name'  => 'X (Twitter)',
				'icon'  => 'fa-brands fa-x-twitter',
				'color' => 'rgb(239, 243, 244)',
				'url'   => 'https://twitter.com',
			],
			'tiktok'    => [
				'name'  => 'Tiktok',
				'icon'  => 'fa-brands fa-tiktok',
				'color' => 'rgba(255, 255, 255, 0.9)',
				'url'   => 'https://www.tiktok.com',
			],
			'telegram'  => [
				'name'  => 'Telegram',
				'icon'  => 'fa-brands fa-telegram',
				'color' => '#2BA0E5',
				'url'   => 'https://telegram.org',
			],
			'zalo'      => [
				'name'  => 'Zalo',
				'icon'  => THEME_URL . 'storage/img/zlogo.png',
				'color' => '#0068FF',
				'url'   => 'https://chat.zalo.me/?phone=xxx',
			],
			'skype'     => [
				'name'  => 'Skype',
				'icon'  => 'fa-brands fa-skype',
				'color' => '#0092E0',
				'url'   => 'https://www.skype.com',
			],
			'hotline'   => [
				'name'  => 'Hotline',
				'icon'  => 'fa-solid fa-phone',
				'color' => '',
				'url'   => '',
			],
			'email'     => [
				'name'  => 'Email',
				'icon'  => 'fa-solid fa-envelope',
				'color' => '',
				'url'   => '',
			],
		],

		//----------------------------------------------------------
		// Custom ...
		//----------------------------------------------------------

	];

	// --------------------------------------------------

	if ( \Cores\Helper::isWoocommerceActive() ) {
		$arr_new['aspect_ratio_post_type_term'][]     = 'product';
		$arr_new['aspect_ratio_post_type_term'][]     = 'product_cat';
		$arr_new['term_row_actions'][]                = 'product_cat';
		$arr_new['post_type_exclude_thumb_columns'][] = 'product';
		$arr_new['post_type_terms'][]                 = [ 'product' => 'product_cat' ];
	}

	if ( \Cores\Helper::isCf7Active() ) {
		$arr_new['post_type_exclude_thumb_columns'][] = 'wpcf7_contact_form';
	}

	return array_merge( $arr, $arr_new );
}
