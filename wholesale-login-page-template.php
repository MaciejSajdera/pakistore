<?php

/*
 * Template Name: Wholesale login Page Template
 * description: >-
  Page template without sidebar
 */

global $post;

get_header();
?>

<div id="primary" class="content-area">

<main id="primary" class="wholesale-login">

		<header class="entry-header common-template wholesale-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
		<div class="woocommerce">
			<?php
				get_template_part( 'woocommerce/myaccount/form-login', 'page' );
			?>
		</div>
	</div>
	</main>
</div>

	
<?php
get_footer();