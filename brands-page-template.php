<?php

/*
 * Template Name: Brands Page Template
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
		// $parent_id = 26;
		// $orderby = 'name';
		// $order = 'asc';
		// $hide_empty = false ;
		// $cat_args = array(
		// 	'orderby'    => $orderby,
		// 	'order'      => $order,
		// 	'hide_empty' => $hide_empty,
		// 	'parent' => $parent_id
		// );

		$args = array(
			'post_parent' => get_the_ID(28),
			'post_type'   => 'page',
			'numberposts' => -1,
			'post_status' => 'publish'
		);
	
		$children = get_children( $args, $output ); 


		
		$product_categories = get_terms( 'product_cat', $cat_args );
		
		if( !empty($product_categories) ){

			echo '<div class="brands-grid">';

			foreach($children as $dest){
				$page_permalink = get_permalink($dest->ID);

				$page_image_url = wp_get_attachment_url(get_post_thumbnail_id($dest->ID));
				$page_title = get_the_title($dest->ID);

				if ($page_image_url) :
				echo "<a class='brand-tile' href='{$page_permalink}' style='background-image:url({$page_image_url})'></a>";
				else :
				echo "<a class='brand-tile' href='{$page_permalink}'>{$page_title}</a>";
				endif;

			}

			// foreach ($product_categories as $key => $category) {

			// 	$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
			// 	$image = wp_get_attachment_url( $thumbnail_id );

			// 	echo '<div class="brand-box">';

			// 	echo '<a href="'.get_term_link($category).'" >';
			// 	echo '<img src="'.$image.'">';
			// 	echo '</a>';
			// 	echo '</div>';
			// }


			echo '</div>';
		}
		endwhile;
		?>
			</div>

</main>
	</div>

	
<?php
get_footer();