
<div class="grid-item rts-blog-post <?php echo esc_html($col);?>">
    <div class="single-blog-post blog-item">
        <?php if (has_post_thumbnail()) : ?>
            <div class="blog-thumb">
                <a aria-label="blog thumb" href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                </a>   
            </div>
        <?php endif; ?>    
        <div class="blog-content">
            <div class="post-meta">
                <?php if ($settings['blog_avatar_show_hide'] == 'yes') : ?>
                    <div class="rt-author">
                        <span>
                            <i class="rt-user-1"></i>
                        </span>
                        <a aria-label="blog author" href="<?php the_permalink(); ?>"><?php echo get_the_author(); ?></a>
                    </div>
                    <?php 
                endif;
                if($settings['blog_date_show_hide'] == 'yes') : ?>
                    <div class="rt-date">
                        <span><i class="rt-calendar-days"></i></span>
                        <span><?php echo get_the_date(); ?></span>
                    </div>
                    <?php 
                endif;
                if ($settings['blog_category_show_hide'] == 'yes') :
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        echo '<div class="rt-cat">'; ?>                                              
                        <span><i class="rt-tags"></i></span>
                        <?php 
                        foreach ($categories as $category) {
                            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">';
                            echo esc_html($category->name);
                            echo '</a> ';
                        }
                        echo '</div>';
                    }
                endif; ?>
            </div>
            <a aria-label="blog title" href="<?php the_permalink(); ?>" class="post-title">
                <?php
                    $length = !empty($settings['title_word_count']) ? $settings['title_word_count'] : '7';
                    echo wp_trim_words( get_the_title(), $length, '' );
                ?>
            </a>
        </div>
    </div>
</div>