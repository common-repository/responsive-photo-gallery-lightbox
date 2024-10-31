<?php
defined( 'ABSPATH' ) or die();

if( !class_exists('MWARGLPublic')){
	class MWARGLPublic{
		function __construct(){
			require_once( MWA_RESP_GAL_DIR_PATH.'public/designbox/class-mwa-rgl-shortcode.php' );			
			add_filter('wp_enqueue_scripts',['MWARGLPublic','enqjs'],1);
			add_shortcode( 'MWA_RGL', ['MWA_RGL_Shortcode', 'show_mwa_rglgallery'] );
		}

		public static function enqjs(){
			wp_enqueue_script( 'jquery',false, array(), false, false );
		}
	}
}