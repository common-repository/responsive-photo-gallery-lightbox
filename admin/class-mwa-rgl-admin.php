<?php
defined( 'ABSPATH' ) or die();

if (! class_exists( 'MWARGLAdmin' )){
	class MWARGLAdmin
	{
		/**
	     * @return MWARGLAdmin constructor.
	     */

		function __construct(){

			/*include all files*/
			require_once( MWA_RESP_GAL_DIR_PATH . 'admin/class-mwa-rgl-menu.php' );
			require_once( MWA_RESP_GAL_DIR_PATH . 'admin/cpt/class-mwa-rgl-cpt.php' );
			require_once( MWA_RESP_GAL_DIR_PATH . 'admin/metaboxes/class-mwargl-metaboxes.php' );
			require_once( MWA_RESP_GAL_DIR_PATH . 'admin/widget/class-mwa-rgl-widgetbtn.php' );
			new MWARGLWidgetBtn;	

			add_action('admin_enqueue_scripts', [ 'MWARGLAdmin','rgl_admin_print_scripts' ] );
						
			add_action( 'init', ['MWA_RGL_CPT_CLS','create_cpt_func'] );
			add_action( 'admin_menu', ['MWA_RGL_Menu', 'rgl_create_menu'] );

			add_action( 'load-post.php', [ 'MWA_RGL_METABOXES','mwa_rgl_post_meta_boxes_group' ] );
			add_action( 'load-post-new.php', [ 'MWA_RGL_METABOXES','mwa_rgl_post_meta_boxes_group' ] );	

			add_action('wp_ajax_rgl_get_thumbnail', [ 'MWA_RGL_METABOXES','ajax_get_thumbnail_rgl' ] );	

			// Image Crop Size Function
			add_image_size('rgl_12_thumb', 500, 9999, array('center', 'top'));
			add_image_size('rgl_346_thumb', 400, 9999, array('center', 'top'));
			add_image_size('rgl_12_same_size_thumb', 500, 500, array('center', 'top'));
			add_image_size('rgl_346_same_size_thumb', 400, 400, array('center', 'top'));

			add_filter('image_size_names_choose', [ 'MWA_RGL_METABOXES','MWA_RGL_IMAGES_SIZES_FILTER' ] );

			add_action('save_post', [ 'MWA_RGL_METABOXES','rgl_add_image_meta_box_save' ], 9, 1);

			add_action('save_post', [ 'MWA_RGL_METABOXES','rgl_settings_meta_save' ],9, 1);

			add_filter( 'manage_mwarglplug_posts_columns', ['MWA_RGL_METABOXES', 'set_columns'] );

			add_action('manage_mwarglplug_posts_custom_column', ['MWA_RGL_METABOXES','manage_col'], 10, 2 );			
		}		

		public static function MWA_RGL_IMAGES_SIZES_FILTER($sizes) {
			return array_merge($sizes, array(
				'rgl_346_thumb' 			=> __('Size 400 X AUTO'),
				'rgl_12_thumb' 				=> __('Size 500 X AUTO'),
				'rgl_12_same_size_thumb' 	=> __('Same Size 500 X 500'),
				'rgl_346_same_size_thumb' 	=> __('Same Size 400 X 400'),
			));
		}

		//Required JS & CSS
		public static function rgl_admin_print_scripts($hook_suffix) {
			if (in_array($hook_suffix, array('post.php', 'post-new.php'))) {
				$screen = get_current_screen();
				if (is_object($screen) && 'mwarglplug' === $screen->post_type) {
					wp_enqueue_script('media-upload');
					add_thickbox();
					wp_enqueue_media();					
 					wp_enqueue_script('jquery-ui-tabs');
					wp_enqueue_script('rgl-media-uploader-js', MWA_RESP_GAL_URL . 'assets/js/rgl-multiple-media-uploader.js', array('jquery'));	
					//custom add image box css
					wp_enqueue_style('rgl-meta-css', MWA_RESP_GAL_URL . 'assets/css/rgl-meta.css');
					wp_enqueue_style('bootstrap-min-css', MWA_RESP_GAL_URL . 'assets/css/bootstrap.min.css');
					wp_enqueue_style('jquery-ui-css', MWA_RESP_GAL_URL . 'assets/css/jquery-ui.css');
					wp_enqueue_style('admin-custom-css', MWA_RESP_GAL_URL . 'assets/css/admin-custom-css.css');

					//font awesome css
					wp_enqueue_style('font-awesome-5', MWA_RESP_GAL_URL . 'assets/fontawesome/css/all.min.css');				

					wp_enqueue_script( 'admin-custom-js', MWA_RESP_GAL_URL . 'assets/js/admin-custom-js.js' );	
					
					wp_enqueue_script( 'bootstrap-min-js', MWA_RESP_GAL_URL . 'assets/js/bootstrap.min.js' );						
					wp_enqueue_script('wp-color-picker');	

					wp_enqueue_style('codemirror-min-css', MWA_RESP_GAL_URL . 'assets/css/codemirror/codemirror.min.css');	
					wp_enqueue_style('show-hint-css', MWA_RESP_GAL_URL . 'assets/css/codemirror/show-hint.css');	
					wp_enqueue_style('owl-carousel-min-css', MWA_RESP_GAL_URL . 'assets/css/owl.carousel.min.css');				
					wp_enqueue_script( 'codemirror-min-js', MWA_RESP_GAL_URL . 'assets/js/codemirror/codemirror.min.js' );
					wp_enqueue_script( 'css-js', MWA_RESP_GAL_URL . 'assets/js/codemirror/css.js' );
					wp_enqueue_script( 'css-hint-js', MWA_RESP_GAL_URL . 'assets/js/codemirror/css-hint.js' );
					wp_enqueue_script( 'show-hint-js', MWA_RESP_GAL_URL . 'assets/js/codemirror/show-hint.js' );
					wp_enqueue_script( 'owl-carousel-min-js', MWA_RESP_GAL_URL . 'assets/js/owl.carousel.min.js' );	
					wp_enqueue_script( 'swipebox-js', MWA_RESP_GAL_URL . 'assets/js/jquery.swipebox.js' );
  					wp_enqueue_style('swipebox-min-css', MWA_RESP_GAL_URL . 'assets/css/swipebox.min.css');
  					wp_enqueue_style('owl-theme-default-css', MWA_RESP_GAL_URL . 'assets/css/owl.theme.default.min.css'); 
				}
			}			
		}
	}
}	