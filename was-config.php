<?php 
	/*** Configuration ***/
	
	class was_config {
		
  		const CAPABILITY = 'edit_posts'; // Privilège requis
  		const MENU_TITLE = 'WP Advanced Sticky'; // Titre du sous menu
  		const PAGE_TITLE = 'Configuration WP Advanced Sticky'; // Titre de la page d'administration
		
		private $options;
		
		function __construct() {
			add_action('admin_menu', array($this, 'add_submenu'));
		}
		
		function add_submenu() {
			add_submenu_page('options-general.php', self::PAGE_TITLE, self::MENU_TITLE, self::CAPABILITY, 'was-config', array($this, 'configuration'));
		}
		
		function configuration() {
			// Vérification des droits de l'utilisateur courant
			if(!current_user_can(self::CAPABILITY)) 
     			wp_die( __('You do not have sufficient permissions to access this page.') );
				
			
			$this->options = get_option('wp-advanced-sticky');
			
			
     		if(isset($_POST['submit'])){
     			$this->config_page_update($_POST);
     		}
			
			$this->set_html();
		}
		
		private function set_html() {
			?>
			<style>
				form { margin: 20px 0; }
				.wrap input[type="text"] { width: 400px; }
				.wrap label { float: left; width: 150px; }
				.postbox { margin: 20px 0 0 0; }
			</style>
			<div class="wrap">
				<form action="" method="post">
					<div class="icon32" id="icon-options-general"><br></div>
					<h2><?php echo self::PAGE_TITLE; ?></h2>
															
					<div class="postbox" id="poststuff">
						<h3>Settings</h3>

						<div class="inside">
							<p>Afficher seulement sur la page d'accueil : 
									<input type="radio" name="only-home" value="only-home-yes" <?php if($this->options['only-home']) echo 'checked="checked"'; ?> /> Oui 
									<input type="radio" name="only-home" value="only-home-no" <?php if(!$this->options['only-home']) echo 'checked="checked"'; ?> /> Non
							</p>
							<p>Afficher une seule fois par visite : 
									<input type="radio" name="only-one" value="only-one-yes" <?php if($this->options['only-one']) echo 'checked="checked"'; ?> /> Oui 
									<input type="radio" name="only-one" value="only-one-no" <?php if(!$this->options['only-one']) echo 'checked="checked"'; ?> /> Non
							</p>
							<p>Ouvrir par défaut : 
									<input type="radio" name="open-default" value="open-default-yes" <?php if($this->options['open-default']) echo 'checked="checked"'; ?> /> Oui 
									<input type="radio" name="open-default" value="open-default-no" <?php if(!$this->options['open-default']) echo 'checked="checked"'; ?> /> Non
							</p>
							<p>Afficher l'extrait de l'article ou l'article complet : 
									<input type="radio" name="get-excerpt" value="get-excerpt-yes" <?php if($this->options['get-excerpt']) echo 'checked="checked"'; ?> /> Extrait 
									<input type="radio" name="get-excerpt" value="get-excerpt-no" <?php if(!$this->options['get-excerpt']) echo 'checked="checked"'; ?> /> Article complet
							</p>
						</div>
					</div>
					
					<div class="postbox" id="poststuff">
						<h3>Thèmes</h3>

						<div class="inside">
							<p>En cours...</p>
						</div>
					</div>
					
					<p><input type="submit" value="Sauvegarder" class="button-primary" name="submit" /></p>
				</form>
				
			</div>
			<?php
		}
		
		private function config_page_update($post) {
			// ONLY HOME
			if(isset($_POST['only-home']) && $_POST['only-home'] == 'only-home-yes') {
				$this->options['only-home'] = true;
			} elseif(isset($_POST['only-home']) && $_POST['only-home'] == 'only-home-no') {
				$this->options['only-home'] = false;
			} else {
				$this->options['only-home'] = false;
			}
			
			// ONLY ONE
			if(isset($_POST['only-one']) && $_POST['only-one'] == 'only-one-yes') {
				$this->options['only-one'] = true;
			} elseif(isset($_POST['only-one']) && $_POST['only-one'] == 'only-one-no') {
				$this->options['only-one'] = false;
			} else {
				$this->options['only-one'] = false;
			}
			
			// GET EXCERPT
			if(isset($_POST['get-excerpt']) && $_POST['get-excerpt'] == 'get-excerpt-yes') {
				$this->options['get-excerpt'] = true;
			} elseif(isset($_POST['get-excerpt']) && $_POST['get-excerpt'] == 'get-excerpt-no') {
				$this->options['get-excerpt'] = false;
			} else {
				$this->options['get-excerpt'] = false;
			}
			
			// OPEN DEFAULT
			if(isset($_POST['open-default']) && $_POST['open-default'] == 'open-default-yes') {
				$this->options['open-default'] = true;
			} elseif(isset($_POST['open-default']) && $_POST['open-default'] == 'open-default-no') {
				$this->options['open-default'] = false;
			} else {
				$this->options['open-default'] = true;
			}
			
			update_option('wp-advanced-sticky', $this->options);
		}	
	}