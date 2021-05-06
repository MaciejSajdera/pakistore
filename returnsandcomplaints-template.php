<?php
/*
 * Template Name: Returns and Complaints Template
 * description: >-
  Page template without sidebar
 */

get_header();

$return_product_form = get_field("return_product_form");
$complaint_form = get_field("complaint_form");
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			the_content();

			// If comments are open or we have at least one comment, load up the comment template.
			// if ( comments_open() || get_comments_number() ) :
			// 	comments_template();
			// endif;

			if ($return_product_form || $complaint_form) :
				echo '<div class="wrapper-flex-column" style="margin-top: 4em">';

					echo '<h3>Pliki do pobrania:</h3>';

					if ( $complaint_form ):
						$complaint_form_url = wp_get_attachment_url( $complaint_form );
					?>
						<a class="read-more" href="<?php echo esc_html($complaint_form_url); ?>" style="margin-bottom: 1em">Formularz reklamacyjny</a>
					<?php endif;
					
					if ( $return_product_form ):
						$return_product_form_url = wp_get_attachment_url( $return_product_form );
					?>
						<a class="read-more" href="<?php echo esc_html($return_product_form_url); ?>" >Zwrot produktu</a>
					<?php endif;

				echo '</div>';
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
