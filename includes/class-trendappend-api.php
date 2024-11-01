<?php
class trendappend_API {
    protected $trendappend_api_url;
    protected $domain_id;
    protected $tavuid;
    protected $tavpid;

    public function __construct(){
      $this->trendappend_api_url = TRENDAPPEND_API_URL; 
      $this->domain_id =get_option("trend-domain-id");
      $options = get_option("trendappend-options");
      
      $this->tavuid = $options['tavuid'];
      if(isset($options['tavpid']))
      $this->tavpid = $options['tavpid'];
      else $this->tavpid = "";
    }
    private function get_trendappend_api_url(){
    	return $this->trendappend_api_url;
    }
    
    private function getIpAddress()
    {
         $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress =sanitize_text_field( wp_unslash($_SERVER['HTTP_CLIENT_IP']));
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = sanitize_text_field( wp_unslash($_SERVER['HTTP_X_FORWARDED_FOR']));
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = sanitize_text_field( wp_unslash($_SERVER['HTTP_X_FORWARDED']));
    else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        $ipaddress = sanitize_text_field( wp_unslash($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']));
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = sanitize_text_field( wp_unslash($_SERVER['HTTP_FORWARDED_FOR']));
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = sanitize_text_field( wp_unslash($_SERVER['HTTP_FORWARDED']));
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = sanitize_text_field( wp_unslash($_SERVER['REMOTE_ADDR']));
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
    }
    
    public function lead($trend_id,$funnel_type=1,$url=""){
    	$ip_address = $this->getIpAddress();
    	$user_agent = wp_kses_post($_SERVER['HTTP_USER_AGENT']);
    	if(isset($_COOKIE['tavsid']))
    	$tavsid = wp_kses_post($_COOKIE['tavsid']);
    	else $tavsid = "";
    	
    	if(isset($_COOKIE['tavuid']))
    	$tavuid = wp_kses_post($_COOKIE['tavuid']);
    	else $tavuid = "";
    	
        if(strlen($this->tavpid)){
            $tavpid = $this->tavpid;
        }elseif(isset($_COOKIE['tavpid']))
    	$tavpid = wp_kses_post($_COOKIE['tavpid']);
    	else $tavpid = "";

        if(isset($_COOKIE['tavclid']))
    	$tavclid = wp_kses_post($_COOKIE['tavclid']);
    	else $tavclid = "";
    	
      $url = $this->get_trendappend_api_url()."/forms/lead/";
      $params = json_encode(array("trend_id"=>$trend_id,"domain_id"=>$this->domain_id,"funnel_type"=>$funnel_type,"platform"=>3,"tavsid"=>$tavsid,"tavpid"=>$tavpid,"tavuid"=>$tavuid,"tavclid"=>$tavclid,"ip_address"=>$ip_address,"user_agent"=>$user_agent,"url"=>$url,"load_js"=>false));
     
      $html = $this->get($url,$params);
      return $html;
    }

    public function checkout($trend_id,$url=""){
        $ip_address = $this->getIpAddress();
        $user_agent = wp_kses_post($_SERVER['HTTP_USER_AGENT']);
        
        if(isset($_COOKIE['tavsid']))
    	$tavsid = wp_kses_post($_COOKIE['tavsid']);
    	else $tavsid = "";
    	
    	if(isset($_COOKIE['tavuid']))
    	$tavuid = wp_kses_post($_COOKIE['tavuid']);
    	else $tavuid = "";
    	
        if(strlen($this->tavpid)){
            $tavpid = $this->tavpid;
        }elseif(isset($_COOKIE['tavpid']))
    	   $tavpid = wp_kses_post($_COOKIE['tavpid']);
    	else $tavpid = "";
    	
        if(isset($_COOKIE['tavclid']))
    	$tavclid = wp_kses_post($_COOKIE['tavclid']);
    	else $tavclid = "";

        $params = json_encode(array("trend_id"=>$trend_id,"platform"=>3,"domain_id"=>$this->domain_id,"tavsid"=>$tavsid,"tavpid"=>$tavpid,"tavuid"=>$tavuid,"tavclid"=>$tavclid,"ip_address"=>$ip_address,"user_agent"=>$user_agent,"url"=>$url,"load_js"=>false));
        $url = $this->get_trend_api_url()."/forms/checkout/";
       
        $html = $this->get($url,$params);
        
        return $html;
    }

    public function player($trend_id,$player_version=1,$url=""){
        $ip_address = $this->getIpAddress();
        $user_agent = wp_kses_post($_SERVER['HTTP_USER_AGENT']);
        	
        $params = json_encode(array("trend_id"=>$trend_id,"domain_id"=>$this->domain_id,"platform"=>3,"player_version"=>$player_version,"ip_address"=>$ip_address,"user_agent"=>$user_agent,"url"=>$url,"load_js"=>false));
        $url = $this->get_trendappend_api_url()."/forms/player/";
       
        $html = $this->get($url,$params);
        
        return $html;
    }
    
    public function thankyou($lead_id,$sale_id,$player_version=1,$url=""){
        $ip_address = $this->getIpAddress();
        $user_agent = wp_kses_post($_SERVER['HTTP_USER_AGENT']);
        	
        $params = json_encode(array("trend_lead_id"=>$lead_id,"sale_lead_id"=>$sale_id,"domain_id"=>$this->domain_id,"platform"=>3,"player_version"=>$player_version,"ip_address"=>$ip_address,"user_agent"=>$user_agent,"url"=>$url,"load_js"=>false));
        $url = $this->get_trendappend_api_url()."/forms/thankyou/";
       
        $html = $this->get($url,$params);
        
        return $html;
    }

    public function video($trend_id,$player_version=1,$url=""){
        $ip_address = $this->getIpAddress();
        $user_agent = wp_kses_post($_SERVER['HTTP_USER_AGENT']);
        	
        $params = json_encode(array("trend_id"=>$trend_id,"domain_id"=>$this->domain_id,"platform"=>3,"player_version"=>$player_version,"ip_address"=>$ip_address,"user_agent"=>$user_agent,"url"=>$url,"load_js"=>false));
        $url = $this->get_trendappend_api_url()."/forms/video/";
       
        $html = $this->get($url,$params);
        
        return $html;
    }

    public function video_list($player_version=1,$url=""){
        $ip_address = $this->getIpAddress();
        $user_agent = wp_kses_post($_SERVER['HTTP_USER_AGENT']);
        if(strlen($this->tavpid)){
            $tavpid = $this->tavpid;
        }elseif(isset($_COOKIE['tavpid']))
    	   $tavpid = wp_kses_post($_COOKIE['tavpid']);
    	else $tavpid = "";

        $params = json_encode(array("domain_id"=>$this->domain_id,"tavuid"=>$this->tavuid,"tavpid"=>$tavpid,"platform"=>3,"player_version"=>$player_version,"ip_address"=>$ip_address,"user_agent"=>$user_agent,"url"=>$url,"load_js"=>false));
       
        $url = $this->get_trendappend_api_url()."/forms/videos/";
       
        $html = $this->get($url,$params);
        
        return $html;
    }

    public function script($trend_id){
        
        $params = json_encode(array("trend_id"=>$trend_id,"load_js"=>false));
        $url = $this->get_trendappend_api_url()."/forms/script/";
       
        $html = $this->get($url,$params);
        
        return $html;
    }
    
    private function get($url,$params){
    	$args = array(
    	'body'=>$params
    	);
        $response = wp_remote_post($url,$args);
        
        $body = wp_remote_retrieve_body($response);
        $forms = json_decode($body,true);


        $html = "";
        if(isset($forms['results'])) {
            $html = $forms['results']['html'];
        }
        return $html;
    }

}
?>