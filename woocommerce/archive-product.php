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

?>
<div class="content-container">
<?php
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>

<!-- <div class="woocommerce-archive__wrapper"> -->


		<?php
			// get_template_part( 'template-parts/desktop-shop-menu', 'page' );
		?>

	<!-- <div class="woocommerce-archive__right-column"> -->


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
		// do_action( 'woocommerce_archive_description' );
		?>

	</header>

	<?php

		$term = get_queried_object();

		$children = get_terms( $term->taxonomy, array(
		'parent'    => $term->term_id,
		'hide_empty' => false
		) );


		if ( is_product_category() && $children ) {

			$short_description = get_field('category_short_description', $term);

			echo '<div class="category-short-description">';

				echo $short_description;

			echo '</div>';

			$term_id  = get_queried_object_id();
			$taxonomy = 'product_cat';
	
			// Get subcategories of the current category
			$subcategories    = get_terms([
				'taxonomy'    => $taxonomy,
				'order' => 'ASC',
				'hide_empty'  => false,
				'parent'      => $term_id,
			]);

			echo '<ul class="subcategories-list">';
	
			// Loop through product subcategories WP_Term Objects
			foreach ( $subcategories as $subcategory ) {
				$subcategory_link = get_term_link( $subcategory, $taxonomy );
				$image = get_field('category_image', $subcategory);
	
				echo '<li><a href="'. $subcategory_link .'"><img src="'.$image.'" />'. $subcategory->name .'</a></li>';
			}
	
			echo '</ul>';
		} else {

			?>

				<div class="wrapper-flex-column shop-wrapper">

				<!-- <div class="filters-and-sorts__wrapper"> -->

					<div class="woocommerce-results-and-ordering">

						<!-- <?php do_action( 'woocommerce_results_and_ordering' ); ?> -->
					
					</div>

					<div class="woof-filter sidebar-filters">

						<p id="toggle-filters">Filtry <span class="filters-icon"></span></p>

						<?php echo do_shortcode('[woof]') ?>

					</div>

				<!-- </div> -->


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
				do_action( 'woocommerce_sidebar' );

				?>
				</div>
				</div>

			<?php

			
		}

			?>
			

			<div class="content-container category-description-wrapper">
			
				<?php do_action( 'woocommerce_archive_description' ); ?>

			</div>

		<!-- </div> -->
			<!-- woocommerce-archive__right-column -->
	<!-- </div>  -->
	<!-- woocommerce-archive__wrapper -->

	<?php
	// };
	//shop category grid if's end

	?>

</div>
 <!-- content-container -->
<?php
get_footer( 'shop' );
