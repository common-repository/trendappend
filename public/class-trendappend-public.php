<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://trend.app
 * @since      1.0.0
 *
 * @package    trendappend
 * @subpackage trendappend/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    trendappend
 * @subpackage trendappend/public
 * @author     Your Name <email@example.com>
 */
class trendappend_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $trendappend    The ID of this plugin.
	 */
	private $plugin_name;
    protected $api;
	protected $template_dir;
	protected $templates;
	protected $options;
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
	 * @param      string    $trendappend       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        $this->api = new trendappend_API;
        $this->template_dir = plugin_dir_path(__FILE__) . '../templates/';
    	$this->templates = $this->load_plugin_templates();
		$this->options = get_option("trendappend-options");
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */

	 public function load_plugin_templates() {
        $template_dir = $this->template_dir;
        // Reads all templates from the folder
        if (is_dir($template_dir)) {
            if ($dh = opendir($template_dir)) {
                while (($file = readdir($dh)) !== false) {
                    $full_path = $template_dir . $file;
                    if (filetype($full_path) == 'dir') {
                        continue;
                    }
                    // Gets Template Name from the file
                    $filedata = get_file_data($full_path, array('Template Name' => 'Template Name'));
                    $template_name = $filedata['Template Name'];
                    $templates[$full_path] = $template_name;
                }
                closedir($dh);
            }
        }
        return $templates;
    }
 
    public function register_plugin_templates($theme_templates) {
        // Create the key used for the themes cache
        // Merging the WP templates with this plugin's active templates
        $theme_templates = array_merge($theme_templates, $this->templates);
        return $theme_templates;
    }

	public function view_popup_template($template) {
        global $post;
		$is_plugin = false;
        // If no posts found, return to
        // avoid "Trying to get property of non-object" error
        if (!isset($post)) return $template;
        $user_selected_template = get_page_template_slug($post->ID);
        // We need to check if the selected template
        // is inside the plugin folder
        $file_name = pathinfo($user_selected_template, PATHINFO_BASENAME);
        $template_dir = $this->template_dir;
        if (file_exists($template_dir . $file_name)) {
            $is_plugin = true;
        }
        // If selected template is not empty, it's not the Default Template
        // AND if it's a plugin template, we replace the normal flow to
        // include the selected template
        if ($user_selected_template != '' AND $is_plugin) {
            $template = $user_selected_template;
        }
        return $template;
    } 

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

		wp_enqueue_style( $this->plugin_name,TRENDAPPEND_EMBED_URL.'/api.css', array(), $this->version.time(), 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/trendappend-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name,TRENDAPPEND_EMBED_URL.'/api.js', array( 'jquery' ), time(), false );

	}
 
 
  public function trendappend_checkout($atts,$content=null){
	global $post;
    $url = get_permalink($post);
  	 $metas=shortcode_atts(array(
        'trend_id' => '' 
      ), $atts);

      $trend_id = get_query_var('trend_id');
  
	  if(isset($metas['trend_id']) && strlen($metas['trend_id'])==0 && strlen($trend_id)){
		$metas['trend_id']=$trend_id;
	  }
      if(isset($metas['trend_id']) && strlen($metas['trend_id']))
  	   return html_entity_decode($this->api->checkout($metas['trend_id'],$url));
  	  else return "";
  } 
  
   public function trendappend_lead($atts,$content=null){
	global $post;
	$url = get_permalink($post);
  	 $metas=shortcode_atts(array(
        'trend_id' => '',
        'funnel_type'=> 1 
      ), $atts);
      
	  $trend_id = get_query_var('trend_id');
  
	  if(isset($metas['trend_id']) && strlen($metas['trend_id'])==0 && strlen($trend_id)){
		$metas['trend_id']=$trend_id;
	  }

      if(isset($metas['trend_id']) && strlen($metas['trend_id']))
  	   return html_entity_decode($this->api->lead($metas['trend_id'],$metas['funnel_type'],$url));
  	  else return "";
  } 

  public function trendappend_thankyou($atts,$content=null){
     global $post;
	 $url = get_permalink($post);
	$metas=shortcode_atts(array(
      ), $atts);
	  $metas['trend_sale_id']=0;
	  $metas['trend_lead_id']=0;
      $found = false;
	  if(isset($_GET['trend_sale_id'])){
		$metas['trend_sale_id']=wp_kses_post($_GET['trend_sale_id']);
		$found = true;
	  }

	  if(isset($_GET['trend_lead_id'])){
		$metas['trend_lead_id']=wp_kses_post($_GET['trend_lead_id']);
		$found = true;
	  }
      if($found)
  	   return html_entity_decode($this->api->thankyou($metas['trend_lead_id'],$metas['trend_sale_id'],$metas['player_version'],$url));
  	  else return "";
  }

  public function trendappend_video($atts,$content=null){
	global $post;
	$url = get_permalink($post);
	$metas=shortcode_atts(array(
        'trend_id' =>'',
		'player_version' => "1"
      ), $atts);

      $trend_id = get_query_var('trend_id');
  
	  if(isset($metas['trend_id']) && strlen($metas['trend_id'])==0 && strlen($trend_id)){
		$metas['trend_id']=$trend_id;
	  }
	  
      if(isset($metas['trend_id']) && strlen($metas['trend_id'])){
		return html_entity_decode($this->api->video($metas['trend_id'],$metas['player_version'],$url));
	  }else return "";
  }
  
  public function trendappend_player($atts,$content=null){
	global $post;
	$url = get_permalink($post);
	$metas=shortcode_atts(array(
        'trend_id' => '',
		'player_version' => "1"
      ), $atts);
	 
	  $trend_id = get_query_var('trend_id');
  
	  if(isset($metas['trend_id']) && strlen($metas['trend_id'])==0 && strlen($trend_id)){
		$metas['trend_id']=$trend_id;
	  }

      if(isset($metas['trend_id']) && strlen($metas['trend_id']))
  	   return html_entity_decode($this->api->player($metas['trend_id'],$metas['player_version'],$url));
  	  else return "";
  }

 
  public function trendappend_videos($atts,$content=null){
	global $post;
	$url = get_permalink($post);
	
	$metas=shortcode_atts(array(
		'player_version' => "1",
      ), $atts);
	  
  	   return html_entity_decode($this->api->video_list($metas['player_version'],$url));
  
  }

   public function trendappend_script($atts,$content=null){
	
	$metas=shortcode_atts(array(
        'trend_id' => ''
      ), $atts);

	  $trend_id = get_query_var('trend_id');
  
	  if(isset($metas['trend_id']) && strlen($metas['trend_id'])==0 && strlen($trend_id)){
		$metas['trend_id']=$trend_id;
	  }
	  
      if(isset($metas['trend_id']) && strlen($metas['trend_id']))
  	   return html_entity_decode($this->api->script($metas['trend_id']));
  	  else return "";
  }

  public function add_trendappend_var($vars){
	$vars[] = 'trend_id';
    return $vars;
  }
  
public function register_rewrite_rules(){
 
    $tav_options = get_option("trendappend-options");
	
	$domain = "https://".sanitize_text_field($_SERVER['HTTP_HOST']);
	$video_page = str_replace(array($domain,"/"),"",$tav_options['trend-video-page']);
    $lead_page = str_replace(array($domain,"/"),"",$tav_options['trend-lead-page']);
    $sales_page = str_replace(array($domain,"/"),"",$tav_options['trend-checkout-page']);
		
			add_rewrite_endpoint('trend_id',EP_PERMALINK);
			add_rewrite_rule('^'.$video_page.'/([^/]+)/?','index.php?pagename='.$video_page.'&trend_id=$matches[1]', 'top');
			add_rewrite_rule('^'.$lead_page.'/([^/]+)/?','index.php?pagename='.$lead_page.'&trend_id=$matches[1]', 'top');
			add_rewrite_rule('^'.$sales_page.'/([^/]+)/?','index.php?pagename='.$sales_page.'&trend_id=$matches[1]', 'top');
			
}

}
