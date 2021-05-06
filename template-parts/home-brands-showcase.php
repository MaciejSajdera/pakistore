<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pakistore
 */

?>

<section class="brands-carousel blog-posts-header">
	<h3>Marki</h3>
  <div class="swiper-container-brands">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
	<?php 

			// Get the taxonomy's terms
			$terms = get_terms(
				array(
					'taxonomy'   => 'producent',
					'hide_empty' => false,
				)
			);

			// Check if any term exists
			if ( ! empty( $terms ) && is_array( $terms ) ) {
				// Run a loop and print them all
				foreach ( $terms as $term ) {
					$imageURL = get_field("producent_logo", $term);

				if ($imageURL) {

					echo '<div class="swiper-slide">';

					echo '<a href="'.esc_url( get_term_link( $term ) ).'" >';
					echo '<img src="'.$imageURL.'" alt="'.$term->name.'">';
					echo '</a>';
					echo '</div>';
					};
				}
			} 

		?>
	</div>
  </div>
</section>
