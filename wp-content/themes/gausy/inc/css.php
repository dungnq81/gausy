<?php
/**
 * CSS Output functions
 *
 * @author   Gaudev
 */

\defined( 'ABSPATH' ) || die;

// --------------------------------------------------
// Custom css
// --------------------------------------------------

add_action( 'wp_enqueue_scripts', '__custom_css', 100 );

/**
 * @return void
 */
function __custom_css(): void {}
