<?php
// Add plugin settings page
function instagram_live_stream_plugin_settings_page() {
    add_options_page(
        'Instagram Live Stream Plugin Settings',
        'Instagram Live Settings',
        'manage_options',
        'instagram-live-stream-plugin-settings',
        'instagram_live_stream_plugin_settings_page_content'
    );
}
add_action('admin_menu', 'instagram_live_stream_plugin_settings_page');

// Render plugin settings page content
function instagram_live_stream_plugin_settings_page_content() {
    ?>
    <div class="wrap">
        <h1>Instagram Live Stream Plugin Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('instagram_live_stream_settings_group'); ?>
            <?php do_settings_sections('instagram-live-stream-plugin-settings'); ?>
            <?php submit_button('Save Settings'); ?>
        </form>
        <p>Enter your Instagram API key below:</p>
        <p>If you don't have an Instagram API key, you can obtain one by registering your application on the Instagram Developer Platform.</p>
        <p>To display the Instagram Live stream on your website, use the following shortcode on any page or post:</p>
        <pre>[instagram_live_stream_with_feedback username="your-instagram-username"]</pre>
        <pre>Replace "your-instagram-username" with your actual Instagram username. This shortcode will embed the Instagram Live Stream with the feedback form on your WordPress site.</pre>
        <p>If you find this plugin helpful, consider buying us a coffee!</p>
        <a href="https://www.buymeacoffee.com/designolabs" target="_blank"><img src="https://img.buymeacoffee.com/button-api/?text=Buy%20us%20a%20coffee&emoji=&slug=yourusername&button_colour=FFDD00&font_colour=000000&font_family=Cookie&outline_colour=000000&coffee_colour=ffffff">
    </a>
        <p>This plugin was developed by <a href="https://github.com/rizennews/" target="_blank">Designolabs Studio</a>.</p>
    </div>
    <?php
}

// Initialize plugin settings
function instagram_live_stream_plugin_initialize_settings() {
    register_setting(
        'instagram_live_stream_settings_group',
        'instagram_api_key'
    );

    add_settings_section(
        'instagram_live_stream_settings_section',
        'Instagram Live Stream Settings',
        'instagram_live_stream_settings_section_callback',
        'instagram-live-stream-plugin-settings'
    );

    add_settings_field(
        'instagram_api_key_field',
        'Instagram API Key',
        'instagram_api_key_field_callback',
        'instagram-live-stream-plugin-settings',
        'instagram_live_stream_settings_section'
    );
}
add_action('admin_init', 'instagram_live_stream_plugin_initialize_settings');

// Callback function to render Instagram API Key field
function instagram_api_key_field_callback() {
    $apiKey = get_option('instagram_api_key');
    echo '<input type="text" name="instagram_api_key" value="' . esc_attr($apiKey) . '" />';
}

// Callback function to render Instagram Live Stream Settings section
function instagram_live_stream_settings_section_callback() {
    echo '<p>Enter your Instagram API Key below. You can obtain an API key by registering your application on the Instagram Developer Platform.</p>';
}
