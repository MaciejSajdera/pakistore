<?php

/*
 * Template Name: Branches Page Template
 * description: >-
  Page template without sidebar
 */

get_header();
?>
<div id="primary" class="content-area">

	<main id="primary" class="home-about">

	<?php
		while ( have_posts() ) :
			the_post();

			?>
			<header class="entry-header common-template">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
			<?php pakistore_post_thumbnail();

			?>
			<div class="page-wrapper">
				<?php
				$page_header = get_field('page_header');
				$page_subheader_1 = get_field('page_subheader_1');
				$page_textarea_1 = get_field('page_textarea_1');
				$page_subheader_2 = get_field('page_subheader_2');
				$page_textarea_2 = get_field('page_textarea_2');
				$page_subheader_3 = get_field('page_subheader_3');

				if ($page_header) :
				echo '<h1 class="common-page-header">' .$page_header. '</h1>';
				endif;
				if ($page_subheader_1) :
				echo '<p class="common-page-subheader">' .$page_subheader_1. '</p>';
				endif;
				if ($page_textarea_1) :
					echo '<div class="page-textarea"><p>' .$page_textarea_1. '</p></div>';
				endif;
				if ($page_subheader_2) :
					echo '<p class="common-page-subheader">' .$page_subheader_2. '</p>';
				endif;
				if ($page_textarea_2) :
					echo '<div class="page-textarea"><p>' .$page_textarea_2. '</p></div>';
				endif;
				if ($page_subheader_3) :
					echo '<p class="common-page-subheader">' .$page_subheader_3. '</p>';
				endif;


		endwhile; // End of the loop.
		?>

		<div id="map" class="wrapper-flex-row">

			<div>
			<p> Siedziba przy ul. Moniuszki 5</p>
			<iframe
				width="600"
				height="450"
				frameborder="0" style="border:0"
				src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJ69Y15pEnGEcRVPu5y7rPD9M&key=AIzaSyAPJ8o7xD9vqydfgZ6XrJKvLdnhmL_YTxA
					&q=Space+Needle,Seattle+WA" allowfullscreen>
			</iframe>
			</div>

			<div>
			<p>Siedziba przy ul. Staszica 14A</p>
			<iframe
				width="600"
				height="450"
				frameborder="0" style="border:0"
				src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJA4CEcO0nGEcRKKxW--N2iPY&key=AIzaSyAPJ8o7xD9vqydfgZ6XrJKvLdnhmL_YTxA
					&q=Space+Needle,Seattle+WA" allowfullscreen>
			</iframe>
			</div>

		</div>
		</div>

</main>
	</div>

	
<?php
get_footer();