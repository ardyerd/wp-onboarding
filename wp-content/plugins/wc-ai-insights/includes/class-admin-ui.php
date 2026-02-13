<?php

class WCAI_Admin_UI {
    
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add__menu' ) );
        add_action( 'admin_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    public function add__menu() {
        add_submenu_page(
            'woocommerce',
            'AI Insights',
            'AI Insights',
            'manage_woocommerce',
            'wc-ai-insights',
            [$this, 'render_page']
        );
    }

    public function enqueue_assets($hook) {

        if ($hook !== 'woocommerce_page_wc-ai-insights') {
            return;
        }

        wp_enqueue_style(
            'wcai-admin-style',
            WCAI_URL . 'assets/admin.css',
            [],
            WCAI_VERSION
        );

        wp_enqueue_script(
            'wcai-admin-script',
            WCAI_URL . 'assets/admin.js',
            [],
            WCAI_VERSION,
            true
        );
    }

    public function render_page() {
        
        if (isset($_POST['generate_insights'])) {
            
            $year = date('Y');
            $month = date('m');

            $aggregator = new WCAI_Aggregator();
            $data = $aggregator->get_monthly_summary($year, $month);

            $ai = new WCAI_AI_Service();
            $insights = $ai->generate_insights($data);

            echo '<div class="notice notice-success is-dismissible"><p>AI Insights Generated Successfully!</p></div>';
            echo '<div class="wcai-insight-box"><pre>$insight</pre></div>';

        }

        ?>

        <div class="wrap">
            <h1>WooCommerce AI Insights</h1>
            <form method="post">
                <button type="submit" class="button button-primary" name="generate_insight">Generate AI Insights for This Month</button>
            </form>
        </div>

        <?php
    }

}