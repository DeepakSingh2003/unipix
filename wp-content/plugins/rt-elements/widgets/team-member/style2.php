<?php 
$post_id = get_the_ID(); // Always get the current post ID

// Get team categories
$termsArray  = get_the_terms( $post_id, 'team-category' );  
$termsString = ''; 
$termsSlug   = '';

if ( is_array($termsArray) && !empty($termsArray) ) { 
    foreach ( $termsArray as $term ) { 
        $termsString .= 'filter_' . esc_attr($term->slug) . ' '; 
        $termsSlug   .= esc_html($term->name);
    }		
}

// Content & designation
$content     = get_the_content();	
$designation = get_post_meta( $post_id, 'designation', true );

// Social media links
$social_links = [
    'facebook'  => get_post_meta( $post_id, 'facebook', true ),
    'twitter'   => get_post_meta( $post_id, 'twitter', true ),
    'instagram' => get_post_meta( $post_id, 'instagram', true ),
    'linkedin'  => get_post_meta( $post_id, 'linkedin', true ),
];

$fb   = !empty($social_links['facebook'])  ? '<a aria-label="social" href="' . esc_url($social_links['facebook']) . '"><i class="rt rt-facebook-f"></i></a>' : '';
$tw   = !empty($social_links['twitter'])   ? '<a aria-label="social" href="' . esc_url($social_links['twitter']) . '"><i class="rt rt-twitter"></i></a>'     : '';
$ins  = !empty($social_links['instagram']) ? '<a aria-label="social" href="' . esc_url($social_links['instagram']) . '"><i class="rt rt-instagram"></i></a>' : '';
$ldin = !empty($social_links['linkedin'])  ? '<a aria-label="social" href="' . esc_url($social_links['linkedin']) . '"><i class="rt rt-linkedin-in"></i></a>' : '';

// Ensure $settings exists
$team_columns   = isset($settings['team_columns']) ? intval($settings['team_columns']) : 4;
$thumbnail_size = isset($settings['thumbnail_size']) ? $settings['thumbnail_size'] : 'medium';

// Initialize $x
if (!isset($x)) {
    $x = 0;
}
?>

<div class="col-lg-<?php echo esc_html($team_columns); ?> col-md-6 col-xs-1 <?php echo esc_attr($termsString); ?> grid-item">
    <div class="team-member-two">
        <div class="team-image-area">            
				<?php if ( has_post_thumbnail() ) : ?>
				<a aria-label="Team Thumbnail" href="<?php the_permalink(); ?>">
					<div class="thumbnail">
						<?php the_post_thumbnail($thumbnail_size); ?>
					</div>
					</a>
				<?php endif; ?>
				<div class="team-social">
					<div class="share-btn">
						<i class="rt rt-plus"></i>
						<i class="rt rt-minus"></i>
					</div>
					<?php if ( $fb || $tw || $ins || $ldin ): ?>
						<div class="team_social">
							<?php 
								echo wp_kses_post($fb);
								echo wp_kses_post($tw);
								echo wp_kses_post($ins);
								echo wp_kses_post($ldin);
							?>
						</div>
					<?php endif; ?>  
				</div>            
        </div>
        <div class="single-details">
            <a aria-label="Team Name" href="<?php the_permalink(); ?>">
                <h3 class="title"><?php the_title(); ?></h3>
            </a>
            <?php if ( !empty( $designation ) ) : ?>
                <p class="designation"><?php echo esc_html( $designation ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>	

<?php
$x++;
?>
