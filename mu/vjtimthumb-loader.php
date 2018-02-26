<?php
/*
Plugin Name: VJMedia: Timthumb
Description: 把Timthumb獨立出來成為一隻插件
Version: 1.0
Author: <a href="http://www.vjmedia.com.hk">技術組</a>
GitHub Plugin URI: https://github.com/VJMedia/vj-timthumb
*/


if ( ! defined( 'WPINC' ) ) { die; }

define('VJTIMTHUMB_PATH','vj-timthumb/vj-timthumb.php');

if ( ! function_exists( 'vjtimthumb_dummy' ) ) {
        require trailingslashit( WP_PLUGIN_DIR ) . VJTIMTHUMB_PATH;
}

function vjtimthumb_deactivate( $plugin, $network_wide ) {
        if ( VJTIMTHUMB_PATH === $plugin ) {
                deactivate_plugins( VJTIMTHUMB_PATH );
        }
} add_action( 'activated_plugin', 'vjtimthumb_deactivate', 10, 2 );

function vjtimthumb_mu_plugin_active( $actions ) {
        if ( isset( $actions['activate'] ) ) {
                unset( $actions['activate'] );
        }
        if ( isset( $actions['delete'] ) ) {
                unset( $actions['delete'] );
        }
        if ( isset( $actions['deactivate'] ) ) {
                unset( $actions['deactivate'] );
        }

        return array_merge( array( 'mu-plugin' => esc_html__( 'Activated as mu-plugin', 'vj-timthumb' ) ), $actions );
}
add_filter( 'network_admin_plugin_action_links_' . VJTIMTHUMB_PATH, 'vjtimthumb_mu_plugin_active' );
add_filter( 'plugin_action_links_' . VJTIMTHUMB_PATH, 'vjtimthumb_mu_plugin_active' );

add_action( 'after_plugin_row_' . VJTIMTHUMB_PATH,
	function () {
		print( '<script>jQuery(".inactive[data-plugin=\'vj-timthumb/vj-timthumb.php\']").attr("class", "active");</script><script>jQuery(".active[data-plugin=\'vj-timthumb/vj-timthumb.php\'] .check-column input").remove();</script>' );
		print( '<script>jQuery("tr[data-plugin=\'vj-timthumb/vj-timthumb.php\']").hide();</script>');
	}
);


