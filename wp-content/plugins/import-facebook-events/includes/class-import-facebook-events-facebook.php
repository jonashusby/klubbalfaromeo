<?php
/**
 * Class for Facebook Imports.
 *
 * @link       http://xylusthemes.com/
 * @since      1.0.0
 *
 * @package    Import_Facebook_Events
 * @subpackage Import_Facebook_Events/includes
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class Import_Facebook_Events_Facebook {

	/*
	*	Facebook app ID
	*/
	public $fb_app_id;

	/*
	*	Facebook app Secret
	*/
	public $fb_app_secret;

	/*
	*	Facebook Graph URL
	*/
	public $fb_graph_url;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		global $ife_events;
		
		$options = ife_get_import_options( 'facebook' );
		$this->fb_app_id = isset( $options['facebook_app_id'] ) ? $options['facebook_app_id'] : '';
		$this->fb_app_secret = isset( $options['facebook_app_secret'] ) ? $options['facebook_app_secret'] : '';
		$this->fb_graph_url = 'https://graph.facebook.com/v2.5/';

	}

	/**
	 * import facebook events by oraganization or facebook page.
	 *
	 * @since  1.0.0
	 * @param  array $eventdata  import event data.
	 * @return array/boolean
	 */
	public function import_events( $event_data = array() ){

		global $ife_errors;
		$imported_events = array();
		$facebook_event_ids = array();

		if( $this->fb_app_id == '' || $this->fb_app_secret == '' ){
			$ife_errors[] = __( 'Please insert Facebook app ID and app Secret.', 'import-facebook-events');
			return;
		}			

		$import_by = isset( $event_data['import_by'] ) ? esc_attr( $event_data['import_by'] ) : '';

		$facebook_event_ids = isset( $event_data['event_ids'] ) ? $event_data['event_ids'] : array();
		
		if( !empty( $facebook_event_ids ) ){
			foreach ($facebook_event_ids as $facebook_event_id ) {
				if( $facebook_event_id != '' ){
					$imported_events[] = $this->import_event_by_event_id( $facebook_event_id, $event_data );
				}		
			}
		}
		return $imported_events;
	}

	/**
	 * import facebook event by ID.
	 *
	 * @since  1.0.0
	 * @param  array $eventdata  import event data.
	 * @return int/boolean
	 */
	public function import_event_by_event_id( $facebook_event_id, $event_data = array() ){

		global $ife_errors, $ife_events;
		$options = ife_get_import_options( 'facebook' );
		$update_events = isset( $options['update_events'] ) ? $options['update_events'] : 'no';
		
		if( $facebook_event_id == '' || $this->fb_app_id == '' || $this->fb_app_secret == '' ){
			if( $this->fb_app_id == '' || $this->fb_app_secret == '' ){
				$ife_errors[] = __( 'Please insert Facebook app ID and app Secret.', 'import-facebook-events');
				return;
			}
			return false;
		}

		/*$is_exitsing_event = $this->get_event_by_event_id( $facebook_event_id );
		if ( $is_exitsing_event && $update_events == 'no' ) {
			$ife_errors[] = __( 'Facebook event is already exists.', 'import-facebook-events');
			return;
		}*/

		$facebook_event_object = $this->get_facebook_event_by_event_id( $facebook_event_id );

		return $this->save_facebook_event( $facebook_event_object, $event_data );

	}

	/**
	 * Save (Create or update) facebook imported to The Event Calendar Events.
	 *
	 * @since  1.0.0
	 * @param array  $facebook_event_object Event object get from facebook.com.
	 * @return void
	 */
	public function save_facebook_event( $facebook_event_object = array(), $event_args = array() ) {

		global $ife_events;
		$import_result = '';

		if ( ! empty( $facebook_event_object ) && isset( $facebook_event_object->id ) ) {
			$centralize_array = $this->generate_centralize_array( $facebook_event_object );
			return $ife_events->common->import_events_into( $centralize_array, $event_args );
		}
	}

	/**
	 * get access token
	 *
	 * @since 1.0.0
	 */
	public function get_access_token(){
		$args = array(
			'grant_type' => 'client_credentials', 
			'client_id'  => $this->fb_app_id,
			'client_secret' => $this->fb_app_secret
			);
		$access_token_url = add_query_arg( $args, $this->fb_graph_url . 'oauth/access_token' );
		$access_token_response = wp_remote_get( $access_token_url );
		
		$access_token_response_body = wp_remote_retrieve_body( $access_token_response );
		$access_token_data = json_decode( $access_token_response_body );

		$access_token = ! empty( $access_token_data->access_token ) ? $access_token_data->access_token : null;
		
		return $access_token;
	}
	
	/**
	 * Generate Facebook api URL for grab Event.
	 *
	 * @since 1.0.0
	 */
	public function generate_facebook_api_url( $path = '', $query_args = array() ) {
		$query_args = array_merge( $query_args, array( 'access_token' => $this->get_access_token() ) );
		
		$url = add_query_arg( $query_args, $this->fb_graph_url . $path );

		return $url;
	}

	/**
	 * get a facebook object.
	 *
	 * @since 1.0.0
	 */
	public function get_facebook_response_data( $event_id, $args = array() ) {
		$url = $this->generate_facebook_api_url( $event_id, $args );
		$event_data = $this->get_json_response_from_url( $url );
		return $event_data;
	}

	/**
	 * get a facebook event object
	 *
	 * @since 1.0.0
	 */
	public function get_facebook_event_by_event_id( $event_id ) {
		return $this->get_facebook_response_data(
			$event_id,
			array(
				'fields' => implode(
					',',
					array(
						'id',
						'name',
						'description',
						'start_time',
						'end_time',
						'updated_time',
						'cover',
						'ticket_uri',
						'timezone',
						'owner',
						'place',
					)
				),
			)
		);
	}

	/**
	* Get body data from url and return decoded data.
	*
	* @since 1.0.0
	*/
	public function get_json_response_from_url( $url ) {
		
		$response = wp_remote_get( $url );
		$response = json_decode( wp_remote_retrieve_body( $response ) );
		return $response;
	}

	/**
	 * get all events for facebook page or organizer
	 *
	 * @since 1.0.0
	 * @return array the events
	 */
	public function get_events_for_facebook_page( $facebook_page_id ) {
		
		$args = array(
			'limit' => 9999,
			'since' => date( 'Y-m-d' ),
			'fields' => 'id'
		);

		$url = $this->generate_facebook_api_url( $facebook_page_id . '/events', $args );

		$response = $this->get_json_response_from_url( $url );
		$response_data = !empty( $response->data ) ? (array) $response->data : array();

		if ( empty( $response_data ) || empty( $response_data[0] ) ) {	
			return false;
		}

		$event_ids = array();		
		foreach ( $response_data as $event ) {
			$event_ids[] = $event->id;
		}
		return array_reverse( $event_ids );
	}

	/**
	 * Format events arguments as per TEC
	 *
	 * @since    1.0.0
	 * @param array $facebook_event Facebook event.
	 * @return array
	 */
	public function generate_centralize_array( $facebook_event ) {
		global $ife_events;

		if( !isset( $facebook_event->id ) || $facebook_event->id == '' ){
			return;
		}
		$start_time = $start_time_utc = time();
		$end_time = $end_time_utc = time();
		$utc_offset = '';

		$facebook_id = $facebook_event->id;
		$post_title = isset( $facebook_event->name ) ? $facebook_event->name : '';
		$post_description = isset( $facebook_event->description ) ? $facebook_event->description : '';
		
		$start_time = isset( $facebook_event->start_time ) ? strtotime( $ife_events->common->convert_datetime_to_db_datetime( $facebook_event->start_time ) ) : date( 'Y-m-d H:i:s');
		$end_time = isset( $facebook_event->end_time ) ? strtotime( $ife_events->common->convert_datetime_to_db_datetime( $facebook_event->end_time ) ) : $start_time;

		$ticket_uri = isset( $facebook_event->ticket_uri ) ? esc_url( $facebook_event->ticket_uri ) : '';
		$timezone = $this->get_utc_offset( $facebook_event->start_time );
		$cover_image = isset( $facebook_event->cover->source ) ? $ife_events->common->clean_url( esc_url( $facebook_event->cover->source ) ) : '';

		$xt_event = array(
			'origin'          => 'facebook',
			'ID'              => $facebook_id,
			'name'            => $post_title,
			'description'     => $post_description,
			'starttime_local' => $start_time,
			'endtime_local'   => $end_time,
			'startime_utc'    => '',
			'endtime_utc'     => '',
			'timezone'        => $timezone,
			'utc_offset'      => '',
			'event_duration'  => '',
			'is_all_day'      => '',
			'url'             => $ticket_uri,
			'image_url'       => $cover_image,
		);

		if ( isset( $facebook_event->owner ) ) {
			$xt_event['organizer'] = $this->get_organizer( $facebook_event );
		}

		if ( isset( $facebook_event->place ) ) {
			$xt_event['location'] = $this->get_location( $facebook_event );
		}

		return $xt_event;
		
	}

	/**
	 * Get organizer args for event.
	 *
	 * @since    1.0.0
	 * @param array $eventbrite_event Eventbrite event.
	 * @return array
	 */
	public function get_organizer( $facebook_event ) {

		if ( !isset( $facebook_event->owner->id ) ) {
			return null;
		}

		$organizer_raw_data = $this->get_facebook_response_data(
			$facebook_event->owner->id,
			array(
				'fields' => implode(
					',',
					array(
						'id',
						'name',
						'link',
						'phone'
					)
				),
			)
		);

		if ( !isset( $organizer_raw_data->id ) ) {
			return null;
		}

		$event_organizer = array(
			'ID'          => isset( $organizer_raw_data->id ) ? $organizer_raw_data->id : '',
			'name'        => isset( $organizer_raw_data->name ) ? $organizer_raw_data->name : '',
			'description' => '',
			'email'       => '',
			'phone'       => isset( $organizer_raw_data->phone ) ? $organizer_raw_data->phone : '',
			'url'         => isset( $organizer_raw_data->link ) ? $organizer_raw_data->link : '',
			'image_url'   => '',
			/*'image_url'   => $image_url,*/
		);
		return $event_organizer;

	}

	/**
	 * Get location args for event
	 *
	 * @since    1.0.0
	 * @param array $eventbrite_event Eventbrite event.
	 * @return array
	 */
	public function get_location( $facebook_event ) {

		if ( !isset( $facebook_event->place->id ) ) {
			return null;
		}
		$event_venue = $facebook_event->place;
		$event_location = array(
			'ID'           => isset( $facebook_event->place->id ) ? $facebook_event->place->id : '',
			'name'         => isset( $event_venue->name ) ? $event_venue->name : '',
			'description'  => '',
			'address_1'    => isset( $event_venue->location->street ) ? $event_venue->location->street : '',
			'address_2'    => '',
			'city'         => isset( $event_venue->location->city ) ? $event_venue->location->city : '',
			'state'        => isset( $event_venue->location->state ) ? $event_venue->location->state : '',
			'country'      => isset( $event_venue->location->country ) ? $event_venue->location->country : '',
			'zip'	       => isset( $event_venue->location->zip ) ? $event_venue->location->zip : '',
			'lat'     	   => isset( $event_venue->location->latitude ) ? $event_venue->location->latitude : '',
			'long'		   => isset( $event_venue->location->longitude ) ? $event_venue->location->longitude : '',
			'full_address' => isset( $event_venue->location->street ) ? $event_venue->location->street : '',
			'url'          => '',
			'image_url'    => ''
		);
		return $event_location;
	}

	/**
	 * Get organizer Name based on Organiser ID.
	 *
	 * @since    1.0.0
	 * @param array $organizer_id Organizer event.
	 * @return array
	 */
	public function get_organizer_name_by_id( $organizer_id ) {
		
		if( !$organizer_id || $organizer_id == '' ){
			return;
		}

		$organizer_raw_data = $this->get_facebook_response_data( $organizer_id, array() );
		if( ! isset( $organizer_raw_data->name ) ){
			return '';
		}
		
		$oraganizer_name = isset( $organizer_raw_data->name ) ? $organizer_raw_data->name : '';
		return $oraganizer_name;

	}

	/**
	 * Get UTC offset
	 *
	 * @since    1.0.0
	 */
	public function get_utc_offset( $datetime ) {
		try {
			$datetime = new DateTime( $datetime );
		} catch ( Exception $e ) {
			return '';
		}

		$timezone = $datetime->getTimezone();
		$offset   = $timezone->getOffset( $datetime ) / 60 / 60;

		if ( $offset >= 0 ) {
			$offset = '+' . $offset;
		}

		return 'UTC' . $offset;
	}
}
