<?php

function writeflow_call_openai($prompt) {
    $api_key = get_option('writeflow_openai_key', '');

    if (empty($api_key)) {
        return new WP_Error('no_api_key', 'OpenAI API key is not set.');
    }

    $response = wp_remote_post('https://api.groq.com/openai/v1/chat/completions', [
        'timeout' => 60,
        'headers' => [
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . $api_key,
        ],
        'body'    => wp_json_encode([
            'model'       => 'openai/gpt-oss-120b',
            'messages' => [
                    ['role' => 'system', 'content' => 'You are a professional blog writer. Always format with proper wordpress blog post format.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
            'temperature' => 0.7,
            'max_completion_tokens' => 8192,
            'top_p' => 0.9,
            'stream' => false,
        ]),
    ]);

    if (is_wp_error($response)) {
        return $response;
    }

    $body = json_decode(wp_remote_retrieve_body($response), true);

    if (!empty($body['error']['message'])) {
        return new WP_Error('ai_error', $body['error']['message']);
    }

    return $body['choices'][0]['message']['content'] ?? new WP_Error('invalid_response', 'Invalid AI response body.');

};
