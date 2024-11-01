<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://trend.app
 * @since      1.0.0
 *
 * @package    trendappend
 * @subpackage trendappend/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    trendappend
 * @subpackage trendappend/admin
 * @author     Your Name <email@example.com>
 */
class trendappend_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $trendappend    The ID of this plugin.
	 */
	protected $options;
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $trendappend       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        $this->set_options();
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in trendappend_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The trendappend_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/trendappend-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in trendappend_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The trendappend_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/trendappend-admin.js', array( 'jquery' ), $this->version, false );

	}
   
	public function register_settings() {

		// register_setting( $option_group, $option_name, $sanitize_callback );
 
		register_setting(
			$this->plugin_name . '-options',
			$this->plugin_name . '-options',
			array( $this, 'validate_options' )
		);

	} // register_settings()

	public function validate_options( $input ) {

		// wp_die( print_r( $input ) );

		$valid 		= array();
		$options 	= $this->get_options_list();

		foreach ( $options as $option ) {

			$name = $option[0];
			$type = $option[1];

			if ( 'repeater' === $type && is_array( $option[2] ) ) {

				$clean = array();

				foreach ( $option[2] as $field ) {

					foreach ( $input[$field[0]] as $data ) {

						if ( empty( $data ) ) { continue; }

						$clean[$field[0]][] = $this->sanitizer( $field[1], $data );

					} // foreach

				} // foreach

				$count = count( $clean );

				for ( $i = 0; $i < $count; $i++ ) {

					foreach ( $clean as $field_name => $field ) {

						$valid[$option[0]][$i][$field_name] = $field[$i];

					} // foreach $clean

				} // for

			} else {

				$valid[$option[0]] = $this->sanitizer( $type, $input[$name] );

			}
			
		}

		return $valid;

	} // validate_options()

	private function sanitizer( $type, $data ) {

		if ( empty( $type ) ) { return; }
		if ( empty( $data ) ) { return; }

		$return 	= '';
		$sanitizer 	= new trendappend_Sanitize();

		$sanitizer->set_data( $data );
		$sanitizer->set_type( $type );

		$return = $sanitizer->clean();

		unset( $sanitizer );

		return $return;

	} // sanitizer()


	public function register_fields() {
  	  //$fields = array("domain_id,");
		add_settings_field(
			'tavuid',
			apply_filters( $this->plugin_name . 'label-tavuid', esc_html__('TrendAppend User ID','trendappend') ),
			array( $this, 'field_text' ),
			$this->plugin_name,
			$this->plugin_name . '-messages',
			array(
				'description' 	=> 'TrendAppend Handle',
				'id' 			=> 'tavuid',
				'value' 		=> '',
			)
		);	 

        add_settings_field(
			'tavpid',
			apply_filters( $this->plugin_name . 'label-tavpid', esc_html__('TrendAppend Affiliate ID','trendappend') ),
			array( $this, 'field_text' ),
			$this->plugin_name,
			$this->plugin_name . '-messages',
			array(
				'description' 	=> 'TrendAppend Handle',
				'id' 			=> 'tavpid',
				'value' 		=> '',
			)
		);	 

		add_settings_field(
			'trend-api-key',
			apply_filters( $this->plugin_name . 'label-trend-api-key', esc_html__('Api Key','trendappend') ),
			array( $this, 'field_text' ),
			$this->plugin_name,
			$this->plugin_name . '-messages',
			array(
				'description' 	=> 'TrendAppend Api Key',
				'id' 			=> 'trend-api-key',
				'value' 		=> '',
			)
		);	  

		add_settings_field(
			'trend-video-list-page',
			apply_filters( $this->plugin_name . 'label-trend-video-list-page', esc_html__('Video List','trendappend') ),
			array( $this, 'field_text' ),
			$this->plugin_name,
			$this->plugin_name . '-messages',
			array(
				'description' 	=> 'TrendAppend Video List',
				'id' 			=> 'trend-video-list-page',
				'value' 		=> '',
			)
		);

		add_settings_field(
			'trend-video-page',
			apply_filters( $this->plugin_name . 'label-trend-video-page', esc_html__('Video Detail Page','trendappend') ),
			array( $this, 'field_text' ),
			$this->plugin_name,
			$this->plugin_name . '-messages',
			array(
				'description' 	=> 'TrendAppend Video Detail Page',
				'id' 			=> 'trend-video-page',
				'value' 		=> '',
			)
		);

		add_settings_field(
			'trend-lead-page',
			apply_filters( $this->plugin_name . 'label-trend-lead-page', esc_html__('Video Lead Page','trendappend') ),
			array( $this, 'field_text' ),
			$this->plugin_name,
			$this->plugin_name . '-messages',
			array(
				'description' 	=> 'TrendAppend Video Lead Page',
				'id' 			=> 'trend-lead-page',
				'value' 		=> '',
			)
		);

		add_settings_field(
			'trend-checkout-page',
			apply_filters( $this->plugin_name . 'label-trend-checkout-page', esc_html__('Video Checkout Page','trendappend') ),
			array( $this, 'field_text' ),
			$this->plugin_name,
			$this->plugin_name . '-messages',
			array(
				'description' 	=> 'TrendAppend Video Checkout Page',
				'id' 			=> 'trend-checkout-page',
				'value' 		=> '',
			)
		);

		add_settings_field(
			'trend-thankyou-page',
			apply_filters( $this->plugin_name . 'label-trend-thankyou-page', esc_html__('Video Thank You Page','trendappend') ),
			array( $this, 'field_text' ),
			$this->plugin_name,
			$this->plugin_name . '-messages',
			array(
				'description' 	=> 'TrendAppend Video Thank You Page',
				'id' 			=> 'trend-thankyou-page',
				'value' 		=> '',
			)
		);
	}

	public function field_select( $args ) {

		$defaults['aria'] 			= '';
		$defaults['blank'] 			= '';
		$defaults['class'] 			= 'widefat';
		$defaults['context'] 		= '';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
		$defaults['selections'] 	=array('post','get');
		$defaults['value'] 			= '';

		apply_filters( $this->plugin_name . '-field-select-options-defaults', $defaults );

		$atts = wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		if ( empty( $atts['aria'] ) && ! empty( $atts['description'] ) ) {

			$atts['aria'] = $atts['description'];

		} elseif ( empty( $atts['aria'] ) && ! empty( $atts['label'] ) ) {

			$atts['aria'] = $atts['label'];

		}

		include( plugin_dir_path( __FILE__ ) . 'partials/trendappend-admin-field-select.php' );

	} // field_select()

  	public function field_text( $args ) {

		$defaults['class'] 			= 'widefat';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
		$defaults['placeholder'] 	= '';
		$defaults['type'] 			= 'text';
		$defaults['value'] 			= '';

		apply_filters( $this->plugin_name . '-field-text-options-defaults', $defaults );

		$atts = wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		include( plugin_dir_path( __FILE__ ) . 'partials/trendappend-admin-field-text.php' );

	} // field_text()
 
	 /**
	 * Creates a textarea field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 * @return 	string 						The HTML field
	 */
	public function field_textarea( $args ) {

		$defaults['class'] 			= 'large-text';
		$defaults['cols'] 			= 50;
		$defaults['context'] 		= '';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
		$defaults['rows'] 			= 10;
		$defaults['value'] 			= '';

		apply_filters( $this->plugin_name . '-field-textarea-options-defaults', $defaults );

		$atts = wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		include( plugin_dir_path( __FILE__ ) . 'partials/trendappend-admin-field-textarea.php' );

	} // field_textarea()

    /**
	 * Creates a checkbox field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 * @return 	string 						The HTML field
	 */
	public function field_checkbox( $args ) {

		$defaults['class'] 			= '';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
		$defaults['value'] 			= 0;

		apply_filters( $this->plugin_name . '-field-checkbox-options-defaults', $defaults );

		$atts = wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		include( plugin_dir_path( __FILE__ ) . 'partials/trendappend-admin-field-checkbox.php' );
	}
	
	/**
	 * Returns an array of options names, fields types, and default values
	 *
	 * @return 		array 			An array of options
	 */
	public static function get_options_list() {

  
		$options = array();
		$options[] = array('tavuid','text','TrendAppend UserId');
		$options[] = array('tavpid','text','TrendAppend Affiliate Id');
		$options[] = array('trend-api-key','text','TrendAppend Api Key');
		$options[] = array('trend-video-list-page','text','Video List Page');
		$options[] = array('trend-video-page','text','Video Page');
		$options[] = array('trend-lead-page','text','Video Lead Page');
		$options[] = array('trend-checkout-page','text','Video Checkout Page');
		$options[] = array('trend-thankyou-page','text','Video Thank You Page');
		
		return $options;

	} // get_options_list()

	public function register_sections() {

		add_settings_section(
			$this->plugin_name . '-messages',
			apply_filters( $this->plugin_name . 'section-title-messages', esc_html__( 'TrendAppend','trendappend') ),
			array( $this, 'section_messages' ),
			$this->plugin_name
		);

	} // register_sections()
	
	/**
	 * Creates a settings section
	 *
	 * @since 		1.0.0
	 * @param 		array 		$params 		Array of parameters for the section
	 * @return 		mixed 						The settings section
	 */
	public function section_messages( $params ) {

		include( plugin_dir_path( __FILE__ ) . 'partials/trendappend-admin-section-messages.php' );

	} // section_messages()

	private function set_options() {
    
		$this->options = get_option( $this->plugin_name . '-options' );
		$this->get_domains();
		$domain_id = get_option("trend-domain-id");
		if(!$domain_id){
			$this->set_domain();
			$domain_id = get_option("trend-domain-id");
			$this->options['trend-domain-id']=$domain_id;
		}else{
            $this->update_domain($domain_id);
			$this->options['trend-domain-id']=$domain_id;
		}
   
	} // set_options()

	private function set_domain(){
     $domain_name = sanitize_text_field($_SERVER['HTTP_HOST']);
	 $data = array();
	 $data['tavuid']=$this->options['tavuid'];
	 $data['domain_name']=$domain_name;
	 $data['video_list']=$this->options['trend-video-list-page'];
	 $data['video']=$this->options['trend-video-page'];
	 $data['lead']=$this->options['trend-lead-page'];
	 $data['checkout']=$this->options['trend-checkout-page'];
	 $data['thankyou']=$this->options['trend-thankyou-page'];
	 $url = TRENDAPPEND_API_URL."/domains/create/";
	 $args = array(
		"method"=>"POST",
		"body"=>json_encode($data)
	 );
	 $response = wp_remote_post($url,$args);
	 $body = wp_remote_retrieve_body( $response );
	 $domain = json_decode($body,true);
	 if(isset($domain['results']['id'])){
       add_option("trend-domain-id",$domain['id']);
	 }
	}

	
	private function update_domain($domain_id){
		
		$data = array();
		$data['tavuid']=$this->options['tavuid'];
		$data['domain_id']=$domain_id;
		$data['video_list']=$this->options['trend-video-list-page'];
		$data['video']=$this->options['trend-video-page'];
		$data['lead']=$this->options['trend-lead-page'];
		$data['checkout']=$this->options['trend-checkout-page'];
		$data['thankyou']=$this->options['trend-thankyou-page'];
		$url = TRENDAPPEND_API_URL."/domains/update/";
		$args = array(
		   "method"=>"POST",
		   "body"=>json_encode($data)
		);
		$response = wp_remote_post($url,$args);
		$body = wp_remote_retrieve_body( $response );
		$domain = json_decode($body,true);
		if(isset($domain['results']['id'])){
		  update_option("trend-domain-id",$domain_id);
		}
	}

	public function trendappend_admin_menu(){
    	add_management_page( 'TREND','TREND','manage_options',$this->plugin_name,array($this,'page_options'));  
    }

	private function get_domains(){
		
		$domain_url = TRENDAPPEND_API_URL."/domains/customer/";
		$args = array(
			"method"=>"POST",
			'body'=>json_encode(array("tavuid"=>$this->options['tavuid']))
		);
		$response = wp_remote_post($domain_url,$args);
		$body = wp_remote_retrieve_body( $response );
		$domain_name = sanitize_text_field($_SERVER['HTTP_HOST']);
		$domains = json_decode($body,true);
		
		if(is_array($domains['results']) && count($domains['results'])){
           foreach($domains['results'] as $domain){
			
              if($domain['domain_name']===$domain_name){
               add_option('trend-domain-id',$domain['id']);
			  
				continue;
			  }
		   }
		}
	}

	public function page_options() {
        $domain_id = $this->options['trend-domain-id'];
		
		include( plugin_dir_path( __FILE__ ) . 'partials/trendappend-admin-page-settings.php' );

	} // page_options()
	
}
