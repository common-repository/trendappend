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
?>
 <div class="trendappend-note">
                            <h3><?php 
            echo  esc_html( 'Instructions', 'trendappend' ) ;
            ?></h3>
                            <p><?php 
            echo  sprintf( wp_kses( __( ' Your TREND Shoppable Videos <a href="%s" target="_blank">Free Account</a>', 'trendappend' ), array(
                'a' => array(
                'href'   => array(),
                'target' => array(),
            ),
            ) ), esc_url( TRENDAPPEND_COMMUNITY_URL ) ) ;
            ?></p>
            <h3><?php 
            echo  esc_html( 'Documentation', 'trendappend' ) ;
            ?></h3>
              <p><?php 
            echo  sprintf( wp_kses( __( 'Host Shoppable Videos and ecommerce on your wordpress site. Learn more <a href="%s" target="_blank">Documentation</a>. Enjoy.', 'trendappend' ), array(
                'a' => array(
                'href'   => array(),
                'target' => array(),
            ),
            ) ), esc_url( TRENDAPPEND_BUSINESS_URL.'/plugins/wordpress/' ) ) ;
            ?></p>
            <h3><?php 
            echo  esc_html( 'Terms of use', 'trendappend' ) ;
            ?></h3>
              <p><?php 
            echo  sprintf( wp_kses( __( 'Host Shoppable Videos and ecommerce on your wordpress site. Learn more <a href="%s" target="_blank">Terms of use</a>', 'trendappend' ), array(
                'a' => array(
                'href'   => array(),
                'target' => array(),
            ),
            ) ), esc_url( TRENDAPPEND_BUSINESS_URL.'/terms-of-use/' ) ) ;
            ?></p>
            <h3><?php 
            echo  esc_html( 'Privacy Policy', 'trendappend' ) ;
            ?></h3>
              <p><?php 
            echo  sprintf( wp_kses( __( 'Host Shoppable Videos and ecommerce on your wordpress site. Learn more <a href="%s" target="_blank">Privacy Policy</a>', 'trendappend' ), array(
                'a' => array(
                'href'   => array(),
                'target' => array(),
            ),
            ) ), esc_url( TRENDAPPEND_BUSINESS_URL.'/privacy-policy/' ) ) ;
            ?></p>

                        </div>