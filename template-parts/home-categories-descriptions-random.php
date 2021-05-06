
<section class="categories-showcase blog-posts-header">
    <h3>Sprawdź naszą ofertę</h3>

    <div class="categories-showcase__wrapper">

    <?php
    $category_showcase = get_field('categories_showcase');

    if( $category_showcase ): ?>
        <a href="<?php echo $category_showcase['categories_showcase_link_1'] ?>">
        <div class="categories-showcase__box" style="background-image: url(<?php echo esc_url( $category_showcase['categories_showcase_image_1'] ); ?>)">
            <!-- <img src="<?php echo esc_url( $category_showcase['categories_showcase_image_1'] ); ?>" alt="<?php echo esc_attr( $category_showcase['image']['alt'] ); ?>" /> -->
            <p><?php echo $category_showcase['categories_showcase_title_1']; ?></p>
        </div>
        </a>

        <a href="<?php echo $category_showcase['categories_showcase_link_2'] ?>">
        <div class="categories-showcase__box" style="background-image: url(<?php echo esc_url( $category_showcase['categories_showcase_image_2'] ); ?>)">
            <p><?php echo $category_showcase['categories_showcase_title_2']; ?></p>
        </div>
        </a>

        <a href="<?php echo $category_showcase['categories_showcase_link_3'] ?>">
        <div class="categories-showcase__box" style="background-image: url(<?php echo esc_url( $category_showcase['categories_showcase_image_3'] ); ?>)">
            <p><?php echo $category_showcase['categories_showcase_title_3']; ?></p>
        </div>
        </a>
    <?php endif; ?>
	
	</div>

</section>