<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pakistore
 */
$cookie_info = get_field('cookie_info', get_option( 'page_on_front' ));
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

		<div class="page">
			<div class="site-info">

				<!-- <div class="fixed-icons">


				</div> -->
			
				<div class="site-footer__main">
					
					<div class="col col-1">
					<h3>Siedziba</h3>
					<p>Adres 1</p>
					<p>Adres 2</p>
					<p>dział obsługi Klienta: +48 123 456 789</p>
					<p>mail@sklep.pl</p>

					</div>

					<div class="col col-2">
					<!-- <div id="instagram-feed-demo" class="instagram_feed"></div> -->
					<h3>Pomoc</h3>
					<p><a class="terms-link" href="<?php echo get_permalink(3) ?>">Polityka prywatności</a></p>
					<p><a class="terms-link" href="<?php echo get_permalink(213) ?>">Regulamin sklepu internetowego</a></p>
					<p><a class="terms-link" href="<?php echo get_permalink(216) ?>">Dostawa</a></p>
					<p><a class="terms-link" href="<?php echo get_permalink(3589) ?>">Reklamacje i zwroty</a></p>
					</div>

					<div class="col col-3">
					<!-- <div id="instagram-feed-demo" class="instagram_feed"></div> -->
					<h3>Metody płatności</h3>
					<p class="payment-method method-paypal"></p>
					<p class="payment-method method-przelewy24"></p>
					<p class="payment-method method-zapobraniem"></p>
					</div>

				</div>

				<!-- <div class="footer-menu">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
						)

					);
					
					?>
				</div> -->

				<div class="footer-bottom">
				<?php echo footer_copyright(); ?> Copyright © 
				</div>
				<div class="icons-info">
					Icons made by:
					<a href="https://www.flaticon.com/authors/nikita-golubev" title="Nikita Golubev">Nikita Golubev</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a>
					<a href="https://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a>
					<div>Icons made by <a href="" title="Kiranshastry">Kiranshastry</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
					<div>Icons made by <a href="https://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>

				</div>

			</div><!-- .site-info -->
		</div>

		<!-- <div id="cookie-text">
		<p><?php echo $cookie_info ?></p>
		</div> -->
		

		<div class="scrollToTopBtn">
			<div class="scrollToTopBtn__svg-wrapper">
				<svg xmlns="http://www.w3.org/2000/svg" height="42" viewBox="0 0 24 24" width="36"><path d="M0 0h24v24H0z" fill="none"/><path fill="#fff" d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/></svg>
			</div>
		</div>



		<div class="cookie-law-notification">
			<button id="cookie-law-button">Akceptuję</button>
			<p><?php echo $cookie_info ?></p>
		</div>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
