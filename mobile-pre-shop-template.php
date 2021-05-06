<?php

/*
 * Template Name: Mobile Pre-Shop Template
 * description: >-
  Page template without sidebar
 */

get_header();
?>
<div id="primary" class="content-area">

	<main id="primary" class="home-about">

			<header class="entry-header common-template">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
			<?php pakistore_post_thumbnail();

		$orderby = 'desc';
		$hide_empty = false ;
		$cat_args = array(
			'orderby'    => $orderby,
			'order'      => $order,
			'hide_empty' => $hide_empty,
			'parent' => 0
		);
		
		$product_categories = get_terms( 'product_cat', $cat_args );
		
		if( !empty($product_categories) ){

			echo '<div class="categories-grid">';

			foreach ($product_categories as $key => $category) {

				$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
				$category_name = $category->name;
				$image = wp_get_attachment_url( $thumbnail_id );

				if (!$image) {
					$image = wc_placeholder_img_src();
				}

				// echo '<a class="brand-tile" href="'.get_term_link($category).'" >';
				// echo '<p>' .$category_name. '</p>';
				// echo '<img src="'.$image.'">';
				// echo '</a>';

				echo '<a class="category-tile" href="'.get_term_link($category).'">';
					echo '<div style="background-image: url('.$image.')";></div>';
					echo '<p>' .$category_name. '</p>';
				echo '</a>';
			}

			echo '</div>';
		}
		?>

		<h1 class="common-page-header">Zapraszamy do zakupów!</h1>

		<div class="advantages-container">

				<?php
				$box_1 = get_field('adventages_info_1', get_option('page_on_front'));
				if( $box_1 ): ?>
					<div class="advantage-box">
						<img src="<?php echo esc_url( $box_1['box_image'] ); ?>" alt="<?php echo esc_attr( $box_1['image']['alt'] ); ?>" />
						<div class="content">
							<p><?php echo $box_1['box_header']; ?></p>
							<span><?php echo $box_1['box_description']; ?></span>
						</div>
					</div>
				<?php endif; ?>
				<?php
				$box_2 = get_field('adventages_info_2', get_option('page_on_front'));
				if( $box_2 ): ?>
					<div class="advantage-box">
						<img src="<?php echo esc_url( $box_2['box_image'] ); ?>" alt="<?php echo esc_attr( $box_2['image']['alt'] ); ?>" />
						<div class="content">
							<p><?php echo $box_2['box_header']; ?></p>
							<span><?php echo $box_2['box_description']; ?></span>
						</div>
					</div>
				<?php endif; ?>
				<?php
				$box_3 = get_field('adventages_info_3', get_option('page_on_front'));
				if( $box_3 ): ?>
					<div class="advantage-box">
						<img src="<?php echo esc_url( $box_3['box_image'] ); ?>" alt="<?php echo esc_attr( $box_3['image']['alt'] ); ?>" />
						<div class="content">
							<p><?php echo $box_3['box_header']; ?></p>
							<span><?php echo $box_3['box_description']; ?></span>
						</div>
					</div>
				<?php endif; ?>
				<?php
				$box_4 = get_field('adventages_info_4', get_option('page_on_front'));
				if( $box_4 ): ?>
					<div class="advantage-box">
						<img src="<?php echo esc_url( $box_4['box_image'] ); ?>" alt="<?php echo esc_attr( $box_4['image']['alt'] ); ?>" />
						<div class="content">
							<p><?php echo $box_4['box_header']; ?></p>
							<span><?php echo $box_4['box_description']; ?></span>
						</div>
					</div>
				<?php endif; ?>
		</div>
	</main>

		
</div>

	
<?php
get_footer();