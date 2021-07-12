<?php

/*
 * Template Name: Contact Page Template
 * description: >-
  Page template without sidebar
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main content-container">

			<!-- <div class="content-container"> -->

				<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						// if ( comments_open() || get_comments_number() ) :
						// 	comments_template();
						// endif;

					endwhile; // End of the loop.
					?>

					<div class="wrapper-flex-column contact-data">
					
						<h2><?php echo get_field('hq_header');?></h2>
						<h3><?php echo get_field('company_full_name');?></h3>
						<p><?php echo get_field('address_1');?></p>
						<p><?php echo get_field('address_2');?></p>
						<a href="mailto: <?php echo get_field('email');?>"><?php echo get_field('email');?></a>
						<a href="tel:<?php echo get_field('phone_number');?>"><?php echo get_field('phone_number');?></a>
						
					</div>

					<!-- <div id="map_wrapper">
						<div id="map_canvas" class="map"></div>
					</div> -->

					<?php
						get_template_part( 'template-parts/contact-form', 'page' );
					?>

			<!-- </div> -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();