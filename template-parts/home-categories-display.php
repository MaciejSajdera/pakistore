
<section class="categories-carousel">

<div class="swiper-container-categories">

    <!-- Add Pagination -->
    <div class="swiper-pagination swiper-pagination-categories"></div>
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">

        <!-- Slides -->
        <div class="swiper-slide">
            <span id="shortcode_1_title" class="hide-element"><?= get_field('product_showcase_shortcode_1_title', $post->ID) ?></span>

            <div>
                <?= do_shortcode(get_field('product_showcase_shortcode_1', $post->ID)) ?>
                <div class="txt-centered">
                    <a href="<?php echo get_field("product_showcase_shortcode_1_link"); ?>" class="mobile-to-shop-button read-more">Pokaż więcej</a>
                </div>
            </div>

        </div>

        <div class="swiper-slide">
            <span id="shortcode_2_title" class="hide-element"><?= get_field('product_showcase_shortcode_2_title', $post->ID) ?></span>

            <div>
                <?= do_shortcode(get_field('product_showcase_shortcode_2', $post->ID)) ?>
                <div class="txt-centered">
                    <a href="<?php echo get_field("product_showcase_shortcode_2_link"); ?>" class="mobile-to-shop-button read-more">Pokaż więcej</a>
                </div>
            </div>

        </div> 

        <div class="swiper-slide">
            <span id="shortcode_3_title" class="hide-element"><?= get_field('product_showcase_shortcode_3_title', $post->ID) ?></span>

            <div>
                <?= do_shortcode(get_field('product_showcase_shortcode_3', $post->ID)) ?>
                <div class="txt-centered">
                        <a href="<?php echo get_field("product_showcase_shortcode_3_link"); ?>" class="mobile-to-shop-button read-more">Pokaż więcej</a>
                </div>
            </div>

        </div>

    </div>
</div>



</section>