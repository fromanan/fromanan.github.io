<?php
/**
 * Shipping Calculator
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/shipping-calculator.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

if ( 'no' === get_option( 'woocommerce_enable_shipping_calc' ) || ! WC()->cart->needs_shipping() ) {
	return;
}

wp_enqueue_script( 'wc-country-select' );

do_action( 'woocommerce_before_shipping_calculator' ); ?>

<form class="woocommerce-shipping-calculator" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

	<h2><a href="#" class="btn btn-info btn-block shipping-calculator-button"><?php esc_html_e( 'Calculate shipping', 'woocommerce' ); ?>&nbsp;<i class="fa fa-truck fa-fw"></i></a></h2>

	<section class="shipping-calculator-form" style="display:none;">

		<p class="form-row form-row-wide" id="calc_shipping_country_field">
			<select name="calc_shipping_country" id="calc_shipping_country" class="form-control country_to_state country_select" rel="calc_shipping_state">
				<option value=""><?php esc_html_e( 'Select a country&hellip;', 'woocommerce' ); ?></option>
				<?php
					foreach ( WC()->countries->get_shipping_countries() as $key => $value ) {
						echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
					}
				?>
			</select>
		</p>

		<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_state', true ) ) : ?>

			<p class="form-row form-row-wide" id="calc_shipping_state_field">
				<?php
					$current_cc = WC()->customer->get_shipping_country();
					$current_r  = WC()->customer->get_shipping_state();
					$states     = WC()->countries->get_states( $current_cc );

					// Hidden Input
					if ( is_array( $states ) && empty( $states ) ) {
						?>
						<input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php esc_attr_e( 'State / County', 'woocommerce' ); ?>" />
						<?php
					} elseif ( is_array( $states ) ) {

						?><div class="form-group">
							<select name="calc_shipping_state" class="state_select form-control" id="calc_shipping_state" placeholder="<?php esc_attr_e( 'State / County', 'woocommerce' );?>">
								<option value=""><?php esc_html_e( 'Select a state&hellip;', 'woocommerce' ); ?></option>
								<?php
									foreach ( $states as $ckey => $cvalue ) {
										echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' . esc_html( $cvalue ) . '</option>';
									}
								?>
							</select>
						</div><?php

					// Standard Input
					} else {
						?>
						<input type="text" class="input-text form-control" value="<?php echo esc_attr( $current_r ); ?>" placeholder="<?php esc_attr_e( 'State / County', 'woocommerce' ); ?>" name="calc_shipping_state" id="calc_shipping_state" />
						<?php
					}
				?>
			</p>

		<?php endif; ?>

		<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', true ) ) : ?>

			<div class="form-row form-row-wide form-group">
				<input type="text" class="input-text form-controls" value="<?php echo esc_attr( WC()->customer->get_shipping_city() ); ?>" placeholder="<?php esc_attr_e( 'City', 'woocommerce' ); ?>" name="calc_shipping_city" id="calc_shipping_city" />
			</div>

		<?php endif; ?>

		<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>

			<div class="form-group form-row form-row-wide" id="calc_shipping_postcode_field">
				<input type="text" class="input-text form-control" value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>" placeholder="<?php esc_attr_e( 'Postcode / ZIP', 'woocommerce' ); ?>" name="calc_shipping_postcode" id="calc_shipping_postcode" />
			</div>

		<?php endif; ?>

		<button type="submit" name="calc_shipping" value="1" class="btn btn-success margin-bottom"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>

		<?php wp_nonce_field( 'woocommerce-shipping-calculator', 'woocommerce-shipping-calculator-nonce' ); ?>
	</section>
</form>

<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>
