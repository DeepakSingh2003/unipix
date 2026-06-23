<div class="grid-item rts-blog-post <?php echo esc_html($col); ?>">
   <div class="single-blog blog-item">
         <?php 
         if (has_post_thumbnail()) : ?>
            <div class="blog-thumb">
               <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail($settings['thumbnail_size']); ?>
               </a>
            </div>
            <?php 
         endif; ?>  
         <div class="blog-content">
            <?php 
            if ($settings['blog_category_show_hide'] == 'yes') :
               $categories = get_the_category();
               if (!empty($categories)) {
                     echo '<div class="rt-cat">'; ?>          
                     <?php 
                     foreach ($categories as $category) {
                        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">';
                        echo esc_html($category->name);
                        echo '</a> ';
                     }
                     echo '</div>';
               }
            endif; ?>
            <a aria-label="blog title" href="<?php the_permalink(); ?>" class="post-title">
               <?php 
                  $length = !empty($settings['title_word_count']) ? $settings['title_word_count'] : '22';
                  echo wp_trim_words( get_the_title(), $length, '' );
               ?>
               </a>
            <div class="post-meta">
               <?php
               if ($settings['blog_date_show_hide'] == 'yes') : ?>
                  <div class="rt-date">
                     <span><?php echo get_the_date(); ?></span>
                  </div>
                  <?php
               endif; ?> 
               <?php if ($settings['blog_avatar_show_hide'] == 'yes') : ?>
                  <div class="rt-author">
                     <a aria-label="blog author" href="<?php the_permalink(); ?>"><?php echo get_the_author(); ?></a>
                  </div>
                  <?php 
               endif; ?>
            </div>
         </div>
      </div>
</div>