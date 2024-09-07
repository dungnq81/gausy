<?php

\defined( 'ABSPATH' ) || die;

$menu_options_page = apply_filters( 'gausy_menu_options_filters', [] );

?>
<div id="_nav" class="tabs-nav">
	<div class="logo-title">
		<h3>
			<?php _e( 'Gausy Settings', ADDONS_TEXT_DOMAIN ); ?>
			<span>Version: <?php echo ADDONS_VERSION; ?></span>
		</h3>
	</div>

	<div class="save-bar">
		<button type="submit" name="_submit_settings" class="button button-primary"><?php _e( 'Save Changes', ADDONS_TEXT_DOMAIN ); ?></button>
	</div>

	<ul class="ul-menu-list">
        <?php
        $i = 0;
        foreach ( $menu_options_page as $slug => $value ) :
            $current = ( 0 === $i ) ? ' class="current"' : '';

            // WooCommerce
            if ( 'woocommerce' === (string) $slug && ! gausy_check_plugin_active( 'woocommerce/woocommerce.php' ) ) {
                continue;
            }

            // SMTP
            if ( 'smtp' === (string) $slug && ! gausy_check_smtp_plugin_active() ) {
                continue;
            }
        ?>
        <li class="<?=$slug?>-settings">
            <a<?=$current?> title="<?= esc_attr( $value ) ?>" href="#<?=$slug?>_settings"><?= $value ?></a>
        </li>
        <?php $i++; endforeach; ?>
	</ul>
</div>
