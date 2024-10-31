<?php
/**
 * @link              https://mywebapp.in/
 * @since             0.1
 * @package           responsive-gallery-lightbox
 *
 * Plugin Name:		  Responsive Photo Gallery & Lightbox
 * Plugin URI:        https://wordpress.org/plugins/responsive-photo-gallery-lightboxOnce
 * Description:       Responsive Photo Gallery WordPress Plugin by MyWebApp is the best way to create responsive media galleries with different layout on your website.
 * Version:           0.2
 * Author:            MyWebApp
 * Author URI:        https://mywebapp.in/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       MWA_RESP_GALLERY
 * Requires PHP:      7.2  
 * Domain Path:       /languages
 * Requires at least: 5.2
**/

defined( 'ABSPATH' ) or die('No script kiddies please!!');

if ( ! defined( 'MWA_RESP_GAL_URL' ) ) {
	define( "MWA_RESP_GAL_URL", plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'MWA_RESP_GAL_DIR_PATH' ) ) {
	define( 'MWA_RESP_GAL_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'MWA_RESP_GAL_FILE' ) ) {
	define( 'MWA_RESP_GAL_FILE', __FILE__ );
}

if ( ! defined( 'MWA_RESP_GALLERY' ) ) {
	define( 'MWA_RESP_GALLERY', 'MWA_RESP_GALLERY' );
}

add_action( 'plugins_loaded', 'MWA_RESP_GALTranslate' );
function MWA_RESP_GALTranslate() {	
	load_plugin_textdomain('MWA_RESP_GALLERY', false, dirname( plugin_basename(__FILE__)).'/languages/' );
}

if (! class_exists( 'MWA_RESP_GAL_CLS' )){
	final class MWA_RESP_GAL_CLS{

		private static $mwarespgal_instance = null;

		private function __construct()
		{			
			include( 'admin/class-mwa-rgl-preview.php' );
			$this->setup_hooks();
			/* Load text domain */
			
			add_action('template_redirect', [ 'MWA_RGL_PREVIEW_CLS','rgl_gallery_preview' ]);
		}

		private function setup_hooks() {
			if ( is_admin() ) {
				require_once( 'admin/class-mwa-rgl-admin.php' );				
				new MWARGLAdmin;	// Create Class object				
			}
			require_once( 'public/class-mwa-rgl-public.php' );
			new MWARGLPublic; // Create Class object			
		}


		public static function instance_getter() {
			if ( is_null( self::$mwarespgal_instance ) ) {
				self::$mwarespgal_instance = new self();
			}
			return self::$mwarespgal_instance;
		}		
	}	
}	
MWA_RESP_GAL_CLS::instance_getter();