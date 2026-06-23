<?php
get_header();
global $unipix_option;

$post_id   = get_the_ID();
$author_id = get_post_field('post_author', $post_id);
$layout    = get_post_meta($post_id, 'layout', true);

$col_side  = ($layout == '2left' || $layout == '2right') ? '8' : '12';
$col_left  = ($layout == '2left') ? 'left-sidebar' : '';
$show_comments = isset($unipix_option['blog-comments']) ? $unipix_option['blog-comments'] : 'show';
$show_author   = isset($unipix_option['blog-author']) ? $unipix_option['blog-author'] : 'show';
?>

<div class="container">
    <div id="content">
        <div class="reactheme-blog-details pt-70 pb-70">
            <div class="row padding-<?php echo esc_attr($col_left); ?>">
                <div class="col-lg-<?php echo esc_attr($col_side) . ' ' . esc_attr($col_left); ?>">
                    <div class="news-details-inner">
                        <?php while (have_posts()) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <?php 
                                $featured_option = isset($unipix_option['featured_show']) ? $unipix_option['featured_show'] : 'show';
                                if ($featured_option !== 'hide' && has_post_thumbnail()) : ?>
                                    <div class="bs-img"><?php the_post_thumbnail(); ?></div>
                                <?php endif; ?>
                                <?php get_template_part('template-parts/post/content', get_post_format()); ?>
                            </article>

                            <?php if ($show_author === 'show') : ?>
                                <?php $author_meta = get_the_author_meta('description'); ?>
                                <?php if (!empty($author_meta)) : ?>
                                    <div class="author-block">
                                        <div class="author-img">
                                            <?php echo get_avatar($author_id, 200); ?>
                                        </div>
                                        <div class="author-desc">
                                            <h3 class="author-title"><?php the_author(); ?></h3>
                                            <?php echo wpautop($author_meta); ?>

                                            <?php
                                            $twitter   = get_the_author_meta('twitter_url', $author_id);
                                            $instagram = get_the_author_meta('instagram_url', $author_id);
                                            $pinterest = get_the_author_meta('pinterest_url', $author_id);
                                            if ($twitter || $instagram || $pinterest) : ?>
                                                <div class="rts-author-social-area">
                                                    <ul>
                                                        <?php if ($twitter) : ?>
                                                            <li><a href="<?php echo esc_url($twitter); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                                        <?php endif; ?>
                                                        <?php if ($instagram) : ?>
                                                            <li><a href="<?php echo esc_url($instagram); ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                                        <?php endif; ?>
                                                        <?php if ($pinterest) : ?>
                                                            <li><a href="<?php echo esc_url($pinterest); ?>" target="_blank"><i class="fab fa-pinterest"></i></a></li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php
                            if ($show_comments === 'show' && (comments_open() || get_comments_number())) {
                                comments_template();
                            }
                            ?>
                        <?php endwhile; ?>
                    </div>
                </div>

                <?php if ($layout == '2left' || $layout == '2right') : ?>
                    <?php get_sidebar('single'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
