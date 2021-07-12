<?php

/*
 * Template Name: About Page Template
 * description: >-
  Page template without sidebar
 */
$imageURL = get_the_post_thumbnail_url();
get_header();
?>
<div id="primary" class="content-area">

	<main id="primary" class="home-about content-container">

		<div class="home-about__content">

			<?php
				while ( have_posts() ) :
					the_post();

					the_content();

					// If comments are open or we have at least one comment, load up the comment template.
					// if ( comments_open() || get_comments_number() ) :
					// 	comments_template();
					// endif;

				endwhile; // End of the loop.
			?>
		</div>

		<div class="home-about__image">

				
			<img src=<?php echo $imageURL ?> />
		</div>

	</main>

</div>

	
<?php
get_footer();