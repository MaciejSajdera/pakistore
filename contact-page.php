<?php

/*
 * Template Name: Contact Page Template
 * description: >-
  Page template without sidebar
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

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
			<p>Adres:</p>
			<p><?php echo get_field('address_1');?></p>
			<p><?php echo get_field('address_2');?></p>
			<a href="mailto: <?php echo get_field('email');?>"><?php echo get_field('email');?></a>
			<a href="tel:<?php echo get_field('phone_number');?>"><?php echo get_field('phone_number');?></a>
			</div>
			<?php echo get_field('location');?>

			<div class="salesmen-wrapper wrapper-flex-column">

			<?php
			$salesmen = get_field('salesmen');
			?>
				<h2>Obsługa klienta</h2>

				<div class="wrapper-flex-row">
					<div class="salesman-single">
						<div class="salesman-single__avatar" style="background-image: url(<?php echo $salesmen ['avatar_1'] ?>);"></div>
						<h3><?php echo $salesmen ['name_1']; ?></h3>
						<a href="tel:<?php echo $salesmen ['phone_1']; ?>">kom: <?php echo $salesmen ['phone_1']; ?></a>
						<a href="mailto:<?php echo $salesmen ['email_1']; ?>">e-mail: <?php echo $salesmen ['email_1']; ?></a>
					</div>

					<div class="salesman-single">
						<div class="salesman-single__avatar" style="background-image: url(<?php echo $salesmen ['avatar_2'] ?>);"></div>
						<h3><?php echo $salesmen ['name_2']; ?></h3>
						<a href="tel:<?php echo $salesmen ['phone_2']; ?>">kom: <?php echo $salesmen ['phone_2']; ?></a>
						<a href="mailto:<?php echo $salesmen ['email_2']; ?>">e-mail: <?php echo $salesmen ['email_2']; ?></a>

					</div>

					<div class="salesman-single">
						<div class="salesman-single__avatar" style="background-image: url(<?php echo $salesmen ['avatar_3'] ?>);"></div>
						<h3><?php echo $salesmen ['name_3']; ?></h3>
						<a href="tel:<?php echo $salesmen ['phone_3']; ?>">kom: <?php echo $salesmen ['phone_3']; ?></a>
						<a href="mailto:<?php echo $salesmen ['email_3']; ?>">e-mail: <?php echo $salesmen ['email_3']; ?></a>
					</div>
				
				</div>

			</div>


			<div class="our-shops wrapper-flex-column">

			<?php
			$shops = get_field('shops');
			$opening_hours_1 = $shops['opening_hours_1'];
			$opening_hours_2 = $shops['opening_hours_2'];
			?>

				<h2>Nasze Sklepy</h2>

				<div class="wrapper-flex-row">
					<div class="shop-single">

						<h3><?php echo $shops ['name_1']; ?></h3>
						<a href="tel:<?php echo $shops ['phone_1']; ?>">kom: <?php echo $shops ['phone_1']; ?></a>
						<a href="mailto:<?php echo $shops ['email_1']; ?>">e-mail: <?php echo $shops ['email_1']; ?></a>
						<span class="opening-hours__title">Godziny otwarcia</span>
						<div class="opening-hours">
							<p> <span><?php echo $opening_hours_1['weekdays'] ?></span> <span><?php echo $opening_hours_1['weekdays_hours'] ?></span> </p>
							<p> <span><?php echo $opening_hours_1['saturday'] ?></span> <span><?php echo $opening_hours_1['saturday_hours'] ?></span> </p>
							<p> <span><?php echo $opening_hours_1['sunday'] ?></span> <span><?php echo $opening_hours_1['sunday_hours'] ?></span> </p>
						</div>
					</div>

					<div class="shop-single">
						<h3><?php echo $shops ['name_2']; ?></h3>
						<a href="tel:<?php echo $shops ['phone_2']; ?>">kom: <?php echo $shops ['phone_2']; ?></a>
						<a href="mailto:<?php echo $shops ['email_2']; ?>">e-mail: <?php echo $shops ['email_2']; ?></a>
						<span class="opening-hours__title">Godziny otwarcia</span>
						<div class="opening-hours">
							<p> <span><?php echo $opening_hours_2['weekdays'] ?></span> <span><?php echo $opening_hours_2['weekdays_hours'] ?></span> </p>
							<p> <span><?php echo $opening_hours_2['saturday'] ?></span> <span><?php echo $opening_hours_2['saturday_hours'] ?></span> </p>
							<p> <span><?php echo $opening_hours_2['sunday'] ?></span> <span><?php echo $opening_hours_2['sunday_hours'] ?></span> </p>
						</div>
					</div>

				</div>

				<div class="wrapper-flex-row">
					<div class="shop-single">
						<h3><?php echo $shops ['name_3']; ?></h3>
						<a href="tel:<?php echo $shops ['phone_3']; ?>">kom: <?php echo $shops ['phone_3']; ?></a>
					</div>

					<div class="shop-single">
						<h3><?php echo $shops ['name_4']; ?></h3>
						<a href="tel:<?php echo $shops ['phone_4']; ?>">kom: <?php echo $shops ['phone_4']; ?></a>
						<a href="mailto:<?php echo $shops ['email_4']; ?>">e-mail: <?php echo $shops ['email_4']; ?></a>
					</div>
				</div>

			
			</div>

			<div id="map_wrapper">
    			<div id="map_canvas" class="mapping"></div>
			</div>

			<?php
			get_template_part( 'template-parts/contact-form', 'page' );
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();