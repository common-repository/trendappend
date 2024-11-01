<?php
/**
 * Template Name: Trend Videos
 * @package trendappend
 * @since 	1.0.0
 * @version	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header();
?>
<div class="trend-main">			
<?php
echo do_shortcode('[trendappend_videos]');
?>
</div>
<?php
get_footer();
