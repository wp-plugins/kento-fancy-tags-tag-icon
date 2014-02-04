<?php
/*
Plugin Name: Kento Fancy Tags
Plugin URI: http://kentothemes.com
Description: Tag icon and tag description on hover box.
Version: 1.0
Author: KentoThemes
Author URI: http://kentothemes.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


wp_enqueue_script('jquery');
define('KENTO_FANCY_TAGS_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
wp_enqueue_style('kento-fancy-tags-style', KENTO_FANCY_TAGS_PLUGIN_PATH.'css/style.css');

wp_enqueue_script('kento-fancy-tags-js', plugins_url( '/js/kento-fancy-tags-ajax.js' , __FILE__ ) , array( 'jquery' ));
wp_localize_script( 'kento-fancy-tags-js', 'kento_fancy_tags_ajax', array( 'kento_fancy_tags_ajaxurl' => admin_url( 'admin-ajax.php')));



function kento_fancy_tags_ajax()
	{	

		$tag_name = sanitize_text_field($_POST['tag_name']);
		$tag_id = sanitize_text_field($_POST['tag_id']);
		$tag_count = sanitize_text_field($_POST['tag_count']);	
		$tag_icon = KENTO_FANCY_TAGS_PLUGIN_PATH."tag-images/".$tag_name.".png";







if (is_exist_image($tag_icon)=="true")
	{
		$fancy_tags.= "<div class='fancy-tags-tooltip'>";
		$fancy_tags.= "<div id='fancy-tags-header'><span class='tag-name'><img width='30px' height='30px' src='".$tag_icon."' />".$tag_name."</span><span class='tag-count'>".$tag_count." post</span></div>";
		$fancy_tags.= "<div class='fancy-tags-description'>".tag_description($tag_id)."</div>";
		$fancy_tags.= "</div>";		
	}

else
	{
		$fancy_tags.= "<div class='fancy-tags-tooltip'>";
		$fancy_tags.= "<div id='fancy-tags-header'><span class='tag-name'>".$tag_name."</span><span class='tag-count'>".$tag_count." post</span></div>";
		$fancy_tags.= "<div class='fancy-tags-description'>".tag_description($tag_id)."</div>";
		$fancy_tags.= "</div>";
	} 

	
		echo $fancy_tags;
		die();
		return true;
		
	}
add_action('wp_ajax_kento_fancy_tags_ajax', 'kento_fancy_tags_ajax');
add_action('wp_ajax_nopriv_kento_fancy_tags_ajax', 'kento_fancy_tags_ajax');



function is_exist_image($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    // don't download content
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if(curl_exec($ch)!==FALSE)
    {
        return true;
    }
    else
    {
        return false;
    }
}







function fancy_tags(){
$posttags = get_the_tags();
$count=0;
if ($posttags) {
  foreach($posttags as $tag) {
    $count++;

	$tag_icon = KENTO_FANCY_TAGS_PLUGIN_PATH."tag-images/".$tag->name.".png";

if (is_exist_image($tag_icon)=="true") {
			$the_tags.= "<a href='".get_tag_link($tag->term_id)."' class='fancy-tags' tag-count='".$tag->count."' tag-id='".$tag->term_id."'><img width='16px' height='16px' src='".$tag_icon."' /><span class='tag-text'>".$tag->name."</span></a>, ";
}

else
	{
			$the_tags.= "<a href='".get_tag_link($tag->term_id)."' class='fancy-tags' tag-count='".$tag->count."' tag-id='".$tag->term_id."'><span class='tag-text'>".$tag->name."</span></a>, ";
} 
  

  }
}

return $the_tags;
}
add_filter('the_tags','fancy_tags',10,1);







function fancy_tags_holder($comments_template)
	{	
	
		$kft_popup_top = get_option( 'kft_popup_top' );
		$kft_popup_left = get_option( 'kft_popup_left' );
		$kft_popup_hide = get_option( 'kft_popup_hide' );
		
		$comments_template.=  '<div id="kento-fancy-tags" class="kento-fancy-tags"><div class="spinning-square"></div></div>';
		$comments_template.=  '<span id="kft-popup-top-value">'.$kft_popup_top.'</span>';
		$comments_template.=  '<span id="kft-popup-left-value">'.$kft_popup_left.'</span>';
		
		if($kft_popup_hide==1)
			{		
				$comments_template.=  '<span id="kft-popup-hide-value">1</span>';
			}	
		else
			{
				$comments_template.=  '<span id="kft-popup-hide-value">0</span>';
			}
			
				
	return $comments_template;

	}

add_filter( "the_content", "fancy_tags_holder" );














/////////////////////////////
add_action('admin_init', 'kento_fancy_tags_init' );
add_action('admin_menu', 'kento_fancy_tags_menu');

 function kento_fancy_tags_init(){
	register_setting( 'kento_fancy_tags_plugin_options', 'kft_popup_top');
	register_setting( 'kento_fancy_tags_plugin_options', 'kft_popup_left');	
	register_setting( 'kento_fancy_tags_plugin_options', 'kft_popup_hide');			
    }
function kento_fancy_tags_settings(){
	include('kento-fancy-tags-admin.php');	
}

function kento_fancy_tags_menu() {
	add_menu_page(__('Kento Fancy Tags','kft'), __('KFT Settings','kft'), 'manage_options', 'kft_settings', 'kento_fancy_tags_settings');
}







 ?>