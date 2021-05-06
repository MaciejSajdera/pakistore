<section class="blog-posts">
		<div class="blog-posts-header">
			<a href=<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>>
			<h3>Aktualności / Wydarzenia</h3>
			</a>
		</div>

		<div class="blog-grid blog-grid-home">
					<?php
						// query for the BLOG page
						// displays only 4 most recent posts
						$your_query = new WP_Query( array('pagename=blog', 'posts_per_page' => 3 ) );
						// "loop" through query (even though it's just one page) 
						while ( $your_query->have_posts() ) :
							$your_query->post_title(); $your_query->the_post();
							$category = get_the_category();

							echo '<a class="blog-post" href="'. get_permalink() .'" style="background-image: url(' .get_the_post_thumbnail_url(). ')">';

							echo '<div class="blog-post-caption">';
							echo '<h3 class="uppercase">' . get_the_title() . '</h3>';
							echo '</div>';
							?>
					
					<?php echo '</a>';

				endwhile;
				// reset post data (important!)
				wp_reset_postdata();
				?>

		</div>

		<div class="txt-centered">
		<a class="read-more" href=<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>>Zobacz wszystkie</a>
		</div>
	</section>
	