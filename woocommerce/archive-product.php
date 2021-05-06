<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>

<div class="woocommerce-archive__wrapper">


		<?php
			get_template_part( 'template-parts/desktop-shop-menu', 'page' );
		?>

	<div class="woocommerce-archive__right-column">


	<header class="woocommerce-products-header">
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
		<?php endif; ?>

		<?php
		/**
		 * Hook: woocommerce_archive_description.
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action( 'woocommerce_archive_description' );
		?>
	</header>

	<?php

		// 	$body_classes = get_body_class();

		// if (is_shop(10) && !in_array('woof_search_is_going', $body_classes) && !in_array('search-results', $body_classes) && !in_array('search-no-results', $body_classes)  )  {

		// 	echo '<div class="shop-category-menu>';

		// 	wp_nav_menu(
		// 		array(
		// 			'theme_location' => 'special-categories-menu',
		// 			'depth' => 1
		// 		)
		// 	);

		// 	echo '</div>';

		// 	// $hide_empty = false ;
		// 	// $cat_args = array(
		// 	// 	'orderby'    => 'name',
		// 	// 	'order' => 'ASC',
		// 	// 	'hide_empty' => $hide_empty,
		// 	// 	'parent' => 0
		// 	// );

		// 	// $product_categories = get_terms( 'product_cat', $cat_args );

		// 	// if( !empty($product_categories) ){

		// 	// 	echo '<div class="categories-grid shop-grid1">';

		// 	// 	foreach ($product_categories as $key => $category) {

		// 	// 		$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
		// 	// 		$category_name = $category->name;
		// 	// 		$image = wp_get_attachment_url( $thumbnail_id );

		// 	// 		if (!$image) {
		// 	// 			$image = wc_placeholder_img_src();
		// 	// 		}

		// 	// 		// echo '<a class="brand-tile" href="'.get_term_link($category).'" >';
		// 	// 		// echo '<p>' .$category_name. '</p>';
		// 	// 		// echo '<img src="'.$image.'">';
		// 	// 		// echo '</a>';

		// 	// 		echo '<a class="category-tile" href="'.get_term_link($category).'">';
		// 	// 			echo '<div style="background-image: url('.$image.')";></div>';
		// 	// 			echo '<p>' .$category_name. '</p>';
		// 	// 		echo '</a>';
		// 	// 	}

		// 	// 	echo '</div>';
		// 	// }

		// } else  {


			$category_name = get_query_var('category_name');

			$args = array('parent' => $category_name);
			$categories = get_categories( $args );


			if ( is_product_category() ) {

				$term_id  = get_queried_object_id();
				$taxonomy = 'product_cat';
		
				// Get subcategories of the current category
				$terms    = get_terms([
					'taxonomy'    => $taxonomy,
					'order' => 'ASC',
					'hide_empty'  => true,
					'parent'      => $term_id,
				]);

				$count = sizeof($terms);

				$how_long;

				if ($count <= 10) {
					$how_long = 'subcategories-list__short';
				} 
				elseif ($count > 10) {
					$how_long = 'subcategories-list__long';
				} 


				echo '<ul class="subcategories-list '. $how_long .'">';
		
				// Loop through product subcategories WP_Term Objects
				foreach ( $terms as $term ) {
					$term_link = get_term_link( $term, $taxonomy );
		
					echo '<li class="'. $term->slug .'"><a href="'. $term_link .'" class="checkout-button button alt wc-forward my-checkout-button">'. $term->name .'</a></li>';
				}
		
				echo '</ul>';
			}

			?>
			<div class="wrapper-flex-column shop-wrapper">


				<div class="woof-filter sidebar-filters">


				<p id="toggle-filters">Filtry <span class="filters-icon"></span></p>

				<?= do_shortcode('[woof]') ?>

				

				

				</div>


				<div class="main-shop-products">
				<?php
				if ( woocommerce_product_loop() ) {

					/**
					 * Hook: woocommerce_before_shop_loop.
					 *
					 * @hooked woocommerce_output_all_notices - 10
					 * @hooked woocommerce_result_count - 20
					 * @hooked woocommerce_catalog_ordering - 30
					 */
					do_action( 'woocommerce_before_shop_loop' );

					
					woocommerce_product_loop_start();

					//additional pagination
					// woocommerce_pagination();


					if ( wc_get_loop_prop( 'total' ) ) {
						while ( have_posts() ) {
							the_post();

							/**
							 * Hook: woocommerce_shop_loop.
							 */
							do_action( 'woocommerce_shop_loop' );

							wc_get_template_part( 'content', 'product' );
						}
					}

					woocommerce_product_loop_end();

					/**
					 * Hook: woocommerce_after_shop_loop.
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action( 'woocommerce_after_shop_loop' );
				} else {
					/**
					 * Hook: woocommerce_no_products_found.
					 *
					 * @hooked wc_no_products_found - 10
					 */
					do_action( 'woocommerce_no_products_found' );
				}

				/**
				 * Hook: woocommerce_after_main_content.
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'woocommerce_after_main_content' );

				/**
				 * Hook: woocommerce_sidebar.
				 *
				 * @hooked woocommerce_get_sidebar - 10
				 */
				// do_action( 'woocommerce_sidebar' );

				?>
				</div>
			</div>
		</div>	<!-- woocommerce-archive__right-column -->
	</div> <!-- woocommerce-archive__wrapper -->

	<?php
	// };
	//shop category grid if's end

	?>

<?php
get_footer( 'shop' );
