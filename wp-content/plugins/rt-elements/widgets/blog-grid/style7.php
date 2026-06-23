<div class="grid-item rts-blog-post <?php echo esc_html($col); ?>">
    <div class="blog-style-seven blog-item">        
        <?php if (has_post_thumbnail()) : ?>
            <a aria-label="blog image" class="thumbnail" href="<?php the_permalink(); ?>">               
                <?php the_post_thumbnail($settings['thumbnail_size']); ?>               
            </a>
            <?php 
        endif; ?>
        <div class="blog_content">
            <div class="blog__meta">
                <?php 
                if ($settings['blog_category_show_hide'] == 'yes') :
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        echo '<div class="rt-cat">';
                        foreach ($categories as $category) {
                            echo '<a aria-label="post category" href="' . esc_url(get_category_link($category->term_id)) . '">';
                            echo esc_html($category->name);
                            echo '</a> ';
                        }
                        echo '</div>';
                    }
                endif;
                // date 
                if ($settings['blog_date_show_hide'] == 'yes') : ?>
                    <div class="rt-date">
                        <?php echo get_the_date(); ?>
                    </div>
                <?php endif; ?>
                <!-- author  -->
                <?php if ($settings['blog_avatar_show_hide'] == 'yes') : ?>
                  <div class="rt-author">
                     <a aria-label="blog author" href="<?php the_permalink(); ?>"><?php echo get_the_author(); ?></a>
                  </div>
                  <?php 
               endif; ?>
            </div>        
            <h3 class="post-title">
                <a aria-label="blog title" href="<?php the_permalink(); ?>">
                    <?php
                        $length = !empty($settings['title_word_count']) ? $settings['title_word_count'] : '10';
                        echo wp_trim_words( get_the_title(), $length, '');
                    ?>
                </a>
            </h3>
            <?php 
            if( !empty( $settings['blog_des'] === 'yes' ) ) : ?>
                <p class="post-des">
                    <?php echo wp_trim_words( get_the_excerpt(), 8, '...'); ?>
                </p>
                <?php 
            endif; 
            if ( !empty( $settings['button_text'] ) ) : ?>
                <div class="blog-btn">
                    <a aria-label="blog button" class="rts-nbg-btn" href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $settings['button_text'] ); ?>
                    <?php if (!empty($settings['button_icon']['value'])) : ?>
                        <span><?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?></span>
                    <?php else : ?>
                        <span><i class="rt rt-arrow-right-regular"></i></span>
                    <?php endif; ?>
                    </a>
                </div>
                <?php 
            endif; ?>
        </div>            
    </div>
</div>
