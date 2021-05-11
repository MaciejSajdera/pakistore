<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>


	<div class="purchase-area">
			<div class="quantity-wrapper">
				<div class="quantity-label">Ilość: </div>

				<div class="quantity-controls">
					<?php
					do_action( 'woocommerce_before_add_to_cart_quantity' );

					woocommerce_quantity_input(
						array(
							'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
							'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
							'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
						)
					);

					do_action( 'woocommerce_after_add_to_cart_quantity' );
					?>
				</div>
			</div>

			<!-- <a id="my_simple_add_to_cart_ajax" href="<?php echo $product->add_to_cart_url() ?>" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo get_the_ID(); ?>" data-product_sku="<?php echo esc_attr($sku) ?>" aria-label="<?php echo esc_html( $product->single_add_to_cart_text() ); ?>" rel="nofollow"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></a> -->

			<div class="button-wrapper">
				<button id="my_simple_add_to_cart_ajax" type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

				<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

				<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
				<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
				<input type="hidden" name="variation_id" class="variation_id" value="0" />

			</div>

	</div>

</div>
