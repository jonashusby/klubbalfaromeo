<?php
/**
 * The template for displaying all single Event meta
 */	
	global $ife_events;

	if( $event_id == '' ){
		$event_id = get_the_ID();
	}

	$start_date = get_post_meta( $event_id, 'event_start_date', true );
	$start_hour = get_post_meta( $event_id, 'event_start_hour', true );
	$start_minute = get_post_meta( $event_id, 'event_start_minute', true );
	$start_meridian = get_post_meta( $event_id, 'event_start_meridian', true );
	$start_time = $start_hour . ':' . $start_minute . ' ' . $start_meridian; 
	$start_date_formated = date( 'F j', strtotime( $start_date ) );

	$end_date = get_post_meta( $event_id, 'event_end_date', true );
	$end_hour = get_post_meta( $event_id, 'event_end_hour', true );
	$end_minute = get_post_meta( $event_id, 'event_end_minute', true );
	$end_meridian = get_post_meta( $event_id, 'event_end_meridian', true );
	$end_time = $end_hour . ':' . $end_minute . ' ' . $end_meridian;
	$end_date_formated = date( 'F j', strtotime( $end_date ) );

	$website = get_post_meta( $event_id, 'ife_event_link', true );
?>
<div class="organizermain">
  <div class="details">
    <div class="titlemain" > <?php esc_html_e( 'Details','import-facebook-events' ); ?> </div>

    <?php 
    if( $start_date == $end_date ){
    	?>
    	<strong><?php esc_html_e( 'Date','import-facebook-events' ); ?>:</strong>
	    <p><?php echo $start_date_formated; ?></p>

	    <strong><?php esc_html_e( 'Time','import-facebook-events' ); ?>:</strong>
	    <p><?php echo $start_time . ' - ' . $end_time; ?></p>
		<?php
	}else{
		?>
		<strong><?php esc_html_e( 'Start','import-facebook-events' ); ?>:</strong>
	    <p><?php echo $start_date_formated . ' - ' . $start_time; ?></p>

	    <strong><?php esc_html_e( 'End','import-facebook-events' ); ?>:</strong>
	    <p><?php echo $end_date_formated . ' - ' . $end_time; ?></p>
		<?php
	}

	$eve_tags = $eve_cats = array();
	$event_categories = wp_get_post_terms( $event_id, $ife_events->cpt->get_event_categroy_taxonomy() );
	if( !empty( $event_categories ) ){
		foreach ($event_categories as $event_category ) {
			$eve_cats[] = '<a href="'. esc_url( get_term_link( $event_category->term_id ) ).'">' . $event_category->name. '</a>';
		}
	}

	$event_tags = wp_get_post_terms( $event_id, $ife_events->cpt->get_event_tag_taxonomy() );
	if( !empty( $event_tags ) ){
		foreach ($event_tags as $event_tag ) {
			$eve_tags[] = '<a href="'. esc_url( get_term_link( $event_tag->term_id ) ).'">' . $event_tag->name. '</a>';
		}
	}

	if( !empty( $eve_cats ) ){
		?>
		<strong><?php esc_html_e( 'Event Category','import-facebook-events' ); ?>:</strong>
	    <p><?php echo implode(', ', $eve_cats ); ?></p>
		<?php
	}

	if( !empty( $eve_tags ) ){
		?>
		<strong><?php esc_html_e( 'Event Tags','import-facebook-events' ); ?>:</strong>
	    <p><?php echo implode(', ', $eve_tags ); ?></p>
		<?php
	}
	?>

    <?php if( $website != '' ){ ?>
    	<strong><?php esc_html_e( 'Website','import-facebook-events' ); ?>:</strong>
    	<a href="<?php echo esc_url( $website ); ?>"><?php echo $website; ?></a>
    <?php } ?>

  </div>

  <?php
  		// Organizer
		$org_name = get_post_meta( $event_id, 'organizer_name', true );
		$org_email = get_post_meta( $event_id, 'organizer_email', true );
		$org_phone = get_post_meta( $event_id, 'organizer_phone', true );
		$org_url = get_post_meta( $event_id, 'organizer_url', true );

		if( $org_name != '' ){
			?>
			<div class="organizer">
				<div class="titlemain"><?php esc_html_e( 'Organizer','import-facebook-events' ); ?></div>
				<p><?php echo $org_name; ?></p>
			</div>
			<?php if( $org_email != '' ){ ?>
		    	<strong><?php esc_html_e( 'Email','import-facebook-events' ); ?>:</strong>
		    	<a href="<?php echo 'mailto:'.$org_email; ?>"><?php echo $org_email; ?></a>
		    <?php } ?>
		    <?php if( $org_phone != '' ){ ?>
		    	<strong><?php esc_html_e( 'Phone','import-facebook-events' ); ?>:</strong>
		    	<a href="<?php echo 'tel:'.$org_phone; ?>"><?php echo $org_phone; ?></a>
		    <?php } ?>
		    <?php if( $website != '' ){ ?>
		    	<strong><?php esc_html_e( 'Website','import-facebook-events' ); ?>:</strong>
		    	<a href="<?php echo esc_url( $org_url ); ?>"><?php echo $org_url; ?></a>
		    <?php }
		}
    ?>
	<div style="clear: both"></div>
</div>

<?php
$venue_name    = get_post_meta( $event_id, 'venue_name', true );
$venue_address = get_post_meta( $event_id, 'venue_address', true );
$venue['city'] = get_post_meta( $event_id, 'venue_city', true );
$venue['state'] = get_post_meta( $event_id, 'venue_state', true );
$venue['country'] = get_post_meta( $event_id, 'venue_country', true );
$venue['zipcode'] = get_post_meta( $event_id, 'venue_zipcode', true );
$venue['lat'] = get_post_meta( $event_id, 'venue_lat', true );
$venue['lon'] = get_post_meta( $event_id, 'venue_lon', true );
$venue_url = esc_url( get_post_meta( $event_id, 'venue_url', true ) );

if( $venue_name != '' && ( $venue_address != '' || $venue['city'] != '' ) ){
	?>
	<div class="organizermain library">
		<div class="venue">
			<div class="titlemain"> <?php esc_html_e( 'Venue','import-facebook-events' ); ?> </div>
			<p><?php echo $venue_name; ?></p>
			<?php
			if( $venue_address != '' ){
				echo '<p><i>' . $venue_address . '</i></p>';
			}
			$venue_array = array();
			foreach ($venue as $key => $value) {
				if( in_array( $key, array( 'city', 'state', 'country', 'zipcode' ) ) ){
					if( $value != ''){
						$venue_array[] = $value;
					}
				}
			}
			echo '<p><i>' . implode( ", ", $venue_array ) . '</i></p>';
			?>
		</div>
		<?php 
		if( $venue['lat'] != '' && $venue['lon'] ){
			?><div class="map">
			<iframe src="https://maps.google.com/maps?q=<?php echo $venue['lat'].",".$venue['lon'];?>&hl=es;z=14&output=embed" width="100%" height="350" frameborder="0" style="border:0; margin:0;" allowfullscreen></iframe>
		</div>
			<?php
		}
		?>
		<div style="clear: both;"></div>
	</div>
	<?php
}
?>
<div style="clear: both;"></div>