<?php

	class was_box {
		
		function __construct() {
			add_action('add_meta_boxes', array($this, 'was_champs_box'));  
			add_action('save_post', array($this, 'save_data'));  
		}
		
		function was_champs_box() {
				add_meta_box(  
				'champs_box',
				'WP Advanced Sticky',
				array($this, 'champs_box_content'),
				'post',
				'side',
				'high'
			); 
		}
		
		function champs_box_content(){  
			global $post;
			
			echo '<label for="was-sticky">Mettre en avant :</label> ';
			echo '<input type="checkbox" name="was-sticky" id="was-sticky" '.((get_post_meta($post->ID, 'was-sticky', TRUE))?'checked="checked"':'').'/>';
		}
		
		
		function save_data($post_id){
			global $post;
			
            if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return $post->ID;
            if(defined('DOING_AJAX') && DOING_AJAX)
                return $post->ID;
			
			if(isset($_POST['was-sticky']) && $_POST['was-sticky'] == "on") {
				update_post_meta($post->ID, 'was-sticky', TRUE, get_post_meta($post->ID, 'was-sticky', TRUE));
			} else {
				update_post_meta($post->ID, 'was-sticky', 0, get_post_meta($post->ID, 'was-sticky', TRUE));
			}
			return $data;
			
		}
	}