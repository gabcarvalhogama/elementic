<?php
/**
 * Plugin Name: Elementic
 * Plugin URI: http://www.gabcarvalhogama.com.br/conheca-o-elementic
 * Description: Integre o seu Elementor com o Mautic DE GRAÇA.
 * Version: 1.0
 * Author: Gabriel Carvalho Gama
 * Author URI: http://www.gabcarvalhogama.com.br
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.


function elementic_addon(){	
	require_once( __DIR__ . '/includes/plugin.php' );

	// Run the plugin
	\Elementic\Plugin::instance();
}

add_action( 'plugins_loaded', 'elementic_addon' );
