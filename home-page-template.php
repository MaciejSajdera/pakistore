<?php

/*
 * Template Name: Home Page Template
 * description: >-
  Page template without sidebar
 */

global $post;

get_header();
?>

	<div class="home-main">

		<div class="home-main__top-wrapper">

			<div class="has-aside--main home-main__top-content">

				<div class="welcome-view">

					<div class="content-container">

						<?php
							get_template_part( 'template-parts/home-carousel', 'page' );
						?>

					</div>

				</div>

				<div class="content-container">
					<?php
						get_template_part( 'template-parts/special-categories-menu', 'page' );
					?>
				</div>

				<div class="content-container">
					<?php
						get_template_part( 'template-parts/promo-banner', 'page' );
					?>
				</div>


				<div class="content-container">
					<?php
						get_template_part( 'template-parts/home-categories-display', 'page' );
					?>
				</div>

			</div>

		</div>

		<div class="content-container">
			<?php
				get_template_part( 'template-parts/home-content-blog', 'page' );
			?>
		</div>


</div>

	
<?php
get_footer();