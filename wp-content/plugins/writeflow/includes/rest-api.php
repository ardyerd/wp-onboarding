<?php
require_once plugin_dir_path( __FILE__ ) . 'ai-service.php';

add_action( 'rest_api_init', function () {
    register_rest_route( 'writeflow/v1', '/generate-outline', [
        'methods'  => 'POST',
        'callback' => 'writeflow_generate_outline',
        'permission_callback' => function () {
            return current_user_can( 'edit_posts' );
        },
    ] );
} );

function writeflow_generate_outline( WP_REST_Request $request ) {
    $idea = sanitize_text_field( $request->get_param( 'idea' ) );
    $keywords = sanitize_text_field( $request->get_param( 'keywords' ) );

    $prompt = "Create a clear blog post outline with headings and bullet points about: " . $idea;

    $outline = writeflow_call_openai( $prompt );

    if ( is_wp_error( $outline ) ) {
        return new WP_REST_Response( [
            'error' => $outline->get_error_message(),
        ], 500 );
    }

    return new WP_REST_Response( [
        'outline' => $outline,
    ], 200 );
}