<?php
defined( 'ABSPATH' ) or die();

if (! class_exists( 'MWA_RGL_Menu' )){
	class MWA_RGL_Menu
	{
		public static function rgl_create_menu() {
			global $submenu;
			/* SYNTAX - Create Menu				
	 		    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);
	 		*/ 

	 		/* Create Menu */
	 		$admin_dboard = add_menu_page( __('Photo Gallery', MWA_RESP_GALLERY ), __('Photo Gallery', MWA_RESP_GALLERY ), 'manage_options', 'mwa_rgl_plug', ['MWA_RGL_Menu','all_gallery'], esc_url(MWA_RESP_GAL_URL.'assets/images/respgallogo.png'), '10');	 		
	 		$addnew_gallery = add_submenu_page( 'mwa_rgl_plug', __('Add New Gallery', MWA_RESP_GAL_URL ) , __('Add New Gallery', MWA_RESP_GALLERY ), 'manage_options', 'post-new.php?post_type=mwarglplug', NULL );	 	
			

	 		if(current_user_can('administrator')){
			    $submenu['mwa_rgl_plug'][0][0] = __('All Galleries', MWA_RESP_GALLERY ); // Rename Top Level Sub Menu using slug
			}  
   
		}

		public static function all_gallery(){
			$rglurl = home_url()."/wp-admin/edit.php?post_type=mwarglplug";			
			?>
				<script type="text/javascript">
					window.location.replace('<?php echo $rglurl; ?>');
				</script>
			<?php
		}
	}
}	