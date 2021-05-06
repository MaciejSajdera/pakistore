
<section class="categories-carousel">
<div class="swiper-container-categories">

                <!-- Add Pagination -->
                <div class="swiper-pagination swiper-pagination-categories"></div>
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <div class="swiper-slide">
        <span id="shortcode_1_title" class="hide-element"><?= get_field('product_showcase_shortcode_1_title', $post->ID) ?></span>
        <?= get_field('product_showcase_shortcode_1', $post->ID) ?>
        </div>
        <div class="swiper-slide">
        <span id="shortcode_2_title" class="hide-element"><?= get_field('product_showcase_shortcode_2_title', $post->ID) ?></span>
        <?= get_field('product_showcase_shortcode_2', $post->ID) ?>
        </div> 
        <!-- <div class="swiper-slide">
        <span id="shortcode_3_title" class="hide-element"><?= get_field('product_showcase_shortcode_3_title', $post->ID) ?></span>
        <?= get_field('product_showcase_shortcode_3', $post->ID) ?>
        </div> -->
    </div>
</div>
<!-- link below visible on mobile only -->
<a href="<?php echo get_permalink( get_option( 'woocommerce_shop_page_id' ) ); ?>" class="mobile-only mobile-to-shop-button read-more">Pokaż więcej</a>
</section>