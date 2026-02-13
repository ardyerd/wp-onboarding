<?php

class WCAI_DB {

    public static function create_table() {
        global $wpdb;

        $table_name = $wpdb->prefix . 'wc_ai_insights';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            report_month VARCHAR(20) NOT NULL,
            insight_text LONGTEXT NOT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY  (id)
            UNIQUE KEY unique_report_month (report_month)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

}