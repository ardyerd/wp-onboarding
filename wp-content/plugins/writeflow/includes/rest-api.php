<?php
require_once plugin_dir_path( __FILE__ ) . 'ai-service.php';

add_action( 'rest_api_init', function () {
    register_rest_route( 'wp/v1', '/writeflow/generate-outline', [
        'methods'  => 'POST',
        'callback' => 'writeflow_generate_outline',
        'permission_callback' => function () {
            return current_user_can( 'edit_posts' );
        },
    ] );

    register_rest_route( 'wp/v1', '/writeflow/expand-draft', [
        'methods'  => 'POST',
        'callback' => 'writeflow_expand_draft',
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

function writeflow_expand_draft( WP_REST_Request $request ) {
    $outline = sanitize_textarea_field( $request->get_param( 'outline' ) );

    if (!$outline) {
        return new WP_Error('no_outline', 'Outline is empty');
    }

    $prompt = "
    Expand the following blog outline into a full blog post.
    Rules:
    - Use clear headings
    - 2–4 paragraphs per section
    - Clear introduction
    - Clear conclusion
    - Write in professional but friendly tone

    Outline:
    $outline
    ";

    $expanded_draft = writeflow_call_openai( $prompt );

    if ( is_wp_error( $expanded_draft ) ) {
        return new WP_REST_Response( [
            'error' => $expanded_draft->get_error_message(),
        ], 500 );
    }

    return new WP_REST_Response( [
        'expanded_draft' => $expanded_draft,
    ], 200 );
}

