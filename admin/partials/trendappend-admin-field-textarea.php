<?php

/**a
 * Provide a view for a section
 *
 * Enter text below to appear below the section title on the Settings page
 *
 * @link       https://brands.trend.app/plugins/trendappend/
 * @since      1.0.0
 *
 * @package    trendappend
 * @subpackage trendappend/admin/partials
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( ! empty( $atts['label'] ) ) {

	?><label for="<?php echo esc_attr( $atts['id'] ); ?>"><?php echo esc_html( $atts['label'] ); ?>: </label><?php

}

?><textarea
	class="<?php echo esc_attr( $atts['class'] ); ?>"
	cols="<?php echo esc_attr( $atts['cols'] ); ?>"
	id="<?php echo esc_attr( $atts['id'] ); ?>"
	name="<?php echo esc_attr( $atts['name'] ); ?>"
	rows="<?php echo esc_attr( $atts['rows'] ); ?>"><?php

	 echo esc_textarea( $atts['value'] );

?></textarea>
<span class="description"><?php echo esc_html( $atts['description'] ); ?></span>