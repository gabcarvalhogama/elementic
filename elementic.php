<?php
/**
 * Plugin Name: Elementic
 * Plugin URI: http://www.gabcarvalhogama.com.br/conheca-o-elementic
 * Description: Integre o seu Elementor com o Mautic DE GRAÇA.
 * Version: 1.0
 * Author: Gabriel Carvalho Gama
 * Author URI: http://www.gabcarvalhogama.com.br
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'elementor_pro/init', function() {
	// Here its safe to include our action class file
	require "Elementic_Form_Action.php";


	// Instantiate the action class
	$elementic = new Elementic_Form_Action();

	// Register the action with form widget
	\ElementorPro\Plugin::instance()->modules_manager->get_modules( 'forms' )->add_form_action( $elementic->get_name(), $elementic );
});