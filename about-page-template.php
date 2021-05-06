<?php

/*
 * Template Name: About Page Template
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


				$team = get_field('team');
				?>
				<div class="team-container wrapper-flex-column">
					<div class="team-inner">
					<img src="<?php echo esc_url( $team['team_photo'] ); ?>" alt="<?php echo esc_attr( $offer['image']['alt'] ); ?>" />
					
					<h5>
						<?php echo $team['team_member_1_text']; ?>
						<a href="tel:<?php echo $team['team_member_1_contact']; ?>"><?php echo $team['team_member_1_contact']; ?></a>
					</h5>
					<h5>
						<?php echo $team['team_member_2_text']; ?>
						<a href="tel:<?php echo $team['team_member_2_contact']; ?>"><?php echo $team['team_member_2_contact']; ?></a>
					</h5>
					<h5>
						<?php echo $team['team_member_3_text']; ?>
						<a href="tel:<?php echo $team['team_member_3_contact']; ?>"><?php echo $team['team_member_3_contact']; ?></a>
					</h5>



					</div>
					<div class="logo"><?php the_custom_logo()?></div>

			</div><?php



				if ($page_subheader_2) :
					echo '<p class="common-page-subheader">' .$page_subheader_2. '</p>';
				endif;

				if ($page_textarea_2) :
					echo '<div class="page-textarea"><p>' .$page_textarea_2. '</p></div>';
				endif;
				if ($page_subheader_3) :
					echo '<p class="common-page-subheader">' .$page_subheader_3. '</p>';
				endif;

				$offer = get_field('offer');
				if( $offer ): ?>
					<div class="offer-container">

						<div class="offer-box">
							<img src="<?php echo esc_url( $offer['offer_1_image'] ); ?>" alt="<?php echo esc_attr( $offer['image']['alt'] ); ?>" />
							<div class="content">
								<p class="offer-text"><?php echo $offer['offer_1_text']; ?></p>
							</div>
						</div>

						<div class="offer-box">
							<img src="<?php echo esc_url( $offer['offer_2_image'] ); ?>" alt="<?php echo esc_attr( $offer['image']['alt'] ); ?>" />
							<div class="content">
								<p class="offer-text"><?php echo $offer['offer_2_text']; ?></p>
							</div>
						</div>

						<div class="offer-box">
							<img src="<?php echo esc_url( $offer['offer_3_image'] ); ?>" alt="<?php echo esc_attr( $offer['image']['alt'] ); ?>" />
							<div class="content">
								<p class="offer-text"><?php echo $offer['offer_3_text']; ?></p>
							</div>
						</div>
					</div>
				<?php endif;

		?></div><?php
		endwhile; // End of the loop.
		?>



</main>
	</div>

	
<?php
get_footer();