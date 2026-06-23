<?php 
if ( is_plugin_active('the-events-calendar/the-events-calendar.php') ) { 
	foreach ( $events as $event ) {
	    // Ensure the $event is set up as the current post
	    setup_postdata($event);	    
	    // Fetch terms for the event for use in classes
	    $terms = get_the_terms($event->ID, 'tribe_events_cat');
	    $termsString = !empty($terms) && !is_wp_error($terms) ? join(' ', wp_list_pluck($terms, 'slug')) : '';
	    ?>
		<div class="col-lg-<?php echo esc_html($settings['portfolio_columns']);?> col-md-<?php echo $settings['col_md']; ?> col-sm-<?php echo $settings['col_sm']; ?> grid-item <?php echo $termsString;?>">
			<div class="event_item">			
					<h3 class="event-title">                    
						<?php 
							$length = !empty($settings['title_word_count']) ? $settings['title_word_count'] : 6;
						?>
						<a aria-label="event title" href="<?php echo get_permalink($event->ID); ?>"><?php echo wp_trim_words(get_the_title($event->ID), $length, ''); ?></a>
					</h3>
						<?php
							$date = tribe_get_start_date($event);
							$location = tribe_get_address($event);
							if(!empty($date)) : ?>
								<div class="date">
									<span><?php echo tribe_get_start_date($event, false, 'F j, Y'); ?></span>
								</div>
								<?php 
							endif; 

							$start_time = tribe_get_start_time( $event, false, '' );
							if ( !empty( $start_time ) ) : ?>
								<div class="time">
									<span><?php echo esc_html($start_time); ?></span>
								</div>
								<?php
							endif; ?> 	
						<?php 
						$venues = $this->get_venue_data($event);
						$has_location = false;
						$location_output = '';
						// Iterate through the venues and check if any have a non-empty address
						foreach ($venues as $venue) {
							if (!empty($venue['address'])) {
								$has_location = true;
								$location_output .= $venue['address'] . '<br>'; // Append each location with a line break
							}
						}
						// Only display the HTML if there is at least one non-empty location
						if ($has_location): ?>
							<div class="location">
								<span><?php echo $location_output; ?></span>
							</div>
							<?php 
						endif; ?>
					<?php 
					if( !empty( $settings['button_text'] ) ) : ?>
						<div class="button">
							<a aria-label="Event Button" class="react_button btn_style5 rt-e-button" href="<?php echo get_permalink($event->ID); ?>">	
								<?php echo wp_kses_post( $settings['button_text'] ); ?>
								<span>
									<i aria-hidden="true" class="rt rt-arrow-up-right"></i>					
								</span>
							</a>	
						</div>
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