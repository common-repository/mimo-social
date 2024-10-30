<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://mimo.studio
 * @since      1.0.0
 *
 * @package    Mimo_Social
 * @subpackage Mimo_Social/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mimo_Social
 * @subpackage Mimo_Social/public
 * @author     mimothemes <mimocontact@gmail.com>
 */
class Mimo_Social_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_shortcode( 'mimo_social', array( $this, 'shortcode' ) );
		add_shortcode( 'mimo_social_count', array( $this, 'count_shortcode' ) );

	}

	public static function get_shares_count($network){

		 

		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$general_settings = get_option( 'mimo_social_settings' );
    	
    	
    	$mimo_social_facebook_id = (isset($general_settings['mimo_social_facebook_id'])) ? $general_settings['mimo_social_facebook_id'] : null ;  
    	$mimo_social_twitter_username = (isset($general_settings['mimo_social_twitter_username'])) ? $general_settings['mimo_social_twitter_username'] : null ;  
    	$mimo_social_consumer_key = (isset($general_settings['mimo_social_consumer_key'])) ? $general_settings['mimo_social_consumer_key'] : null ;  
    	$mimo_social_consumer_secret = (isset($general_settings['mimo_social_consumer_secret'])) ? $general_settings['mimo_social_consumer_secret'] : null ;  
    	$mimo_social_oauth_access_token = (isset($general_settings['mimo_social_oauth_access_token'])) ? $general_settings['mimo_social_oauth_access_token'] : null ;  
    	$mimo_social_oauth_access_token_secret = (isset($general_settings['mimo_social_oauth_access_token_secret'])) ? $general_settings['mimo_social_oauth_access_token_secret'] : null ;  
    	$mimo_social_google_api_key = (isset($general_settings['mimo_social_google_api_key'])) ? $general_settings['mimo_social_google_api_key'] : null ;  
    	$mimo_social_google_user = (isset($general_settings['mimo_social_google_user'])) ? $general_settings['mimo_social_google_user'] : null ;  
    	$mimo_social_pinterest_username = (isset($general_settings['mimo_social_pinterest_username'])) ? $general_settings['mimo_social_pinterest_username'] : null ;  
    	

		if($network == 'facebook' && isset($mimo_social_facebook_id ) ) {
			$furl = 'http://graph.facebook.com/?id=' . $actual_link;
			
			
				$fyummy = json_decode(file_get_contents($furl), true);
				
				$fshares = $fyummy['shares'];

				if(isset($fshares))	return $fshares;
			
		} else if($network == 'twitter') {

		


		} else if($network == 'pinterest' && isset($mimo_social_pinterest_username ) ) {
			$furl = 'http://api.pinterest.com/v1/urls/count.json?callback=&url=' . $actual_link;
			
			$api = file_get_contents( 'http://api.pinterest.com/v1/urls/count.json?callback%20&url=' . $furl );

		    $body = preg_replace( '/^receiveCount\((.*)\)$/', '\\1', $api );

		    $count = json_decode( $body );
		    $final_return = $count->count;
		    if($final_return > 0) return  $final_return;
		


		} else if($network == 'google' && isset($mimo_social_google_api_key ) ) {

			$furl = 'https://clients6.google.com/rpc?key=' . $actual_link;
			$curl = curl_init();
		    curl_setopt( $curl, CURLOPT_URL, "https://clients6.google.com/rpc" );
		    curl_setopt( $curl, CURLOPT_POST, 1 );
		    curl_setopt( $curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $furl . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]' );
		    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
		    curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-type: application/json' ) );
		    $curl_results = curl_exec( $curl );
		    curl_close( $curl );
		    $json = json_decode( $curl_results, true );

		    $final_return =  intval( $json[0]['result']['metadata']['globalCounts']['count'] );
			if($final_return > 0) return $final_return;

		}  else if($network == false) {

			return;
		}

	}

	
	

	public static function display_share_buttons($the_class = 'mimo-social-share-buttons'){
		$general_settings = get_option( 'mimo_social_settings' );
		$actual_link = get_permalink(get_the_id() );;
    	
    	$mimo_social_settings_activated = isset($general_settings['mimo_social_activated']) ? $general_settings['mimo_social_activated'] : NULL;
    	$mimo_social_settings_where = isset($general_settings['mimo_social_where']) ? $general_settings['mimo_social_where'] : NULL;
    	if ( NULL !== $mimo_social_settings_activated ) :
	    	echo '<div class="mimo-social-shares btn-group ' . esc_attr($the_class) . '">';

	    	if(in_array('facebook', $mimo_social_settings_activated ) == true ) {

	    		$fshares_count = self::get_shares_count('facebook');

	    		echo '<a class="btn-facebook btn btn-mimo-social  btn-secondary" href="https://www.facebook.com/sharer.php?u=' .  $actual_link .'" target="_blank"><i class="fa fa-facebook">' . $fshares_count . '</i></a>';

	    	}

	    	if(in_array('twitter', $mimo_social_settings_activated ) == true ) {

	    		$tshares_count = self::get_shares_count('twitter');

	    		echo '<a class="btn-twitter btn btn-mimo-social  btn-secondary" href="https://twitter.com/intent/tweet?url=' .  $actual_link .'" target="_blank"><i class="fa fa-twitter">' . $tshares_count . '</i></a>';

	    	}

	    	if(in_array('google', $mimo_social_settings_activated ) == true ) {

	    		$gshares_count = self::get_shares_count('google');

	    		echo '<a class="btn-google btn btn-mimo-social btn-secondary" href="https://plus.google.com/share?url=' .  $actual_link .'" target="_blank"><i class="fa fa-google-plus">' . $gshares_count . '</i></a>';

	    	}

	    	if(in_array('pinterest', $mimo_social_settings_activated ) == true ) {

	    		$pshares_count = self::get_shares_count('pinterest');

	    		echo '<a class="btn-pinterest btn btn-mimo-social  btn-secondary" href="https://pinterest.com/pin/create/bookmarklet/?url=' .  $actual_link .'" target="_blank"><i class="fa fa-pinterest">' . $pshares_count . '</i></a>';

	    	}



	    	echo '</div>';
	    endif;

    	
	}

	public static function display_link_buttons(){
		$general_settings = get_option( 'mimo_social_settings' );

		$mimo_social_facebook_url = (isset($general_settings['mimo_social_facebook_url'])) ? $general_settings['mimo_social_facebook_url'] : null ;  
    	$mimo_social_twitter_url = (isset($general_settings['mimo_social_twitter_url'])) ? $general_settings['mimo_social_twitter_url'] : null ;  
    	$mimo_social_google_url = (isset($general_settings['mimo_social_google_url'])) ? $general_settings['mimo_social_google_url'] : null ;  
    	$mimo_social_pinterest_url = (isset($general_settings['mimo_social_pinterest_url'])) ? $general_settings['mimo_social_pinterest_url'] : null ;  
    	$mimo_social_youtube_url = (isset($general_settings['mimo_social_youtube_url'])) ? $general_settings['mimo_social_youtube_url'] : null ;  
    	$mimo_social_instagram_url = (isset($general_settings['mimo_social_instagram_url'])) ? $general_settings['mimo_social_instagram_url'] : null ;  


		
    	
    	$mimo_social_settings_activated = $general_settings['mimo_social_activated'];

    	$mimo_social_settings_where = isset($general_settings['mimo_social_where']) ? $general_settings['mimo_social_where'] : NULL;

    	echo '<div class="mimo-social-links">';

    	if(in_array('facebook', $mimo_social_settings_activated ) == true  && $mimo_social_facebook_url !== null ) {


    		echo '<a class="btn-facebook btn btn-mimo-social  btn-secondary" href="' .  esc_url($mimo_social_facebook_url) .'" target="_blank"><i class="fa fa-facebook"></i></a>';

    	}

    	if(in_array('twitter', $mimo_social_settings_activated ) == true   && isset($mimo_social_twitter_url) ) {


    		echo '<a class="btn-twitter btn btn-mimo-social  btn-secondary" href="' .  esc_url($mimo_social_twitter_url) .'" target="_blank"><i class="fa fa-twitter"></i></a>';

    	}

    	if(in_array('google', $mimo_social_settings_activated ) == true   && isset($mimo_social_google_url) ) {


    		echo '<a class="btn-google btn btn-mimo-social btn-secondary" href="' .  esc_url($mimo_social_google_url) .'" target="_blank"><i class="fa fa-google-plus"></i></a>';

    	}

    	if(in_array('pinterest', $mimo_social_settings_activated ) == true   && isset($mimo_social_pinterest_url) ) {


    		echo '<a class="btn-pinterest btn btn-mimo-social  btn-secondary" href="' .  esc_url($mimo_social_pinterest_url) .'" target="_blank"><i class="fa fa-pinterest"></i></a>';

    	}

    	if(in_array('youtube', $mimo_social_settings_activated ) == true   && isset($mimo_social_youtube_url) ) {


    		echo '<a class="btn-youtube btn btn-mimo-social  btn-secondary" href="' .  esc_url($mimo_social_youtube_url) .'" target="_blank"><i class="fa fa-youtube"></i></a>';

    	}

    	if(in_array('instagram', $mimo_social_settings_activated ) == true   && isset($mimo_social_instagram_url) ) {


    		echo '<a class="btn-instagram btn btn-mimo-social  btn-secondary" href="' .  esc_url($mimo_social_instagram_url) .'" target="_blank"><i class="fa fa-instagram"></i></a>';

    	}

    	echo '</div>';

    	
	}




	public function display_count_buttons(){
		$general_settings = get_option( 'mimo_social_settings' );
		
    	$mimo_social_settings_activated = $general_settings['mimo_social_activated']; 
    	$mimo_social_facebook_id = $general_settings['mimo_social_facebook_id'];  
    	$mimo_social_twitter_username = $general_settings['mimo_social_twitter_username'];  
    	$mimo_social_consumer_key = $general_settings['mimo_social_consumer_key'];  
    	$mimo_social_consumer_secret = $general_settings['mimo_social_consumer_secret'];  
    	$mimo_social_oauth_access_token = $general_settings['mimo_social_oauth_access_token'];  
    	$mimo_social_oauth_access_token_secret = $general_settings['mimo_social_oauth_access_token_secret'];  

    	$mimo_social_google_api_key = $general_settings['mimo_social_google_api_key'];  
    	$mimo_social_google_user = $general_settings['mimo_social_google_user'];  
    	$mimo_social_pinterest_username = $general_settings['mimo_social_pinterest_username'];  

    	?>
    	
		 
		 <div id="mimo_social_count">
		    
		   
		    
		   
		 
		  	<button class="button"  id="mimo_social_total"></button>
		  	<button class="button" id="mimo_social_total_k"></button>


    	<?php if(in_array('facebook', $mimo_social_settings_activated ) == true && isset($mimo_social_facebook_id) ) {

    		

    		echo ' <a class="button button-facebook facebook button-mimo-count button-mimo-social" href="https://www.facebook.com/' . $mimo_social_facebook_id . '" target="_blank"><i class="fa fa-facebook"></i><span class="count"></span>Likes</a>';

    	}

    	if(in_array('twitter', $mimo_social_settings_activated ) == true  && isset($mimo_social_twitter_username) && isset($mimo_social_consumer_key) && isset($mimo_social_consumer_secret) && isset($mimo_social_oauth_access_token) && isset($mimo_social_oauth_access_token_secret) ){

    		

    		echo '<a class="button button-twitter twitter button-mimo-count button-mimo-social"  href="https://www.twitter.com/' . $mimo_social_twitter_username . '" target="_blank"><i class="fa fa-twitter"></i><span class="count"></span>Followers</a>';

    	}

    	if(in_array('google', $mimo_social_settings_activated ) == true && isset($mimo_social_google_user)  && isset($mimo_social_google_api_key)  ) {

    		

    		echo '<a class="button button-google google button-mimo-count button-mimo-social"  href="https://www.plus.google.com/' . $mimo_social_google_user . '" target="_blank"><i class="fa fa-google-plus"></i><span class="count"></span>Followers</a>';

    	}

    	if(in_array('pinterest', $mimo_social_settings_activated ) == true  && isset($mimo_social_pinterest_username)  ) {

    		

    		echo ' <a class="button button-pinterest pinterest button-mimo-count button-mimo-social"  href="https://www.pinterest.com/' . $mimo_social_pinterest_username . '" target="_blank"><i class="fa fa-pinterest"></i><span class="count"></span>Followers</a>';

    	}

    	echo ' </div>';


	}



	

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mimo_Social_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mimo_Social_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mimo-social-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		$general_settings1 = get_option( 'mimo_social_settings' );
		$general_settings= json_encode($general_settings1);
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mimo_Social_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mimo_Social_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mimo-social-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script($this->plugin_name, 'mimo_social_general_settings', $general_settings);

	}

	public function shortcode($atts) {
		// Shortcode that shows the social buttons
		
		 $atts = shortcode_atts( array(

			'id' => '',
			'class' => 'mimo-social-share-buttons'

		) , $atts );

		 $args = array();


	
	// Parse incoming $args into an array and merge it with $defaults
		$args = wp_parse_args( $atts );
		$class = $args['class'];
		 	
             ob_start();
    self::display_share_buttons($class);
     $output = ob_get_clean();
     //print $output; // debug
     return $output;

	}

	public function count_shortcode($atts) {
		// Shortcode that shows the social buttons
		
	 	extract( shortcode_atts( array(

			'id' => '',

		) , $atts ) );

	 	$args = array();


	
		// Parse incoming $args into an array and merge it with $defaults
		$args = wp_parse_args( $atts );

		 	
     	ob_start();
	    self::display_count_buttons();
     	$output = ob_get_clean();
     	return $output;

	}

}
