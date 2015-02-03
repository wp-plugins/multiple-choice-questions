<?php
/*
Plugin Name: Multiple Choice Questions
Plugin URI: 
Description: Multiple Choice Questions builder for WordPress.
Version: 1.0
Author: paratheme
Author URI: http://paratheme.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

define('mcq_plugin_url', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('mcq_plugin_dir', plugin_dir_path( __FILE__ ) );
define('mcq_wp_url', 'https://wordpress.org/plugins/multiple-choice-questions/' );
define('mcq_wp_reviews', 'http://wordpress.org/support/view/plugin-reviews/multiple-choice-questions' );
define('mcq_pro_url','http://paratheme.com/items/multiple-choice-questions-or-simple-quiz-form-builder-for-wordpress/' );
define('mcq_demo_url', 'http://paratheme.com' );
define('mcq_conatct_url', 'http://paratheme.com/contact' );
define('mcq_qa_url', 'http://paratheme.com/qa/' );
define('mcq_plugin_name', 'Multiple Choice Questions' );
define('mcq_share_url', 'https://wordpress.org/plugins/multiple-choice-questions/' );
define('mcq_tutorial_video_url', '//www.youtube.com/embed/8OiNCDavSQg?rel=0' );

require_once( plugin_dir_path( __FILE__ ) . 'includes/mcq-meta.php');
require_once( plugin_dir_path( __FILE__ ) . 'includes/mcq-functions.php');


//Themes php files
require_once( plugin_dir_path( __FILE__ ) . 'themes/flat/index.php');




function mcq_paratheme_init_scripts()
	{
		
		
		
		wp_enqueue_script('jquery');
		
		wp_enqueue_script('mcq_js', plugins_url( '/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script('mcq_js', 'mcq_ajax', array( 'mcq_ajaxurl' => admin_url( 'admin-ajax.php')));
		wp_enqueue_script('jquery.tablednd.js', plugins_url( '/js/jquery.tablednd.js' , __FILE__ ) , array( 'jquery' ));
		wp_enqueue_script('jscolor.js', plugins_url( '/js/jscolor.js' , __FILE__ ) , array( 'jquery' ));

		wp_enqueue_style('mcq_style', mcq_plugin_url.'css/style.css');		

		//ParaAdmin
		wp_enqueue_style('ParaAdmin', mcq_plugin_url.'ParaAdmin/css/ParaAdmin.css');		
		wp_enqueue_script('ParaAdmin', plugins_url( 'ParaAdmin/js/ParaAdmin.js' , __FILE__ ) , array( 'jquery' ));

		// Style for themes
		wp_enqueue_style('mcq-style-flat', mcq_plugin_url.'themes/flat/style.css');			

	}
add_action("init","mcq_paratheme_init_scripts");


register_activation_hook(__FILE__, 'mcq_paratheme_activation');


function mcq_paratheme_activation()
	{
		$mcq_version= "1.0";
		update_option('mcq_version', $mcq_version); //update plugin version.
		
		$mcq_customer_type= "free"; //customer_type "pro"
		update_option('mcq_customer_type', $mcq_customer_type); //update plugin version.
		
	}


function mcq_paratheme_display($atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'id' => "",

				), $atts);


			$post_id = $atts['id'];

			$mcq_themes = get_post_meta( $post_id, 'mcq_themes', true );

			$mcq_paratheme_display ="";

			if($mcq_themes== "flat")
				{
					$mcq_paratheme_display.= mcq_themes_flat($post_id);
				}
			else
				{
					$mcq_paratheme_display.= mcq_themes_flat($post_id);
				}

return $mcq_paratheme_display;



}

add_shortcode('mcq', 'mcq_paratheme_display');









add_action('admin_menu', 'mcq_paratheme_menu_init');


	
function mcq_paratheme_menu_help(){
	include('mcq-help.php');	
}





function mcq_paratheme_menu_init()
	{

			
		add_submenu_page('edit.php?post_type=mcq', __('Help & Upgrade','menu-wpt'), __('Help & Upgrade','menu-wpt'), 'manage_options', 'mcq_paratheme_menu_help', 'mcq_paratheme_menu_help');

	}





?>