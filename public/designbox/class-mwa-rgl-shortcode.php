<?php

defined( 'ABSPATH' ) or die();

if( !class_exists('MWA_RGL_Shortcode')){
	class MWA_RGL_Shortcode{

		public static function show_mwa_rglgallery($atts){
			wp_enqueue_style( 'bootstrap_css', MWA_RESP_GAL_URL . 'assets/css/bootstrap.min.css'  );			
		 	
		 	wp_enqueue_style('mwa-rgl-fontawesome', MWA_RESP_GAL_URL . 'assets/fontawesome/css/all.min.css', array(), true, 'all');
			wp_enqueue_script( 'jquery' );					
			wp_enqueue_script( 'bootstrap_js', MWA_RESP_GAL_URL . 'assets/js/bootstrap.min.js', array( 'jquery' ), true, true );							
	
		    $post_id = $atts['id'];
		    
		    $MWARGL_Gallery_Settings 	= "MWARGL_Gallery_Settings_" . $post_id;
			$MWARGL_Settings         	= get_post_meta( $post_id, $MWARGL_Gallery_Settings, true );		    

			if ( is_array($MWARGL_Settings)){
				$mwa_rglgallery_type = $MWARGL_Settings['mwa_rglgallery_type'];;
			}else{
				$mwa_rglgallery_type = 1;	
			}

			if($mwa_rglgallery_type==1){
				function gallery_1($post_id){					
					return $post_id;
				}				
				include( MWA_RESP_GAL_DIR_PATH . 'public/designbox/gallery-1/content.php' );

			}elseif($mwa_rglgallery_type==2){
				function gallery_2($post_id){
					return $post_id;
				}
				include( MWA_RESP_GAL_DIR_PATH . 'public/designbox/gallery-2/content.php' );
			}else{
				/*If user forget to select theme setting and save then run theme template first*/
				function gallery_1($post_id){
					return $post_id;
				}
				include( MWA_RESP_GAL_DIR_PATH . 'public/designbox/gallery-1/content.php' );
			}			
		}
	}
}	
?>