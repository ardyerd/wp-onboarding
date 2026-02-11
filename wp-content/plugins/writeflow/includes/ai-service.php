<?php

function writeflow_call_openai($promtpt) {
    $api_key = get_option('writeflow_openai_key', '');

    if (empty($api_key)) {
        return new WP_Error('no_api_key', 'OpenAI API key is not set.');
    }

    $response = wp_remote_post('https://api.openai.com/v1/completions', [
        'headers' => [
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . $api_key,
        ],
        'body'    => json_encode([
            'model'       => 'gpt-4o-mini',
            'messages' => [
                    ['role' => 'system', 'content' => 'You are a blog writing assistant.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
            'temperature' => 0.7,
        ]),
    ]);

    if (is_wp_error($response)) {
        return $response;
    }

    $body = json_decode(wp_remote_retrieve_body($response), true);

    return $body['choices'][0]['message']['content'] ?? '';

};