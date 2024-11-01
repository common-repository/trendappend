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
?><label for="<?php echo esc_attr( $atts['id'] ); ?>">
	<input aria-role="checkbox"
		<?php checked( 1, $atts['value'], true ); ?>
		class="<?php echo esc_attr( $atts['class'] ); ?>"
		id="<?php echo esc_attr( $atts['id'] ); ?>"
		name="<?php echo esc_attr( $atts['name'] ); ?>"
		type="checkbox"
		value="1" />
	<span class="description"><?php echo esc_html( $atts['description'] ); ?></span>
</label>