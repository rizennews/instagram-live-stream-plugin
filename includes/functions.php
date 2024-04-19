<?php
// Function to fetch Instagram Live stream embed code
function getInstagramLiveEmbedCode($username) {
    // Construct URL for Instagram Live stream
    $url = "https://www.instagram.com/{$username}/live/";

    // Generate HTML code for embedded Instagram Live stream
    $embed_code = '<iframe src="' . esc_url($url) . '" width="560" height="315" frameborder="0" allowfullscreen></iframe>';

    return $embed_code;
}

// Function to display Instagram Live stream
function displayInstagramLiveStream($username) {
    // Get Instagram Live stream embed code
    $embed_code = getInstagramLiveEmbedCode($username);

    // Generate HTML output with embedded live stream
    if ($embed_code) {
        $output = '<div class="instagram-live-stream">';
        $output .= '<h2>Instagram Live Stream</h2>';
        $output .= $embed_code;
        $output .= '</div>';
        return $output;
    } else {
        return '<p>No live stream available at the moment.</p>';
    }
}

// Function to display feedback form for Instagram
function displayInstagramFeedbackForm() {
    // Generate HTML output for feedback form
    $output = '<div class="instagram-feedback-form">';
    $output .= '<h2>Feedback Form</h2>';
    $output .= '<form action="#" method="post">';
    $output .= '<label for="feedback">Leave your feedback:</label><br />';
    $output .= '<textarea id="feedback" name="feedback" rows="4" cols="50"></textarea><br />';
    $output .= '<input type="submit" value="Submit" />';
    $output .= '</form>';
    $output .= '</div>';

    return $output;
}

// Shortcode to display Instagram Live stream and feedback form together
function instagramLiveStreamWithFeedbackShortcode($atts) {
    // Extract shortcode attributes
    $atts = shortcode_atts(array(
        'username' => 'instagram'
    ), $atts);

    // Display Instagram Live stream and feedback form together
    $output = displayInstagramLiveStream($atts['username']);
    $output .= displayInstagramFeedbackForm();

    return $output;
}
add_shortcode('instagram_live_stream_with_feedback', 'instagramLiveStreamWithFeedbackShortcode');

// Security Function
function sanitizeFacebookLiveStreamData($data) {
    // Sanitize the data fetched from Instagram before displaying it
    return wp_kses_post($data);
}