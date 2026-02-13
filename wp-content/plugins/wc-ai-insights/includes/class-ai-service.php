<?php

class WCAI_AI_Service {
    
    private $api_key;

    public function __construct( ) {
        $this->api_key = $get_option( 'wcai_openai_api_key', '' );
    }

    public function generate_insight( $data ) {
        
        $prompt = "You are an e-commerce business consultant. 
            Analyze the following WooCommerce monthly data and provide:
            1. Product insight
            2. Marketing insight
            3. Growth opportunity
            4. Risk warning

            Data: " . json_encode($data); 

        $response  = wp_remote_post( 'https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->api_key,
                'Content-Type'  => 'application/json'
            ],
            'body' => json_encode([
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a business analyst.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.7
            ])
        ]);

        if ( is_wp_error( $response ) ) {
            return 'Error: ' . $response->get_error_message();
        }

        $body = wp_json_decode( wp_remote_retrieve_body( $response ), true );

        return $body['choices'][0]['message']['content'] ?? 'No response from AI service.';
    }

}