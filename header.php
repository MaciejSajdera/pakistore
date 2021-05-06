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
	<div class="preloader-content"></div>
</div>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'pakistore' ); ?></a>

	<?php $toppromo = get_field("top_promo", get_option('page_on_front'));
		$isActive = $toppromo['top_promo_active'];
	?>

	<header id="masthead" class="site-header">
		<nav id="site-navigation" class="main-navigation <?php if ($isActive == 1) : echo 'promo-navigation'; endif; ?>">

			<?php

				if ($isActive == 1) :

				   echo '<a class="top-promo" href=' .$toppromo['top_promo_link']. '><div class="top-promo-item promo-item-1">' .$toppromo['top_promo_text_1']. '</div> <div class="top-promo-item promo-item-2">  '.$toppromo['top_promo_text_2']. '</div></a>';
				   
				endif;
			?>

			<div class="shop-icons-wrapper">

				<div class="search-icon-wrapper">
					<div id="search-icon" class="wrapper-flex-column">
						<svg xmlns="http://www.w3.org/2000/svg" class="shop-icon" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path fill="#84898d" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
						<!-- <span class="search-sub-icon-text sub-icon-text">Szukaj</span> -->
					</div>
				</div>

					<div class="myaccount ">
						<a class="myaccount-link-unlogged wrapper-flex-column" href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>">

								<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
									viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" fill="#84898d">
								<g>
									<g>
										<path d="M256,288.389c-153.837,0-238.56,72.776-238.56,204.925c0,10.321,8.365,18.686,18.686,18.686h439.747
											c10.321,0,18.686-8.365,18.686-18.686C494.56,361.172,409.837,288.389,256,288.389z M55.492,474.628
											c7.35-98.806,74.713-148.866,200.508-148.866s193.159,50.06,200.515,148.866H55.492z"/>
									</g>
								</g>
								<g>
									<g>
										<path d="M256,0c-70.665,0-123.951,54.358-123.951,126.437c0,74.19,55.604,134.54,123.951,134.54s123.951-60.35,123.951-134.534
											C379.951,54.358,326.665,0,256,0z M256,223.611c-47.743,0-86.579-43.589-86.579-97.168c0-51.611,36.413-89.071,86.579-89.071
											c49.363,0,86.579,38.288,86.579,89.071C342.579,180.022,303.743,223.611,256,223.611z"/>
									</g>
								</g>
								<g>
								</g>
								<g>
								</g>
								<g>
								</g>
								<g>
								</g>
								<g>
								</g>
								<g>
								</g>
								<g>
								</g>
								<g>
								</g>
								<g>
								</g>
								<g>
								</g>
								<g>
								</g>
								<g>
								</g>
								<g>
								</g>
								<g>
								</g>
								<g>
								</g>
								</svg>


							<!-- <span class="sub-icon-text sub-login">Login / Rejestracja</span> -->
						</a>
					</div>

				<!-- html below is a placeholder, <a> content renders from functions.php function -->
				<a class="cart-customlocation">
					<svg id="Layer_1" enable-background="new 0 0 511.728 511.728" height="512" viewBox="0 0 511.728 511.728" width="512" xmlns="http://www.w3.org/2000/svg" fill="#84898d"><path d="m147.925 379.116c-22.357-1.142-21.936-32.588-.001-33.68 62.135.216 226.021.058 290.132.103 17.535 0 32.537-11.933 36.481-29.017l36.404-157.641c2.085-9.026-.019-18.368-5.771-25.629s-14.363-11.484-23.626-11.484c-25.791 0-244.716-.991-356.849-1.438l-17.775-65.953c-4.267-15.761-18.65-26.768-34.978-26.768h-56.942c-8.284 0-15 6.716-15 15s6.716 15 15 15h56.942c2.811 0 5.286 1.895 6.017 4.592l68.265 253.276c-12.003.436-23.183 5.318-31.661 13.92-8.908 9.04-13.692 21.006-13.471 33.695.442 25.377 21.451 46.023 46.833 46.023h21.872c-3.251 6.824-5.076 14.453-5.076 22.501 0 28.95 23.552 52.502 52.502 52.502s52.502-23.552 52.502-52.502c0-8.049-1.826-15.677-5.077-22.501h94.716c-3.248 6.822-5.073 14.447-5.073 22.493 0 28.95 23.553 52.502 52.502 52.502 28.95 0 52.503-23.553 52.503-52.502 0-8.359-1.974-16.263-5.464-23.285 5.936-1.999 10.216-7.598 10.216-14.207 0-8.284-6.716-15-15-15zm91.799 52.501c0 12.408-10.094 22.502-22.502 22.502s-22.502-10.094-22.502-22.502c0-12.401 10.084-22.491 22.483-22.501h.038c12.399.01 22.483 10.1 22.483 22.501zm167.07 22.494c-12.407 0-22.502-10.095-22.502-22.502 0-12.285 9.898-22.296 22.137-22.493h.731c12.24.197 22.138 10.208 22.138 22.493-.001 12.407-10.096 22.502-22.504 22.502zm74.86-302.233c.089.112.076.165.057.251l-15.339 66.425h-51.942l8.845-67.023 58.149.234c.089.002.142.002.23.113zm-154.645 163.66v-66.984h53.202l-8.84 66.984zm-74.382 0-8.912-66.984h53.294v66.984zm-69.053 0h-.047c-3.656-.001-6.877-2.467-7.828-5.98l-16.442-61.004h54.193l8.912 66.984zm56.149-96.983-9.021-67.799 66.306.267v67.532zm87.286 0v-67.411l66.022.266-8.861 67.145zm-126.588-67.922 9.037 67.921h-58.287l-18.38-68.194zm237.635 164.905h-36.426l8.84-66.984h48.973l-14.137 61.217c-.784 3.396-3.765 5.767-7.25 5.767z"/></svg>
					<!-- <span class="woocommerce-Price-amount amount sub-icon-text"><bdi>0,00<span class="woocommerce-Price-currencySymbol">zł</span></bdi></span> -->
				</a>

				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html( 'Primary Menu', 'pakistore' ); ?>
					<svg id="svgButton" class="ham hamRotate ham4" viewBox="0 0 100 100">
					<path
							class="line top"
							d="m 70,33 h -40 c 0,0 -8.5,-0.149796 -8.5,8.5 0,8.649796 8.5,8.5 8.5,8.5 h 20 v -20" />
					<path
							class="line middle"
							d="m 70,50 h -40" />
					<path
							class="line bottom"
							d="m 30,67 h 40 c 0,0 8.5,0.149796 8.5,-8.5 0,-8.649796 -8.5,-8.5 -8.5,-8.5 h -20 v 20" />
					</svg>
				</button>

			</div>









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


				<!-- <div class="quick-contact__wrapper">
					<a href="tel:123456789"><span class="quick-contact__phone-number">+48 123 456 789</span></a>
					<span class="quick-contact__openings">pn-pt: 8:00 - 16:00</span>
				</div> -->
				
			</div>

			<!-- <?php
				get_template_part( 'template-parts/desktop-site-menu', 'page' );
			?> -->

			<div class="desktop-menu">

			<?php
				get_template_part( 'template-parts/desktop-shop-menu', 'page' );
			?>
			</div>

			<div class="mobile-menu">
							<div class="mobile-menu__site-menu">
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'menu-1',
										'walker'          => new Has_Child_Walker_Nav_Menu()
									)
								);
								?>
							</div>

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