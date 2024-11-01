<?php

	class was_front {
		private $options;
		
		function __construct() {
			if(!wp_script_is('jquery')) {
				add_action( 'wp_enqueue_scripts', 'enqueue_jquery' );
			}
			
			$this->options = get_option('wp-advanced-sticky');
			
			$this->check_options();
		}
		
		function enqueue_jquery() {
			wp_enqueue_script('jquery');
		}
		
		function check_options() {
			$show = true;
			
			if(!is_front_page() && 	$this->options['only-home']) $show = false;
			if(!is_front_page() && 	$this->options['only-home'] == true) $show = false;
			if(isset($_SESSION['wp-was']) && $_SESSION['wp-was'] == true) {
				$show = false;
			} else {
				$_SESSION['wp-was'] = true;
			}
			
			if($show) {
				$this->add_html_body();
				$this->add_script();
			}
		}
		
		function add_html_body() {
			echo '<script>'."\r\n";
				echo 'jQuery(document).ready(function(){'."\r\n";
					$render = '';
					
					$args = array(
						'meta_key' => 'was-sticky',
						'meta_value' => '1',
						'post_type' => 'post',
						'post_statuts' => 'publish',
						'post_per_page' => 1,
					);
					
					$sticky = new WP_Query($args);
					
					if($sticky->have_posts()):
						$render .= '<div id="was-sticky">';
							$render .= '<div id="open-close-was-sticky">';
							$render .= '	<a href="#" id="was-open" class="was-disabled"></a>';
							$render .= '	<a href="#" id="was-close"></a>';
							$render .= '</div>';
							$render .= '<div id="wrap-was-sticky"'.((!$this->options['open-default'])?' class="was-displaynone"':'').'>';
								while($sticky->have_posts()): $sticky->the_post();
									$render .= '<div id="title-was-sticky"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
									
									if($this->options['get-excerpt'])
										$render .= '<div id="content-was-sticky"><a href="'.get_permalink().'">'.get_the_excerpt().'</a></div>';
									else
										$render .= '<div id="content-was-sticky"><a href="'.get_permalink().'">'. str_replace(CHR(13).CHR(10),"",get_the_content()).'</a></div>';
											
								endwhile;
							$render .= '</div>';
						$render .= '</div>';
					endif;
					
					// echo $render;
					
					echo 'jQuery(\'body\').prepend(\''.$render.'\');';
				echo '});'."\r\n";
			echo '</script>'."\r\n";
			
			wp_reset_query();
		}
		
		function add_script() {
			echo '<link rel="stylesheet" href="'.get_bloginfo('url').'/wp-content/plugins/wp-advanced-sticky/themes/default/default.css" media="all" />';
			echo '<script src="'.get_bloginfo('url').'/wp-content/plugins/wp-advanced-sticky/themes/default/default.js"></script>';
		}
	}