<?php
get_header(); ?>
<div class="container">
    <div id="content">
        <div id="reactheme-blog" class="reactheme-blog blog-page">
            <?php
            $col         = '';
            $blog_layout = '';
            $column      = '';
            $blog_grid   = '';

            if (!empty($unipix_option['blog-layout']) || !is_active_sidebar('sidebar-1')) {
                $blog_layout = !empty($unipix_option['blog-layout']) ? $unipix_option['blog-layout'] : '';
                $blog_grid   = !empty($unipix_option['blog-grid']) ? $unipix_option['blog-grid'] : '';
                $blog_grid   = !empty($blog_grid) ? $blog_grid : '12';

                if ($blog_layout == 'full' || !is_active_sidebar('sidebar-1')) {
                    $layout = 'full-layout';
                    $col    = '-full';
                    $column = 'sidebar-none';
                } elseif ($blog_layout == '2left') {
                    $layout = 'full-layout-left';
                } elseif ($blog_layout == '2right') {
                    $layout = 'full-layout-right';
                } else {
                    $col         = '';
                    $blog_layout = '';
                }
            } else {
                $col         = '';
                $blog_layout = '';
                $layout      = '';
                $blog_grid   = '12';
            }
            ?>

            <div class="row padding-<?php echo esc_attr($layout); ?>">
                <div class="contents-sticky col-md-12 col-lg-8<?php echo esc_attr($col); ?> <?php echo esc_attr($layout); ?>">
                    <div class="row">
                        <?php
                        if (have_posts()) :
                            while (have_posts()) : the_post();
                                $post_id   = get_the_id();
                                $author_id = $post->post_author;
                                $no_thumb  = !has_post_thumbnail() ? "no-thumbs" : "";
                                ?>

                                <div class="col-sm-<?php echo esc_attr($blog_grid); ?> col-xs-12">
                                    <article <?php post_class(); ?> >
                                        <div class="blog-item <?php echo esc_attr($no_thumb); ?>">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <div class="blog-img">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail(); ?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>

                                            <div class="full-blog-content">
                                                <div class="user-info">
                                                    <?php
                                                    $show_author = isset($unipix_option['blog-author-post']) ? $unipix_option['blog-author-post'] === 'show' : true;
                                                    if ($show_author) :
                                                        $last_name   = get_user_meta($author_id, 'last_name', true);
                                                        $first_name  = get_user_meta($author_id, 'first_name', true);
                                                        $author_name = (!empty($first_name) && !empty($last_name)) ? esc_html($first_name . ' ' . $last_name) : get_the_author();
                                                        ?>
                                                        <div class="single-info">
                                                            <i class="rt rt-circle-user-regular"></i>
                                                            <span><?php echo esc_html__('by', 'unipix') . ' ' . $author_name; ?></span>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php
                                                    $show_date = isset($unipix_option['blog-date']) ? $unipix_option['blog-date'] : true;
                                                    if ($show_date) : ?>
                                                        <div class="single-info">
                                                            <i class="rt rt-clock-regular"></i>
                                                            <span><?php echo get_the_date(); ?></span>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php
                                                    $show_category = isset($unipix_option['blog-category']) ? $unipix_option['blog-category'] : 'show';
                                                    if ($show_category === 'show' && get_the_category()) : ?>
                                                        <div class="single-info cat">
                                                            <i class="rt rt-tags"></i>
                                                            <span><?php the_category(', '); ?></span>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="title-wrap">
                                                    <h3 class="blog-title">
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h3>
                                                </div>

                                                <?php
                                                $show_excerpt = isset($unipix_option['blog-description']) ? $unipix_option['blog-description'] : true;
                                                if ($show_excerpt) : ?>
                                                    <div class="blog-desc">
                                                        <?php echo unipix_custom_excerpt(30); ?>
                                                    </div>
                                                <?php endif; ?>

                                                <?php
                                                $read_more_text = isset($unipix_option['blog_readmore']) && !empty($unipix_option['blog_readmore'])
                                                    ? $unipix_option['blog_readmore']
                                                    : 'Read More';

                                                $readmore_show = isset($unipix_option['blog_readmore_show']) ? $unipix_option['blog_readmore_show'] : true;

                                                if ($readmore_show) : ?>
                                                    <div class="blog-button">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php echo esc_html($read_more_text); ?>
                                                            <span><i class="rt rt-arrow-right-regular"></i></span>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            <?php endwhile; ?>
                    </div>

                    <div class="pagination-area">
                        <?php the_posts_pagination(); ?>
                    </div>
                <?php else :
                    get_template_part('template-parts/content', 'none');
                endif; ?>
                </div>

                <?php if ($layout != 'full-layout') :
                    get_sidebar();
                endif; ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
