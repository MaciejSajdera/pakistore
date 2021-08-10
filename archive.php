<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pakistore
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<div class="content-container">

				<header class="page-header">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</header><!-- .page-header -->

			</div>

			<div class="content-container">

				<div class="blog-grid"> <?php
				/* Start the Loop */
				while ( have_posts() ) :

					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/

					echo "<div class='post-wrapper'>";

						echo "<div class='post-wrapper__upper'>";
								echo '<a class="blog-post" href="'. get_permalink() .'" style="background-image: url(' .get_the_post_thumbnail_url(). ')">';

								echo '<div class="blog-post-caption">';
								echo '<h3 class="uppercase">' . get_the_title() . '</h3>';
								echo '</div>';
								echo '</a>';

						echo "</div>";

					// the_excerpt();
					echo '<p>'. get_excerpt(250, 'content'). '</p>';

					 echo '<a class="read-more" href="'. get_permalink() .'">Czytaj dalej</a>';

					echo "</div>";

				endwhile;

				?>
				
				</div><!-- blog-grid -->
			<div><!-- content-container -->

			<?php

			// the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
