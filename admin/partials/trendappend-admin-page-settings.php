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
 $default_tab = null;
  $tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : $default_tab;
  if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="wrap">
	<h2><?php echo esc_html( get_admin_page_title()); ?></h2>
  <div>
  <?php settings_errors(); ?>
<form method="post" action="options.php"><?php

settings_fields( $this->plugin_name . '-options' );

do_settings_sections( $this->plugin_name );

submit_button( 'Save Settings' );

?></form>
  </div>  
</div>