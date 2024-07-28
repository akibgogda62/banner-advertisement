<?php
/*
Plugin Name: Banner Advertisement 
Plugin URI: 
Description: A custom plugin for displaying banner advertisement.
Version: 1.0
Author: Aakib Gogda
Author URI: https://github.com/akibgogda62/
*/

require_once plugin_dir_path(__FILE__) . "settings.php";
require_once plugin_dir_path(__FILE__) . "general-functions.php";

add_action( 'wp_footer', 'custom_banner_output' );

function custom_banner_output() {
    $image_id = get_option( 'banner_logo' );
    $image = wp_get_attachment_image_url( $image_id, 'medium'); 
    $banner_text = get_option('banner_text') ? get_option('banner_text') : 'This is default text';
    $banner_bg_color = get_option('banner_bg_color') ? get_option('banner_bg_color') : '#000000';
    $banner_text_color = get_option('banner_text_color') ? get_option('banner_text_color')  : '#ffffff';
    $custom_css_for_text = get_option('custom_css_for_text') ? get_option('custom_css_for_text') : '';

    // Check if it's the homepage
    if ( is_front_page()) {
        ?>
       
        <div id="custom-banner" class="custom-banner" style="background-color:<?php echo $banner_bg_color;?>;text-align:center">
            
        <div class="custom-banner-inner">
            <img src="<?php echo $image;?>" style="display:<?php echo $image ? 'block' : 'none' ;?>">
            <p style="<?php echo $custom_css_for_text;?>color:<?php echo $banner_text_color;?>"><?php echo $banner_text;?></p>
            <button style="color:<?php echo $banner_text_color;?>" id="close-banner">&times;</button></div>
        </div>
    </div>
        <?php
    }
}