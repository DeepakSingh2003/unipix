<?php 
if ( is_plugin_active('the-events-calendar/the-events-calendar.php') ) { 
    foreach ( $events as $event ) {
        // Ensure the $event is set up as the current post
        setup_postdata($event);
        
        // Fetch terms for the event for use in classes
        $terms = get_the_terms($event->ID, 'tribe_events_cat');
        $termsString = !empty($terms) && !is_wp_error($terms) ? join(' ', wp_list_pluck($terms, 'slug')) : ''; 
        $class_infos = get_post_meta( $event->ID, 'unipix_kids_class_info', true );
        $button_text = !empty($settings['button_text']) ? $settings['button_text'] : '';
        ?>
        
        <div class="col-lg-<?php echo esc_html($settings['portfolio_columns']); ?> col-md-<?php echo $settings['col_md']; ?> col-sm-<?php echo $settings['col_sm']; ?> grid-item <?php echo esc_attr($termsString); ?>">
            <div class="kids_class_item event_item">
                <?php if ( has_post_thumbnail($event->ID) ) : ?>
                <div class="thumbnail">
                    <a aria-label="event thumb" href="<?php echo get_permalink($event->ID); ?>">
                        <?php echo get_the_post_thumbnail($event->ID, $settings['thumbnail_size']); ?>
                    </a>
                </div>
                <?php endif; ?>
               <h3 class="rts__single--event--meta--title event-title">
                  <?php $length = !empty($settings['title_word_count']) ? $settings['title_word_count'] : 6; ?>
                  <a aria-label="event title" href="<?php echo get_permalink($event->ID); ?>"><?php echo wp_trim_words(get_the_title($event->ID), $length, ''); ?></a>
               </h3>
               <?php 
                if ( !empty( $class_infos ) && is_array( $class_infos ) ) : ?>
                    <div class="info">
                        <?php foreach ( $class_infos as $class_info ) : 
                            $label = !empty( $class_info['unipix_kids_class_label'] ) ? $class_info['unipix_kids_class_label'] : '';
                            $name  = !empty( $class_info['unipix_kids_class_name'] )  ? $class_info['unipix_kids_class_name']  : '';
                            ?>
                            <p><span><?php echo esc_html( $label ); ?></span> <?php echo esc_html( $name ); ?></p>
                        <?php endforeach; ?>
                    </div>
                    <?php 
                endif; 

                if ( !empty( $button_text ) ) : ?>
                    <a aria-label="button" href="<?php echo get_permalink($event->ID); ?>" class="react_button btn_style5 rt-e-button">
                        <?php echo esc_html( !empty( $button_text ) ? $button_text : 'Enroll Now' ); ?> 
                        <span><i aria-hidden="true" class="rt rt-arrow-up-right"></i></span>
                    </a>
                    <?php
                endif; ?>
            </div>
        </div>
        <?php
    }
}
// Reset post data
wp_reset_postdata();
?>