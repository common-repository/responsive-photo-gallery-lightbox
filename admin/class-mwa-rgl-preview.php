<?php
defined( 'ABSPATH' ) or die();

if( !class_exists( 'MWA_RGL_PREVIEW_CLS')){
	class MWA_RGL_PREVIEW_CLS{
		function __construct(){			
			self:rgl_gallery_preview();					
		}

		public static function rgl_gallery_preview(){
		 	if ( is_user_logged_in() && isset($_GET[ 'rgl_preview' ], $_GET[ 'rglidval' ]) ) {
		 		$rgliddata = sanitize_text_field($_GET[ 'rglidval' ]);
		 		$MWARGL_Gallery_Settings 	= "MWARGL_Gallery_Settings_" . $rgliddata;
				$MWARGL_Settings         	= get_post_meta( $rgliddata, $MWARGL_Gallery_Settings, true );

				if ( is_array($MWARGL_Settings)){					
					$mwa_rglgallery_type 			= $MWARGL_Settings['mwa_rglgallery_type'];
				}else{					
					$mwa_rglgallery_type 			= 1;
				}

		 		self::enq_libs_preview_mode($mwa_rglgallery_type);
		 			
		 		include(MWA_RESP_GAL_DIR_PATH . 'admin/inc/rgl_preview_gallery_html.php');
		        die();
		 	}
		}

		public static function enq_libs_preview_mode($gallery_type){
			wp_enqueue_script( 'jquery',false, array(), false, false );
			wp_enqueue_script( 'bootstrap-min-js', MWA_RESP_GAL_URL . 'assets/js/bootstrap.min.js' );
    		wp_enqueue_style('bootstrap-min-css', MWA_RESP_GAL_URL . 'assets/css/bootstrap.min.css');    		

			switch ($gallery_type) {
				case 1:
					/* Mobo Gallery 1 */
    				wp_enqueue_style('mb-gallery-css', MWA_RESP_GAL_URL . 'assets/gallery-assets/gallery-1/css/jquery.mb.gallery.min.css');
					wp_enqueue_script( 'jquery-ui-js', MWA_RESP_GAL_URL . 'assets/gallery-assets/gallery-1/js/jquery.mb.gallery.js' );
					break;
				case 2:
					/* Mobo Gallery 2 */
    				wp_enqueue_style('mb-gallery-css', MWA_RESP_GAL_URL . 'assets/gallery-assets/gallery-1/css/jquery.mb.gallery.min.css');
					wp_enqueue_script( 'jquery-ui-js', MWA_RESP_GAL_URL . 'assets/gallery-assets/gallery-1/js/jquery.mb.gallery.js' );
					break;				
				default:
					/* Mobo Gallery */
    				wp_enqueue_style('mb-gallery-css', MWA_RESP_GAL_URL . 'assets/gallery-assets/gallery-1/css/jquery.mb.gallery.min.css');
					wp_enqueue_script( 'jquery-ui-js', MWA_RESP_GAL_URL . 'assets/gallery-assets/gallery-1/js/jquery.mb.gallery.js' );
					break;
			}
		}		
	}
}
