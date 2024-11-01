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

	?><label for="<?php echo esc_attr( $atts['id']); ?>"><?php echo esc_html( $atts['label'] ); ?>: </label><?php

}

?><select
	aria-label="<?php echo esc_attr( $atts['aria']); ?>"
	class="<?php echo esc_attr( $atts['class'] ); ?>"
	id="<?php echo esc_attr( $atts['id'] ); ?>"
	name="<?php echo esc_attr( $atts['name'] ); ?>"><?php

if ( ! empty( $atts['blank'] ) ) {

	?><option value><?php echo esc_html( $atts['blank'] ); ?></option><?php

}

foreach ( $atts['selections'] as $selection ) {

	if ( is_array( $selection ) ) {

		$label = $selection['label'];
		$value = $selection['value'];

	} else {

		$label = strtolower( $selection );
		$value = strtolower( $selection );

	}

	?><option
		value="<?php echo esc_attr( $value ); ?>" <?php
		selected( $atts['value'], $value ); ?>><?php

		echo esc_html( $label, 'trendappend' );

	?></option><?php

} // foreach

?></select>
<span class="description"><?php echo esc_html( $atts['description']); ?></span>
</label>
