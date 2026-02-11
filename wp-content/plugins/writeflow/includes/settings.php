<?php

function writeflow_register_settings() {
    register_setting( 'writeflow_settings_group', 'writeflow_openai_key' );

    add_settings_section(
        'writeflow_main_section',
        'WriteFlow AI Settings',
        null,
        'writeflow'
    );

    add_settings_field(
        'writeflow_openai_key',
        'OpenAI API Key',
        'writeflow_openai_key_callback',
        'writeflow',
        'writeflow_main_section'
    );
}
add_action( 'admin_init', 'writeflow_register_settings' );

function writeflow_openai_key_callback() {
    $openai_key = get_option( 'writeflow_openai_key', '' );
    echo '<input type="password" name="writeflow_openai_key" value="' . esc_attr( $openai_key ) . '" size="50" />';
}

function writeflow_add_settings_page() {
    add_options_page(
        'WriteFlow Settings',
        'WriteFlow',
        'manage_options',
        'writeflow',
        'writeflow_settings_page_html'
    );
}
add_action( 'admin_menu', 'writeflow_add_settings_page' );

function writeflow_settings_page_html() {
    ?>
    <div class="wrap">
        <h1>WriteFlow Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'writeflow_settings_group' );
            do_settings_sections( 'writeflow' );
            submit_button();
            ?>
        </form>
    </div>
    <?php
}