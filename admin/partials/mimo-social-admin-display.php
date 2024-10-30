<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://mimo.studio
 * @since      1.0.0
 *
 * @package    Mimo_Social
 * @subpackage Mimo_Social/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
    <div class="postbox">
			
			<h3 class="hndle"><span><?php _e( 'Mimo Social', 'mimo-social' ); ?></span></h3>
			
			<div class="inside">

				<p> <?php _e( 'If you like this plugin please rate it. find support at ', 'mimo-social' ); ?><a href="http://www.mimo.studio"><?php _e( 'mimo.studio', 'mimo-social' ); ?></a></p>

			</div>
	</div>
    <div id="tabs" class="settings-tab">
	<ul>
	    <li><a href="#tabs-1"><?php _e( 'General Settings','mimo-social' ); ?></a></li>
	    
	    
	    
	</ul>
	<div id="tabs-1" class="wrap">
		<div class="postbox">
			<h3 class="hndle"><span><?php _e( 'General Settings', 'mimo-social' ); ?></span></h3>
			<div class="inside">
		    
		
		    <?php

		    

		    $mimo_social_cmb = new_cmb2_box( array(

				'id' => 'mimo_social_options',
				'hookup' => false,
				'show_on' => array( 'key' => 'options-page', 'value' => array( 'mimo-social'  ), ),
				'show_names' => true,
				    ) 
		    );

		    $mimo_social_cmb->add_field( array(
			    'name' => 'Networks Options',
			    'desc' => 'Which network to activate and where to show them by default',
			    'type' => 'title',
			    'id'   => 'networks_test_title'
			) );

		    $mimo_social_cmb->add_field(array(

			'name' => __( 'Activated Networks', 'mimo-social' ),
			'desc' => __( 'Choose which of the networks you want to show', 'mimo-social' ),
			'id' => 'mimo_social_activated',
			'type'    => 'multicheck',
		    'options' => array(
		        'facebook' => 'Facebook',
		        'twitter' => 'Twitter',
		        'google' => 'Google Plus',
		        'pinterest' => 'Pinterest',
		        'youtube' => 'Youtube',
		        'instagram' => 'Instagram',
		    	),
		    ) 
	    );

		    $mimo_social_cmb->add_field(array(

			'name' => __( 'Show sharing buttons', 'mimo-social' ),
			'desc' => __( 'Where to show your social buttons, if none selected they will not show', 'mimo-social' ),
			'id' => 'mimo_social_where',
			'type'    => 'multicheck',
		    'options' => array(
		        'top' => 'Top',
		        'bottom' => 'Bottom',
		    	),
		    ) 
	    );

		    $mimo_social_cmb->add_field( array(
			    'name' => 'Google Plus Options',
			    'type' => 'title',
			    'id'   => 'google_test_title'
			) );

		    $mimo_social_cmb->add_field(array(

			'name' => __( 'Google API key', 'mimo-social' ),
			'desc' => __( 'Needed to show your users shares count, if not included count will not show', 'mimo-social' ),
			'id' => 'mimo_social_google_api_key',
			'type'    => 'text',
		    'default' => '',
		    ) 
	    );

		    $mimo_social_cmb->add_field(array(

			'name' => __( 'Google Plus User', 'mimo-social' ),
			'desc' => __( 'Needed to show your users shares count, if not included count will not show', 'mimo-social' ),
			'id' => 'mimo_social_google_user',
			'type'    => 'text',
		    'default' => '',
		    ) 
	    );

		    $mimo_social_cmb->add_field(array(

			'name' => __( 'Google Plus Url', 'mimo-social' ),
			'desc' => __( 'Needed to show your users shares count, if not included count will not show', 'mimo-social' ),
			'id' => 'mimo_social_google_url',
			'type'    => 'text',
		    'default' => '',
		    ) 
	    );

	    	$mimo_social_cmb->add_field( array(
			    'name' => 'Facebook Options',
			    'type' => 'title',
			    'id'   => 'facebook_test_title'
			) );

	    	$mimo_social_cmb->add_field(array(

			'name' => __( 'Facebook id', 'mimo-social' ),
			'desc' => __( 'Needed to show your users followers count, if not included count will not show', 'mimo-social' ),
			'id' => 'mimo_social_facebook_id',
			'type'    => 'text',
		    'default' => '',
		    ) 
	    );

	    	$mimo_social_cmb->add_field(array(

			'name' => __( 'Facebook Url', 'mimo-social' ),
			'desc' => __( 'Write here your url including http://', 'mimo-social' ),
			'id' => 'mimo_social_facebook_url',
			'type'    => 'text',
		    'default' => '',
		    ) 
	    );

	    	$mimo_social_cmb->add_field( array(
			    'name' => 'Twitter Options',
			    'type' => 'title',
			    'id'   => 'twitter_test_title'
			) );

	    	$mimo_social_cmb->add_field(array(

			'name' => __( 'Twitter username', 'mimo-social' ),
			'desc' => __( 'Needed to show your users followers count, if not included count will not show', 'mimo-social' ),
			'id' => 'mimo_social_twitter_username',
			'type'    => 'text',
		    'default' => '',
		    ) 
	    );

	    	$mimo_social_cmb->add_field(array(

			'name' => __( 'Twitter Consumer Key', 'mimo-social' ),
			'desc' => __( 'Needed to show your users followers count, if not included count will not show', 'mimo-social' ),
			'id' => 'mimo_social_consumer_key',
			'type'    => 'text',
		    'default' => '',
		    ) 
	    );

	    	$mimo_social_cmb->add_field(array(

			'name' => __( 'Twitter Consumer Secret', 'mimo-social' ),
			'desc' => __( 'Needed to show your users followers count, if not included count will not show', 'mimo-social' ),
			'id' => 'mimo_social_consumer_secret',
			'type'    => 'text',
		    'default' => '',
		    ) 
	    );

	    	$mimo_social_cmb->add_field(array(

			'name' => __( 'Twitter Consumer Access Token', 'mimo-social' ),
			'desc' => __( 'Needed to show your users followers count, if not included count will not show', 'mimo-social' ),
			'id' => 'mimo_social_oauth_access_token',
			'type'    => 'text',
		    'default' => '',
		    ) 
	    );

	    	$mimo_social_cmb->add_field(array(

			'name' => __( 'Twitter Oath Access Token Secret', 'mimo-social' ),
			'desc' => __( 'Needed to show your users followers count, if not included count will not show', 'mimo-social' ),
			'id' => 'mimo_social_oauth_access_token_secret',
			'type'    => 'text',
		    'default' => '',
		    ) 
	    );

	    	$mimo_social_cmb->add_field(array(

			'name' => __( 'Twitter Url', 'mimo-social' ),
			'desc' => __( 'Write here your url including http://', 'mimo-social' ),
			'id' => 'mimo_social_twitter_url',
			'type'    => 'text',
		    'default' => '',
		    ) 
	    );

	    	$mimo_social_cmb->add_field( array(
			    'name' => 'Pinterest Options',
			    'type' => 'title',
			    'id'   => 'pinterest_test_title'
			) );
	    
	    $mimo_social_cmb->add_field(array(

			'name' => __( 'Pinterest username', 'mimo-social' ),
			'desc' => __( 'Needed to show your users followers count, if not included count will not show', 'mimo-social' ),
			'id' => 'mimo_social_pinterest_username',
			'type'    => 'text',
		    'default' => '',
		    ) 
	    );

	    $mimo_social_cmb->add_field(array(

			'name' => __( 'Pinterest Url', 'mimo-social' ),
			'desc' => __( 'Write here your url including http://', 'mimo-social' ),
			'id' => 'mimo_social_pinterest_url',
			'type'    => 'text',
		    'default' => '',
		    ) 
	    );

	    $mimo_social_cmb->add_field( array(
			    'name' => 'Youtube Options',
			    'type' => 'title',
			    'id'   => 'pinterest_test_title'
			) );
	    
	    $mimo_social_cmb->add_field(array(

			'name' => __( 'Yotube username', 'mimo-social' ),
			'desc' => __( 'Needed to show your users followers count, if not included count will not show', 'mimo-social' ),
			'id' => 'mimo_social_youtube_username',
			'type'    => 'text',
		    'default' => '',
		    ) 
	    );

	    $mimo_social_cmb->add_field(array(

			'name' => __( 'Yotube Url', 'mimo-social' ),
			'desc' => __( 'Write here your url including http://', 'mimo-social' ),
			'id' => 'mimo_social_youtube_url',
			'type'    => 'text',
		    'default' => '',
		    ) 
	    );

	    $mimo_social_cmb->add_field( array(
			    'name' => 'Instagram Options',
			    'type' => 'title',
			    'id'   => 'pinterest_test_title'
			) );
	    
	    $mimo_social_cmb->add_field(array(

			'name' => __( 'Instagram username', 'mimo-social' ),
			'desc' => __( 'Needed to show your users followers count, if not included count will not show', 'mimo-social' ),
			'id' => 'mimo_social_instagram_username',
			'type'    => 'text',
		    'default' => '',
		    ) 
	    );

	    $mimo_social_cmb->add_field(array(

			'name' => __( 'Instagram Url', 'mimo-social' ),
			'desc' => __( 'Write here your url including http://', 'mimo-social' ),
			'id' => 'mimo_social_instagram_url',
			'type'    => 'text',
		    'default' => '',
		    ) 
	    );
	    
		    
		    cmb2_metabox_form( 'mimo_social_options', 'mimo_social_settings' ); ?>

	   		</div>
	    </div>
	</div>

	
	
	

    
</div>
