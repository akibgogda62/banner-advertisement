<?php 

// Hook for adding admin menus
add_action('admin_menu', 'banner_advertisement_menu');

// Register and add settings
add_action('admin_init', 'banner_advertisement_settings');

function banner_advertisement_menu() {
    add_menu_page(
        'Banner Advertisement Settings', // Page title
        'Banner Advertisement',          // Menu title
        'manage_options',                // Capability
        'banner-advertisement',          // Menu slug
        'banner_advertisement_settings_page', // Function to display the settings page
        'dashicons-format-image',        // Icon URL
        110                              // Position
    );
}

// Display the settings page
function banner_advertisement_settings_page() {
    ?>
    <div class="wrap">
        <h1>Banner Advertisement Settings</h1>
        <form method="post" action="options.php" enctype="multipart/form-data">
            <?php
            settings_fields('banner_advertisement_settings_group');
            do_settings_sections('banner-advertisement');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function banner_advertisement_settings() {
    register_setting('banner_advertisement_settings_group', 'banner_text');
    register_setting('banner_advertisement_settings_group', 'banner_logo');
    register_setting('banner_advertisement_settings_group', 'banner_bg_color');
    register_setting('banner_advertisement_settings_group', 'banner_text_color');
    register_setting('banner_advertisement_settings_group', 'banner_cookie_store_time');
    register_setting('banner_advertisement_settings_group', 'custom_css_for_text');

    add_settings_section(
        'banner_advertisement_section',
        'Banner Settings',
        'banner_advertisement_section_callback',
        'banner-advertisement'
    );

    add_settings_field(
        'banner_text',
        'Banner Text',
        'banner_text_callback',
        'banner-advertisement',
        'banner_advertisement_section'
    );

    add_settings_field(
        'banner_logo',
        'Banner Logo',
        'banner_logo_callback',
        'banner-advertisement',
        'banner_advertisement_section'
    );

    add_settings_field(
        'banner_bg_color',
        'Background Color',
        'banner_bg_color_callback',
        'banner-advertisement',
        'banner_advertisement_section'
    );

    add_settings_field(
        'banner_text_color',
        'Text Color',
        'banner_text_color_callback',
        'banner-advertisement',
        'banner_advertisement_section'
    );

    add_settings_field(
        'banner_cookie_store_time',
        'Cookie Store Time (in days)',
        'banner_cookie_store_time_callback',
        'banner-advertisement',
        'banner_advertisement_section'
    );

    add_settings_field(
        'custom_css_for_text',
        'Custom CSS For Text',
        'custom_css_for_text_callback',
        'banner-advertisement',
        'banner_advertisement_section'
    );
}

function banner_advertisement_section_callback() {
    echo 'Configure the settings for your banner.';
}

function banner_text_callback() {
    $banner_text = get_option('banner_text','This is default text');
    echo '<input type="text" id="banner_text" name="banner_text" value="' . esc_attr($banner_text) . '" />';
}

function custom_css_for_text_callback() {
    $custom_css_for_text = get_option('custom_css_for_text') ? get_option('custom_css_for_text') : '';
    ?>
    <textarea id="custom_css_for_text" name="custom_css_for_text" rows="5" cols="30" placeholder="<?php echo esc_attr("display:none;\ncolor:red;"); ?>"><?php echo esc_textarea($custom_css_for_text); ?></textarea>
    <?php
}

function banner_cookie_store_time_callback() {
    $banner_cookie_store_time = get_option('banner_cookie_store_time');
    echo '<input type="number" id="banner_cookie_store_time" name="banner_cookie_store_time" value="' . esc_attr($banner_cookie_store_time) . '" />';
}

function banner_logo_callback() {

    $image_id = get_option( 'banner_logo' );
    $image = wp_get_attachment_image_url( $image_id, 'small');


    if( $image ) : ?>
        <a href="#" style="text-decoration: none;" class="agc-banner-upload">
            <img style="height: 100px; width: 100px;" src="<?php echo esc_url( $image ) ?>" />
        </a>
        <a href="#" style="text-decoration: none;" class="agc-banner-remove">&times;</a>
        <input type="hidden" name="banner_logo" value="<?php echo absint( $image_id ) ?>">
    <?php else : ?>
        <a href="#" class="button agc-banner-upload">Upload image</a>
        <a href="#" style="text-decoration: none;display:none" class="agc-banner-remove">&times;</a>
        <input type="hidden" name="banner_logo" value="">
    <?php endif;
     
}

function banner_bg_color_callback() {
    $banner_bg_color = get_option('banner_bg_color') ? get_option('banner_bg_color') : '#000000';
    echo '<input type="text" id="banner_bg_color" name="banner_bg_color" value="' . esc_attr($banner_bg_color) . '" class="banner_bg_color" />';
}

function banner_text_color_callback() {
    $banner_text_color = get_option('banner_text_color') ? get_option('banner_text_color')  : '#ffffff';
    echo '<input type="text" id="banner_text_color" name="banner_text_color" value="' . esc_attr($banner_text_color) . '" class="banner_text_color" />';
}
