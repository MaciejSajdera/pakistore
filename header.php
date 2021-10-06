<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pakistore
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="my-preloader">
	<div class="preloader-content">
	<?php echo get_custom_logo() ?>
	</div>
</div>

<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'pakistore' ); ?></a>

	<?php
	
		$toppromo = get_field("top_promo", get_option('page_on_front'));
		$isActive = $toppromo['top_promo_active'];
	?>

	<header id="masthead" class="site-header <?php if ($isActive == 1) : echo 'promo-header'; endif; ?>">
		<nav id="site-navigation" class="main-navigation <?php if ($isActive == 1) : echo 'promo-navigation'; endif; ?>">

			<?php

				if ($isActive == 1) :

				   echo '<a class="top-promo" href=' .$toppromo['top_promo_link']. '><div class="top-promo-item promo-item-1">' .$toppromo['top_promo_text_1']. '</div> <div class="top-promo-item promo-item-2">  '.$toppromo['top_promo_text_2']. '</div></a>';
				   
				endif;
			?>

			<?php
				 get_template_part( 'template-parts/shop-icons-wrapper', 'page' );
			?>

		<?php
		// Reset the WP Query
		wp_reset_postdata();
		?>

		</nav><!-- #site-navigation -->

			<div class="header-middle">

				<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$pakistore_description = get_bloginfo( 'description', 'display' );
				if ( $pakistore_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $pakistore_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
				</div><!-- .site-branding -->

				<div class="search-panel">
					<?php echo do_shortcode('[fibosearch]'); ?>
				</div>



				<?php
				 get_template_part( 'template-parts/shop-icons-wrapper-desktop', 'page' );
				?>

				<!-- <div class="quick-contact__wrapper">
					<a href="tel:123456789"><span class="quick-contact__phone-number">+48 123 456 789</span></a>
					<span class="quick-contact__openings">pn-pt: 8:00 - 16:00</span>
				</div> -->
				
			</div>

			<div class="desktop-menu">

			<?php
				get_template_part( 'template-parts/desktop-shop-menu', 'page' );
			?>
			</div>

			<div class="mobile-menu">
							<!-- <div class="mobile-menu__site-menu">
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'menu-1',
										'walker'          => new Has_Child_Walker_Nav_Menu()
									)
								);
								?>
							</div> -->

							<div class="mobile-menu__woomenu">
								<div class="shop-menu">
												<!-- <div class="mobile-list-title">
													<span>Oferta</span>
												</div> -->

													<!-- this wooshoop menu is only for desktop -->
										<?php
													wp_nav_menu(
														array(
															'theme_location' => 'wooshop',
														)
													);
										?>
								</div>
							</div>
			</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">