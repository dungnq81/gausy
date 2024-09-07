<?php

namespace Addons\Custom_Script;

use Addons\Base\Singleton;

\defined( 'ABSPATH' ) || die;

final class Custom_Script {
	use Singleton;

	// ------------------------------------------------------

	/**
	 * @return void
	 */
	private function init(): void {
		add_action( 'wp_head', [ &$this, 'header_scripts__hook' ], 99 ); // header scripts
		add_action( 'wp_body_open', [ &$this, 'body_scripts_top__hook' ], 99 ); // body scripts - TOP

		add_action( 'wp_footer', [ &$this, 'footer_scripts__hook' ], 1 ); // footer scripts
		add_action( 'wp_footer', [ &$this, 'body_scripts_bottom__hook' ], 998 ); // body scripts - BOTTOM
	}

	// ------------------------------------------------------

	/**
	 * Header scripts
	 *
	 * @return void
	 */
	public function header_scripts__hook(): void {
		$html_header = gausy_extract_js( gausy_custom_post_option_content( 'html_header', true ) );
		if ( $html_header && ! gausy_lighthouse() ) {
			echo gausy_js_minify( $html_header, true );
		}
	}

	// ------------------------------------------------------

	/**
	 * Body scripts - TOP
	 *
	 * @return void
	 */
	public function body_scripts_top__hook(): void {
		$html_body_top = gausy_extract_js( gausy_custom_post_option_content( 'html_body_top', true ) );
		if ( $html_body_top && ! gausy_lighthouse() ) {
			echo gausy_js_minify( $html_body_top, true );
		}
	}

	// ------------------------------------------------------

	/**
	 * Footer scripts
	 *
	 * @return void
	 */
	public function footer_scripts__hook(): void {
		$html_footer = gausy_extract_js( gausy_custom_post_option_content( 'html_footer', true ) );
		if ( $html_footer && ! gausy_lighthouse() ) {
			echo gausy_js_minify( $html_footer, true );
		}
	}

	// ------------------------------------------------------

	/**
	 * Body scripts - BOTTOM
	 *
	 * @return void
	 */
	public function body_scripts_bottom__hook(): void {
		$html_body_bottom = gausy_extract_js( gausy_custom_post_option_content( 'html_body_bottom', true ) );
		if ( $html_body_bottom && ! gausy_lighthouse() ) {
			echo gausy_js_minify( $html_body_bottom, true );
		}
	}
}
