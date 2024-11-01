<?php
/*
Plugin Name: WP Advanced Sticky
Plugin URI: http://www.devock.com
Description: Permet de mettre en avant un article. Actuellement, une seule présentation disponible mais à venir plusieurs thèmes seront disponibles.
Version: 0.1
Author: Sébastien Trutié de Vaucresson
Author URI: http://www.devock.com
License: GPLv2
*/

require('was-config.php');
require('was-box.php');
require('was-front.php');


/*** Création des options ***/
	class wp_advanced_sticky {
		public function __construct() {
			add_action('init', array($this, 'create_options'));
			add_action('wp', array($this, 'wp_session'));
			
			$was_config = new was_config();
			$was_box = new was_box();
			
  			register_deactivation_hook(__FILE__, array($this, 'was_uninstall'));
			
			add_action('wp_head', array($this, 'head'));
		}	
		
		function head() {
			$was_front = new was_front(); 
		}	
		
		function create_options() {
			/***** Initialize options : *****/
			add_option('wp-advanced-sticky', array(
					'only-home' => false,
					'only-one' => false,
					'open-default' => true,
					'theme' => 'default',
					'get-excerpt' => true,
					)
			);											
		}	
		
		function was_uninstall(){
			delete_option('wp-advanced-sticky');
		}
		
		function wp_session() {
			if ( !session_id() ) {
				session_start();
			}
		}
	}
	
	$wac = new wp_advanced_sticky();
	