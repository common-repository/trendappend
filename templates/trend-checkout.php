<?php
/**
 * Template Name: Trend Checkout
 * @package trendappend
 * @since 	1.0.0
 * @version	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$trend_id =(string) get_query_var('trend_id');
get_header();
?>
<div class="trend-sales-window">
	<div class="trend-container">
			
<?php
echo do_shortcode('[trendappend_checkout trend_id="'.wp_kses_post($trend_id).'"]');
?>
     </div>
</div>
<?php
get_footer();
