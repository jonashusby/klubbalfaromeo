<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @package     Import_Facebook_Events
 * @subpackage  Import_Facebook_Events/admin
 * @copyright   Copyright (c) 2016, Dharmesh Patel
 * @since       1.0.0
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The admin-specific functionality of the plugin.
 *
 * @package     Import_Facebook_Events
 * @subpackage  Import_Facebook_Events/admin
 * @author     Dharmesh Patel <dspatel44@gmail.com>
 */
class Import_Facebook_Events_Admin {


	public $adminpage_url;
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->adminpage_url = admin_url('admin.php?page=facebook_import' );

		add_action( 'init', array( $this, 'register_scheduled_import_cpt' ) );
		add_action( 'init', array( $this, 'register_history_cpt' ) );
		add_action( 'admin_menu', array( $this, 'add_menu_pages') );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts') );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles') );
		add_action( 'admin_notices', array( $this, 'display_notices') );
		add_filter( 'admin_footer_text', array( $this, 'add_import_facebook_events_credit' ) );
	}

	/**
	 * Create the Admin menu and submenu and assign their links to global varibles.
	 *
	 * @since 1.0
	 * @return void
	 */
	public function add_menu_pages() {

		add_menu_page( __( 'Import Facebook Events', 'import-facebook-events' ), __( 'Facebook Import', 'import-facebook-events' ), 'manage_options', 'facebook_import', array( $this, 'admin_page' ), 'dashicons-calendar-alt', '30' );
	}

	/**
	 * Load Admin Scripts
	 *
	 * Enqueues the required admin scripts.
	 *
	 * @since 1.0
	 * @param string $hook Page hook
	 * @return void
	 */
	function enqueue_admin_scripts( $hook ) {

		$js_dir  = IFE_PLUGIN_URL . 'assets/js/';
		wp_register_script( 'import-facebook-events', $js_dir . 'import-facebook-events-admin.js', array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker'), IFE_VERSION );
		wp_enqueue_script( 'import-facebook-events' );
		
	}

	/**
	 * Load Admin Styles.
	 *
	 * Enqueues the required admin styles.
	 *
	 * @since 1.0
	 * @param string $hook Page hook
	 * @return void
	 */
	function enqueue_admin_styles( $hook ) {

	  	$css_dir = IFE_PLUGIN_URL . 'assets/css/';
	 	wp_enqueue_style('jquery-ui', $css_dir . 'jquery-ui.css', false, "1.12.0" );
	 	wp_enqueue_style('import-facebook-events', $css_dir . 'import-facebook-events-admin.css', false, "" );
	}

	/**
	 * Load Admin page.
	 *
	 * @since 1.0
	 * @return void
	 */
	function admin_page() {
		
		?>
		<div class="wrap">
		    <h2><?php esc_html_e( 'Import Facebook Events', 'import-facebook-events' ); ?></h2>
		    <?php
		    // Set Default Tab to Import.
		    $tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'facebook';
		    $ntab = isset( $_GET[ 'ntab' ] ) ? $_GET[ 'ntab' ] : 'import';
		    ?>
		    <div id="poststuff">
		        <div id="post-body" class="metabox-holder columns-2">

		            <div id="postbox-container-1" class="postbox-container">
		            	<?php require_once IFE_PLUGIN_DIR . '/templates/admin-sidebar.php'; ?>
		            </div>
		            <div id="postbox-container-2" class="postbox-container">

		                <h1 class="nav-tab-wrapper">

		                    <a href="<?php echo esc_url( add_query_arg( 'tab', 'facebook', $this->adminpage_url ) ); ?>" class="nav-tab <?php if ( $tab == 'facebook' ) { echo 'nav-tab-active'; } ?>">
		                        <?php esc_html_e( 'Import', 'import-facebook-events' ); ?>
		                    </a>

		                    <a href="<?php echo esc_url( add_query_arg( 'tab', 'scheduled', $this->adminpage_url ) ); ?>" class="nav-tab <?php if ( $tab == 'scheduled' ) { echo 'nav-tab-active'; } ?>">
		                        <?php esc_html_e( 'Scheduled Imports', 'import-facebook-events' ); ?>
		                    </a>

		                    <a href="<?php echo esc_url( add_query_arg( 'tab', 'history', $this->adminpage_url ) ); ?>" class="nav-tab <?php if ( $tab == 'history' ) { echo 'nav-tab-active'; } ?>">
		                        <?php esc_html_e( 'Import History', 'import-facebook-events' ); ?>
		                    </a>

		                    <a href="<?php echo esc_url( add_query_arg( 'tab', 'settings', $this->adminpage_url ) ); ?>" class="nav-tab <?php if ( $tab == 'settings' ) { echo 'nav-tab-active'; } ?>">
		                        <?php esc_html_e( 'Settings', 'import-facebook-events' ); ?>
		                    </a>

		                    <a href="<?php echo esc_url( add_query_arg( 'tab', 'support', $this->adminpage_url ) ); ?>" class="nav-tab <?php if ( $tab == 'support' ) { echo 'nav-tab-active'; } ?>">
		                        <?php esc_html_e( 'Support & Help', 'import-facebook-events' ); ?>
		                    </a>
		                </h1>

		                <div class="import-facebook-events-page">

		                	<?php
		                	if ( $tab == 'facebook' ) {

		                		require_once IFE_PLUGIN_DIR . '/templates/facebook-import-events.php';

		                	} elseif ( $tab == 'settings' ) {

		                		require_once IFE_PLUGIN_DIR . '/templates/import-facebook-events-settings.php';

		                	} elseif ( $tab == 'scheduled' ) {

		                		require_once IFE_PLUGIN_DIR . '/templates/scheduled-import-events.php';

		                	}elseif ( $tab == 'history' ) {

		                		require_once IFE_PLUGIN_DIR . '/templates/import-facebook-events-history.php';

		                	} elseif ( $tab == 'support' ) {

		                		require_once IFE_PLUGIN_DIR . '/templates/import-facebook-events-support.php';

		                	}
			                ?>
		                	<div style="clear: both"></div>
		                </div>

		        </div>
		        
		    </div>
		</div>
		<?php
	}


	/**
	 * Display notices in admin.
	 *
	 * @since    1.0.0
	 */
	public function display_notices() {
		global $ife_errors, $ife_success_msg, $ife_warnings, $ife_info_msg;
		
		if ( ! empty( $ife_errors ) ) {
			foreach ( $ife_errors as $error ) :
			    ?>
			    <div class="notice notice-error is-dismissible">
			        <p><?php echo $error; ?></p>
			    </div>
			    <?php
			endforeach;
		}

		if ( ! empty( $ife_success_msg ) ) {
			foreach ( $ife_success_msg as $success ) :
			    ?>
			    <div class="notice notice-success is-dismissible">
			        <p><?php echo $success; ?></p>
			    </div>
			    <?php
			endforeach;
		}

		if ( ! empty( $ife_warnings ) ) {
			foreach ( $ife_warnings as $warning ) :
			    ?>
			    <div class="notice notice-warning is-dismissible">
			        <p><?php echo $warning; ?></p>
			    </div>
			    <?php
			endforeach;
		}

		if ( ! empty( $ife_info_msg ) ) {
			foreach ( $ife_info_msg as $info ) :
			    ?>
			    <div class="notice notice-info is-dismissible">
			        <p><?php echo $info; ?></p>
			    </div>
			    <?php
			endforeach;
		}

	}

	/**
	 * Register custom post type for scheduled imports.
	 *
	 * @since    1.0.0
	 */
	public function register_scheduled_import_cpt() {
		$labels = array(
			'name'               => _x( 'Scheduled Import', 'post type general name', 'import-facebook-events' ),
			'singular_name'      => _x( 'Scheduled Import', 'post type singular name', 'import-facebook-events' ),
			'menu_name'          => _x( 'Scheduled Imports', 'admin menu', 'import-facebook-events' ),
			'name_admin_bar'     => _x( 'Scheduled Import', 'add new on admin bar', 'import-facebook-events' ),
			'add_new'            => _x( 'Add New', 'book', 'import-facebook-events' ),
			'add_new_item'       => __( 'Add New Import', 'import-facebook-events' ),
			'new_item'           => __( 'New Import', 'import-facebook-events' ),
			'edit_item'          => __( 'Edit Import', 'import-facebook-events' ),
			'view_item'          => __( 'View Import', 'import-facebook-events' ),
			'all_items'          => __( 'All Scheduled Imports', 'import-facebook-events' ),
			'search_items'       => __( 'Search Scheduled Imports', 'import-facebook-events' ),
			'parent_item_colon'  => __( 'Parent Imports:', 'import-facebook-events' ),
			'not_found'          => __( 'No Imports found.', 'import-facebook-events' ),
			'not_found_in_trash' => __( 'No Imports found in Trash.', 'import-facebook-events' ),
		);

		$args = array(
			'labels'             => $labels,
	        'description'        => __( 'Scheduled Imports.', 'import-facebook-events' ),
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => false,
			'show_in_menu'       => false,
			'show_in_admin_bar'  => false,
			'show_in_nav_menus'  => false,
			'can_export'         => false,
			'rewrite'            => false,
			'capability_type'    => 'page',
			'has_archive'        => false,
			'hierarchical'       => false,
			'supports'           => array( 'title' ),
			'menu_position'		=> 5,
		);

		register_post_type( 'fb_scheduled_imports', $args );
	}

	/**
	 * Register custom post type for Save import history.
	 *
	 * @since    1.0.0
	 */
	public function register_history_cpt() {
		$labels = array(
			'name'               => _x( 'Import History', 'post type general name', 'import-facebook-events' ),
			'singular_name'      => _x( 'Import History', 'post type singular name', 'import-facebook-events' ),
			'menu_name'          => _x( 'Import History', 'admin menu', 'import-facebook-events' ),
			'name_admin_bar'     => _x( 'Import History', 'add new on admin bar', 'import-facebook-events' ),
			'add_new'            => _x( 'Add New', 'book', 'import-facebook-events' ),
			'add_new_item'       => __( 'Add New', 'import-facebook-events' ),
			'new_item'           => __( 'New History', 'import-facebook-events' ),
			'edit_item'          => __( 'Edit History', 'import-facebook-events' ),
			'view_item'          => __( 'View History', 'import-facebook-events' ),
			'all_items'          => __( 'All Import History', 'import-facebook-events' ),
			'search_items'       => __( 'Search History', 'import-facebook-events' ),
			'parent_item_colon'  => __( 'Parent History:', 'import-facebook-events' ),
			'not_found'          => __( 'No History found.', 'import-facebook-events' ),
			'not_found_in_trash' => __( 'No History found in Trash.', 'import-facebook-events' ),
		);

		$args = array(
			'labels'             => $labels,
	        'description'        => __( 'Import History', 'import-facebook-events' ),
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => false,
			'show_in_menu'       => false,
			'show_in_admin_bar'  => false,
			'show_in_nav_menus'  => false,
			'can_export'         => false,
			'rewrite'            => false,
			'capability_type'    => 'page',
			'has_archive'        => false,
			'hierarchical'       => false,
			'supports'           => array( 'title' ),
			'menu_position'		=> 5,
		);

		register_post_type( 'ife_import_history', $args );
	}


	/**
	 * Add Import Facebook Events ratting text
	 *
	 * @since 1.0
	 * @return void
	 */
	public function add_import_facebook_events_credit( $footer_text ){
		$page = isset( $_GET['page'] ) ? sanitize_text_field( $_GET['page'] ) : '';
		if ( $page != '' && $page == 'facebook_import' ) {
			$rate_url = 'https://wordpress.org/support/plugin/import-facebook-events/reviews/?rate=5#new-post';

			$footer_text .= sprintf(
				esc_html__( ' Rate %1$sImport Facebook Events%2$s %3$s', 'import-facebook-events' ),
				'<strong>',
				'</strong>',
				'<a href="' . $rate_url . '" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a>'
			);
		}
		return $footer_text;
	}

	/**
	 * Get Plugin array
	 *
	 * @since 1.1.0
	 * @return array
	 */
	public function get_xyuls_themes_plugins(){
		return array(
			'wp-event-aggregator' => esc_html__( 'WP Event Aggregator', 'import-facebook-events' ),
			'import-eventbrite-events' => esc_html__( 'Import Eventbrite Events', 'import-facebook-events' ),
			'import-meetup-events' => esc_html__( 'Import Meetup Events', 'import-facebook-events' ),
			'wp-bulk-delete' => esc_html__( 'WP Bulk Delete', 'import-facebook-events' ),
			'event-schema' => esc_html__( 'Event Schema / Structured Data', 'import-facebook-events' ),
		);
	}

	/**
	 * Get Plugin Details.
	 *
	 * @since 1.1.0
	 * @return array
	 */
	public function get_wporg_plugin( $slug ){

		if( $slug == '' ){
			return false;
		}

		$transient_name = 'support_plugin_box'.$slug;
		$plugin_data = get_transient( $transient_name );
		if( false === $plugin_data ){
			if ( ! function_exists( 'plugins_api' ) ) {
				include_once ABSPATH . '/wp-admin/includes/plugin-install.php';
			}

			$plugin_data = plugins_api( 'plugin_information', array(
				'slug' => $slug,
				'is_ssl' => is_ssl(),
				'fields' => array(
					'banners' => true,
					'active_installs' => true,
				),
			) );

			if ( ! is_wp_error( $plugin_data ) ) {
				set_transient( $transient_name, $plugin_data, 24 * HOUR_IN_SECONDS );
			} else {
				// If there was a bug on the Current Request just leave
				return false;
			}			
		}
		return $plugin_data;
	}
}
