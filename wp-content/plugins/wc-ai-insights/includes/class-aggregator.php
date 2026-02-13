<?php

class WCAI_Aggregator {
        
    public function get_monthly_summary( $year, $month ) {    
        global $wpdb;

        $start = "$year-$month-01";
        $end = date( 'Y-m-t', strtotime( $start ) );

        $order_stats = $wpdb->prefix . 'wc_order_stats';

        $summary = $wpdb->get_row(
            $wpdb->prepare(
                "
                SELECT
                    COUNT( ID ) AS total_orders,
                    SUM( net_sales ) AS total_revenue,
                FROM $order_stats
                WHERE date_created BETWEEN %s AND %s
                AND status IN ( 'wc-completed', 'wc-processing' )",
                $start,
                $end
            ),
            ARRAY_A
        );

        if ( !$summary ) {
            return null;
        }

        $summary['average_order_value'] = $summary['total_orders'] > 0
            ? round( $summary['total_revenue'] / $summary['total_orders'], 2 )
            : 0;

        return $summary;
    }
}