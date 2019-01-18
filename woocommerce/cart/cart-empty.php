<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<section class="section section-commerce <?php echo apply_filters( 'oxy_woocommerce_shop_classes', 10 ); ?>">
    <div class="container ">
        <div class="row text-center element-normal-top element-normal-bottom">

            <?php wc_print_notices(); ?>

            <?php do_action( 'woocommerce_cart_is_empty' );

			if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
	            <p class="return-to-shop">
	                <a class="btn btn-primary wc-backward" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>">
	                    <?php _e( 'Return to shop', 'woocommerce' ) ?>
	                </a>
	            </p>
			<?php endif; ?>
        </div>
    </div>
</section>
