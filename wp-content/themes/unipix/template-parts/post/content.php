<?php
global $unipix_option;

$show_author = !empty($unipix_option['blog-author-post-single']) ? $unipix_option['blog-author-post-single'] : 'show';
$show_category = !empty($unipix_option['blog-category-single']) ? $unipix_option['blog-category-single'] : 'show';
$show_date = isset($unipix_option['blog-date-single']) ? $unipix_option['blog-date-single'] : true;

$first_name = get_the_author_meta('first_name');
$last_name = get_the_author_meta('last_name');
?>

<div class="single-content-full">
    <div class="user-info">

        <?php if ($show_author === 'show'): ?>
        <div class="single-info author">
            <i class="rt rt-circle-user-regular"></i>
            <span>
                <?php echo esc_html__('by', 'unipix'); ?>  
                <?php 
                if (!empty($first_name) || !empty($last_name)) {
                    echo esc_html(trim("$first_name $last_name"));
                } else {
                    the_author();
                }
                ?>
            </span>
        </div>
        <?php endif; ?>

        <?php if ($show_date): ?>
        <div class="single-info date">
            <i class="rt rt-clock-regular"></i>
            <span><?php echo get_the_date(); ?></span>
        </div>
        <?php endif; ?>

        <?php if ($show_category === 'show'): ?>
        <div class="single-info cat">
            <i class="rt rt-tags"></i>
            <span>
                <?php 
                if (get_the_category()) {
                    the_category(', ');
                }
                ?>
            </span>
        </div>
        <?php endif; ?>

    </div>

    <div class="bs-desc">
        <?php
        the_content();

        wp_link_pages( array(
            'before'      => '<div class="page-links">' . esc_html__('Pages:', 'unipix'),
            'after'       => '</div>',
            'link_before' => '<span class="page-number">',
            'link_after'  => '</span>',
        ) );
        ?>
    </div>

    <?php if (has_tag()): ?>
        <div class="bs-info single-page-info tags">
            <?php
            echo esc_html__('Tags: ', 'unipix');
            the_tags('', ' ', '');
            ?>
        </div>
    <?php endif; ?>
</div>
