<?php 	
	 /**
	 * The plugin page view - the "All Metabox and Menu" page of the plugin.
	 *
	 * @package responsive-gallery-lightbox
	 */

	 defined ('ABSPATH') or die();
	 
	 if(!class_exists('MWA_RGL_METABOXES')){
	 
	 	class MWA_RGL_METABOXES{

	 		public static function MWA_RGL_IMAGES_SIZES_FILTER($sizes) {
				return array_merge($sizes, array(
					'rgl_346_thumb' 			=> __('Size 400 X AUTO'),
					'rgl_12_thumb' 				=> __('Size 500 X AUTO'),
					'rgl_12_same_size_thumb' 	=> __('Same Size 500 X 500'),
					'rgl_346_same_size_thumb' 	=> __('Same Size 400 X 400'),
				));
			}


	 		/* Meta box setup function. */
			public static function mwa_rgl_post_meta_boxes_group() {
					
				/* Add meta boxes on the 'add_meta_boxes' hook.
				
					do_action( 'add_meta_boxes', string $post_type, WP_Post $post ) 
				*/	
			 	add_action( 'add_meta_boxes', ['MWA_RGL_METABOXES','mwa_rgl_add_post_meta_boxes'] );
			}
	 		

			/* Create one or more meta boxes to be displayed on the post editor screen. */
			public static function mwa_rgl_add_post_meta_boxes() {	
				/*
					add_meta_box( string $id, string $title, callable $callback, string|array|WP_Screen $screen = null, string $context = 'advanced', string $priority = 'default', array $callback_args = null )
				*/

				add_meta_box(esc_html__('Add Gallery', MWA_RESP_GALLERY), esc_html__('Add Gallery', MWA_RESP_GALLERY), [ 'MWA_RGL_METABOXES','mwa_rgl_addimg_func' ], 'mwarglplug', 'normal', 'low');

				add_meta_box( esc_html__( 'Gallery Shortcode', MWA_RESP_GALLERY ), esc_html__( 'Gallery Shortcode', MWA_RESP_GALLERY ), array(
					'MWA_RGL_METABOXES',
					'mwa_rgl_shortcode_meta_box_function'
				), 'mwarglplug', 'side', 'low' );

				add_meta_box( esc_html__( 'Gallery Preview', MWA_RESP_GALLERY ), esc_html__( 'Gallery Preview', MWA_RESP_GALLERY ), array(
					'MWA_RGL_METABOXES',
					'mwa_rgl_preview_meta_box'
				), 'mwarglplug', 'side', 'low' );				

			}	

			public static function mwa_rgl_addimg_func( $post ){
				?>	
				<div id="tabs">
				  <ul>
				    <li id="mwargl_tab1"><a href="#tabs-1"><?php esc_html_e('Add Images', MWA_RESP_GALLERY); ?></a></li>
				    <li id="mwargl_tab2"><a href="#tabs-2"><?php esc_html_e('Gallery Setting', MWA_RESP_GALLERY); ?></a></li>
				    <li id="mwargl_tab3"><a href="#tabs-3"><?php esc_html_e('Fonts Setting', MWA_RESP_GALLERY); ?></a></li>
				    <li id="mwargl_tab4"><a href="#tabs-4"><?php esc_html_e('Custom CSS', MWA_RESP_GALLERY); ?></a></li>
				    <li id="mwargl_tab5"><a href="#tabs-5"><?php esc_html_e('Gallery Dummy', MWA_RESP_GALLERY); ?></a></li>
				  </ul>
				  <div id="tabs-1">
					<div id="rglgallery_container">
						<input type="hidden" id="rgl_wl_action" name="rgl_wl_action" value="wl-save-settings">
						<ul id="rgl_gallery_thumbs" class="clearfix">
							<?php
								/* Load saved photos into gallery */
								$RGL_AllPhotosDetails = get_post_meta($post->ID, 'rgl_all_photos_details', true);
								$TotalImages           = get_post_meta($post->ID, 'rgl_total_images_count', true);
								$i = 0;
								if ($TotalImages) {
									foreach ($RGL_AllPhotosDetails as $RGL_SinglePhotoDetails) {
										$name          = $RGL_SinglePhotoDetails['rgl_image_label'];
										$UniqueString  = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
										$url           = $RGL_SinglePhotoDetails['rgl_image_url'];
										$rgl_image_id  = $RGL_SinglePhotoDetails['rgl_image_id'];
										$url1          = $RGL_SinglePhotoDetails['rgl_12_thumb'];
										$url2          = $RGL_SinglePhotoDetails['rgl_346_thumb'];
										$url3          = $RGL_SinglePhotoDetails['rgl_12_same_size_thumb'];
										$url4          = $RGL_SinglePhotoDetails['rgl_346_same_size_thumb'];
										$img_desc      = $RGL_SinglePhotoDetails['img_desc'];
										?>
											<li class="rgl-image-entry" id="rgl_img">
												<a class="gallery_remove lbsremove_bt" href="#gallery_remove" id="lbs_remove_bt"><img src="<?php echo MWA_RESP_GAL_URL . 'assets/images/Close-icon-new.png'; ?>" /></a>
												<img src="<?php echo esc_url($url); ?>" class="rgl-meta-image" alt="">	
												<label><?php esc_html_e('Title', MWA_RESP_GALLERY); ?></label>	
												<input type="text" id="rgl_image_label[]" name="rgl_image_label[]" value="<?php echo html_entity_decode($name, ENT_QUOTES, "UTF-8"); ?>" placeholder="Enter Image Label" class="rgl_label_text">	
												<input type="hidden" id="rgl_image_id[]" name="rgl_image_id[]" value="<?php echo esc_attr($rgl_image_id); ?>">

												<input type="text" id="rgl_image_url[]" name="rgl_image_url[]" class="rgl_label_text rglimg_<?php echo esc_attr($UniqueString); ?>" value="<?php echo esc_url($url); ?>" readonly="readonly" style="display:none;" />
												<input type="text" id="rgl_image_url1[]" name="rgl_image_url1[]" class="rgl_label_text" value="<?php echo esc_url($url1); ?>" readonly="readonly" style="display:none;" />
												<input type="text" id="rgl_image_url2[]" name="rgl_image_url2[]" class="rgl_label_text" value="<?php echo esc_url($url2); ?>" readonly="readonly" style="display:none;" />
												<input type="text" id="rgl_image_url3[]" name="rgl_image_url3[]" class="rgl_label_text" value="<?php echo esc_url($url3); ?>" readonly="readonly" style="display:none;" />
												<input type="text" id="rgl_image_url4[]" name="rgl_image_url4[]" class="rgl_label_text" value="<?php echo esc_url($url4); ?>" readonly="readonly" style="display:none;" />

												<label class="mt-2"><?php esc_html_e('Description', MWA_RESP_GALLERY); ?></label>
												<textarea name="img_desc[]" id="img_desc<?php echo $i; ?>" placeholder="<?php esc_html_e('Description', MWA_RESP_GALLERY); ?>" class="gal_richeditbox_<?php echo esc_attr($i); ?>"><?php echo htmlentities($img_desc); ?></textarea>	
											</li>
										<?php
										$i++;
									}
								}
							?>
						</ul>
					</div>
					<!--Add New Image Button-->
					<div class="rgl-image-entry add_rgl_new_image" id="rgl_gallery_upload_button" data-uploader_title="Upload Image" data-uploader_button_text="Select">
						<div class="dashicons dashicons-plus"></div>
						<p>
							<?php esc_html_e('Add New Images', MWA_RESP_GALLERY); ?>
						</p>
					</div>							
					<div style="clear:left;"></div>				   
				  </div>
				  <div id="tabs-2">
				  	<?php
				  		require_once( MWA_RESP_GAL_DIR_PATH . 'admin/inc/class-mwa-rgl-setting.php');
				  		new MWARGLSetting($post);				  		
				  	?>
				  </div>
				  <div id="tabs-3">
				  	<?php
				  		require_once( MWA_RESP_GAL_DIR_PATH . 'admin/inc/class-mwa-rgl-font-setting.php');
				  		new MWARGLFontSetting($post);				  		
				  	?>
				  </div>
				  <div id="tabs-4">
				  	<?php
				  		$PostId    = $post->ID;
				  		$MWARGL_Gallery_Settings = "MWARGL_Gallery_Settings_" . $PostId;
						$MWARGL_Settings         = get_post_meta( $PostId, $MWARGL_Gallery_Settings, true );

						if ( is_array($MWARGL_Settings)){
							$mwa_rgl_desc_custcss  				= $MWARGL_Settings['mwa_rgl_desc_custcss'];
						}else{
							$mwa_rgl_desc_custcss	= "";
						}
				  	?>
				  	<div class="col-md-12">
				  		<label for="mwa_rgl_desc_custcss"><?php esc_html_e('Custom CSS',MWA_RESP_GALLERY);?></label>
				  		<textarea rows="6" class="col-md-12" id="mwa_rgl_desc_custcss" name="mwa_rgl_desc_custcss"><?php echo esc_html($mwa_rgl_desc_custcss); ?></textarea>
				  	</div>				   	
				  </div>
				  <div id="tabs-5">								
					<div class="container mt-2">
						<div class="owl-carousel owl-theme">
				            <a href="<?php echo esc_url(MWA_RESP_GAL_URL.'assets/images/g1.PNG'); ?>" class="item swipebox" title="<?php esc_html_e('Mobo Gallery 1',MWA_RESP_GALLERY); ?>">
				              <img class="img-reponsive" src="<?php echo esc_url(MWA_RESP_GAL_URL.'assets/images/g1.PNG'); ?>">
				              <p class="mwa_rgl_dumpara"><?php esc_html_e('Mobo Gallery 1',MWA_RESP_GALLERY); ?></p>
				            </a>
				            <a href="<?php echo esc_url(MWA_RESP_GAL_URL.'assets/images/g2.png'); ?>" class="item swipebox" title="<?php esc_html_e('Mobo Gallery 1 (Lightbox)',MWA_RESP_GALLERY); ?>">
				               <img class="img-reponsive" src="<?php echo esc_url(MWA_RESP_GAL_URL.'assets/images/g2.png'); ?>">
				              <p class="mwa_rgl_dumpara"><?php esc_html_e('Mobo Gallery 1 with lightbox', MWA_RESP_GALLERY); ?></p>
				            </a>
				            <a href="<?php echo esc_url(MWA_RESP_GAL_URL.'assets/images/g3.PNG'); ?>" class="item swipebox" title="<?php esc_html_e('Mobo Gallery 2',MWA_RESP_GALLERY); ?>">
				              <img class="img-reponsive" src="<?php echo esc_url(MWA_RESP_GAL_URL.'assets/images/g3.PNG'); ?>">
				              <p class="mwa_rgl_dumpara"><?php esc_html_e('Mobo Gallery 2',MWA_RESP_GALLERY); ?></p>
				            </a>
				          </div>
					</div>		
				  </div>
				</div>				
				<?php
			}

			public static function ajax_get_thumbnail_rgl() {				
				echo esc_html(MWA_RGL_METABOXES::admin_thumb($_POST['imageid']));
				wp_die();
			}

			public static function admin_thumb($id) {				
				$image        = wp_get_attachment_image_src($id, 'lightboxslider_admin_medium', true);
				$image1       = wp_get_attachment_image_src($id, 'rgl_12_thumb', true);
				$image2       = wp_get_attachment_image_src($id, 'rgl_346_thumb', true);
				$image3       = wp_get_attachment_image_src($id, 'rgl_12_same_size_thumb', true);
				$image4       = wp_get_attachment_image_src($id, 'rgl_346_same_size_thumb', true);
				$UniqueString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
			?>
				<li class="rgl-image-entry" id="rgl_img">
					<a class="gallery_remove lbsremove_bt" href="#gallery_remove" id="lbs_remove_bt">
					<img src="<?php echo esc_url( MWA_RESP_GAL_URL . 'assets/images/Close-icon-new.png'); ?>" /></a>
					<img src="<?php echo esc_url($image[0]); ?>" class="rgl-meta-image" alt="">					
					<label><?php esc_html_e('Title', MWA_RESP_GALLERY); ?></label>
					<input type="text" id="rgl_image_label[]" name="rgl_image_label[]" placeholder="Enter Image Label" class="rgl_label_text">					
					<input type="hidden" id="rgl_image_id[]" name="rgl_image_id[]" value="<?php echo esc_attr($id); ?>">
					<input type="text" id="rgl_image_url[]" name="rgl_image_url[]" class="rgl_label_text gg" value="<?php echo esc_url($image[0]); ?>" readonly="readonly" style="display:none;" />
					<input type="text" id="rgl_image_url1[]" name="rgl_image_url1[]" class="rgl_label_text" value="<?php echo esc_url($image1[0]); ?>" readonly="readonly" style="display:none;" />
					<input type="text" id="rgl_image_url2[]" name="rgl_image_url2[]" class="rgl_label_text" value="<?php echo esc_url($image2[0]); ?>" readonly="readonly" style="display:none;" />
					<input type="text" id="rgl_image_url3[]" name="rgl_image_url3[]" class="rgl_label_text" value="<?php echo esc_url($image3[0]); ?>" readonly="readonly" style="display:none;" />
					<input type="text" id="rgl_image_url4[]" name="rgl_image_url4[]" class="rgl_label_text" value="<?php echo esc_url($image4[0]); ?>" readonly="readonly" style="display:none;" />
					<label class="mt-2"><?php esc_html_e('Description', MWA_RESP_GALLERY); ?></label>
					<textarea name="img_desc[]" id="img_desc1" placeholder="<?php esc_html_e('Description', MWA_RESP_GALLERY); ?>" class="gal_richeditbox_<?php echo esc_attr($id); ?>"></textarea>					
				</li>
			<?php
			}

			public static function rgl_add_image_meta_box_save( $PostID ) {
				if (isset($PostID) && isset($_POST['rgl_wl_action'])) {
					$TotalImages = count($_POST['rgl_image_url']);
					$ImagesArray = array();					
					if ($TotalImages) {
						for ($i = 0; $i < $TotalImages; $i++) {
							$url         = esc_url_raw($_POST['rgl_image_url'][$i]);
							$url1        = esc_url_raw($_POST['rgl_image_url1'][$i]);
							$url2        = esc_url_raw($_POST['rgl_image_url2'][$i]);
							$url3        = esc_url_raw($_POST['rgl_image_url3'][$i]);
							$url4        = esc_url_raw($_POST['rgl_image_url4'][$i]);
							$img_desc    = sanitize_textarea_field($_POST['img_desc'][$i]);
							$image_id    = sanitize_text_field($_POST['rgl_image_id'][$i]);
							$image_label = sanitize_text_field($_POST['rgl_image_label'][$i]);								

							$ImagesArray[] = array(
								'rgl_image_label'         => $image_label,
								'rgl_image_id'            => $image_id,
								'rgl_image_url'           => $url,
								'rgl_12_thumb'            => $url1,
								'rgl_346_thumb'           => $url2,
								'rgl_12_same_size_thumb'  => $url3,
								'rgl_346_same_size_thumb' => $url4,
								'img_desc'                => $img_desc
							);
						}						
						update_post_meta($PostID, 'rgl_all_photos_details', $ImagesArray);
						update_post_meta($PostID, 'rgl_total_images_count', $TotalImages);
					} else {
						$TotalImages = 0;
						update_post_meta($PostID, 'rgl_total_images_count', $TotalImages);
						$ImagesArray = array();
						update_post_meta($PostID, 'rgl_all_photos_details', $ImagesArray);
					}
				}				
			}			

			public static function set_columns($columns)
			{
				unset($columns['author'],
				$columns['Date']);
				$new_cols = array(
					'title'        => esc_html__('Gallery', MWA_RESP_GALLERY),
					'date'         => esc_html__('Date', MWA_RESP_GALLERY),
					'shortcode'    => esc_html__('Gallery Shortcode', MWA_RESP_GALLERY),
					'do_shortcode' => esc_html__('Do Shortcode', MWA_RESP_GALLERY),
					'author'       => esc_html__('Author', MWA_RESP_GALLERY),
				);
				return array_merge($columns, $new_cols);
			}

			//column action fields on all galleries page
			public static function manage_col($column, $post_id) {
				global $post;
				switch ($column) {
					case 'shortcode':
						echo '<input type="text" value="[MWA_RGL id=' . $post_id . ']" readonly="readonly" />';
						break;
					case 'do_shortcode':
						echo '<input type="text" value="<?php echo do_shortcode( \'[MWA_RGL id=' . esc_attr($post_id) . ']\' ); ?>" readonly="readonly" />';			
						break;
					default:
						break;
				}
			}

		public static function mwa_rgl_shortcode_meta_box_function(){
			?>
				 <p><label class="mwa_rgl_lbl"><?php esc_html_e( "Use below shortcode in any Page/Post to view gallery in your site", MWA_RESP_GALLERY ); ?></label></p>
	        <input id="inptxt_mwargl_scode" readonly="readonly" type="text" value="<?php echo "[MWA_RGL id=" . get_the_ID() . "]"; ?>"><button type="button" class="btn button-primary ml-1 mwargl_scode"><?php esc_html_e('Copy', MWA_RESP_GALLERY); ?></button>
	        <div id="snackbar"><?php esc_html_e('Copied', MWA_RESP_GALLERY); ?> <i class="fas fa-copy"></i></div>	      
			<?php
		}

		public static function mwa_rgl_preview_meta_box(){
			?>
			  <p class="clearfix">
			  	<?php esc_html_e('View your gallery preview. How it is look like', MWA_RESP_GALLERY); ?>
	        	<a class="rgl-preview btn btn-success mt-2 float-right" href="<?php echo site_url() . '?rgl_preview=true&rglidval=' . esc_attr(get_the_ID()); ?>" target="_blank" title="<?php _e('Preview', 'MWA_RESP_GALLERY'); ?>"><?php _e('Preview', 'MWA_RESP_GALLERY'); ?></a>
	        </p>
			<?php
		}

		//save settings meta box values
		public static function rgl_settings_meta_save($PostID) {
			if (isset($PostID) && isset($_POST['mwargl_save_action']) && isset($_POST['nonce_hbox'])) {
				if (!wp_verify_nonce($_POST['nonce_hbox'], 'nonce_rgl_settings')) {
					die();
				}
				$mwa_rglgallery_title						= sanitize_text_field($_POST['mwa_rglgallery_title']);	
				$mwa_rglgallery_type  						= sanitize_text_field($_POST['mwa_rglgallery_type']);	
				$mwa_rglgallery_ttl_clr  					= sanitize_text_field($_POST['mwa_rglgallery_ttl_clr']);

				$mwa_rglgallery_galcol						= sanitize_text_field($_POST['mwa_rglgallery_galcol']);
				$mwa_rglgallery_navtype						= sanitize_text_field($_POST['mwa_rglgallery_navtype']);
				$mwa_rglgallery_navtype						= sanitize_text_field($_POST['mwa_rglgallery_navtype']);				
				$mwa_rglgallery_thumb_border_clr			= sanitize_text_field($_POST['mwa_rglgallery_thumb_border_clr']);
				$mwa_rglgallery_thumb_border_size			= sanitize_text_field($_POST['mwa_rglgallery_thumb_border_size']);
				$mwa_rglgallery_thumblbl_bg_clr 			= sanitize_text_field($_POST['mwa_rglgallery_thumblbl_bg_clr']);
				$mwa_rglgallery_thumblbl_fg_clr 			= sanitize_text_field($_POST['mwa_rglgallery_thumblbl_fg_clr']);
				$mwa_rglgallery_thumblbl_opacity 			= sanitize_text_field($_POST['mwa_rglgallery_thumblbl_opacity']);
				$mwa_rglgallery_thumb_border_size 			= sanitize_text_field($_POST['mwa_rglgallery_thumb_border_size']);
				$mwa_rglgallery_thumb_border_clr 			= sanitize_text_field($_POST['mwa_rglgallery_thumb_border_clr']);
				$mwa_rglgallery_thumb_bullets_clr 			= sanitize_text_field($_POST['mwa_rglgallery_thumb_bullets_clr']);
				$mwa_rglgallery_thumb_bullettype 			= sanitize_text_field($_POST['mwa_rglgallery_thumb_bullettype']);
				$mwa_rgl_desc_custcss 						= sanitize_textarea_field($_POST['mwa_rgl_desc_custcss']);
				$mwa_rglgallery_lb_bg_clr 					= sanitize_text_field($_POST['mwa_rglgallery_lb_bg_clr']);				
				$mwa_rglgallery_thumb_hover_clr_1 			= sanitize_text_field($_POST['mwa_rglgallery_thumb_hover_clr_1']);
				$mwa_rglgallery_thumb_hover_clr_2 			= sanitize_text_field($_POST['mwa_rglgallery_thumb_hover_clr_2']);
				$mwa_rglgallery_title_align 				= sanitize_text_field($_POST['mwa_rglgallery_title_align']);				
				$mwa_rglgallery_googlefont					= sanitize_text_field($_POST['mwa_rglgallery_googlefont']);
				$mwa_rglgallery_googlefont_gallery_title	= sanitize_text_field($_POST['mwa_rglgallery_googlefont_gallery_title']);
				$mwa_rglgallery_thumb_icon 					= sanitize_text_field($_POST['mwa_rglgallery_thumb_icon']);

				$MWARGL_DefaultSettingsArray = array(
					'mwa_rglgallery_title'  					=> $mwa_rglgallery_title,
					'mwa_rglgallery_type'						=> $mwa_rglgallery_type,
					'mwa_rglgallery_ttl_clr'					=> $mwa_rglgallery_ttl_clr,
					'mwa_rglgallery_galcol'						=> $mwa_rglgallery_galcol,
					'mwa_rglgallery_navtype' 					=> $mwa_rglgallery_navtype,
					'mwa_rglgallery_thumblbl_bg_clr'			=> $mwa_rglgallery_thumblbl_bg_clr,
					'mwa_rglgallery_thumblbl_fg_clr'			=> $mwa_rglgallery_thumblbl_fg_clr,
					'mwa_rglgallery_thumblbl_opacity' 			=> $mwa_rglgallery_thumblbl_opacity,
					'mwa_rglgallery_thumb_border_clr' 			=> $mwa_rglgallery_thumb_border_clr,
					'mwa_rglgallery_thumb_border_size' 			=> $mwa_rglgallery_thumb_border_size,
					'mwa_rglgallery_thumb_bullets_clr'  		=> $mwa_rglgallery_thumb_bullets_clr,
					'mwa_rglgallery_thumb_bullettype'			=> $mwa_rglgallery_thumb_bullettype,
					'mwa_rgl_desc_custcss'						=> $mwa_rgl_desc_custcss,
					'mwa_rglgallery_lb_bg_clr'					=> $mwa_rglgallery_lb_bg_clr,
					'mwa_rglgallery_thumb_hover_clr_1'			=> $mwa_rglgallery_thumb_hover_clr_1,
					'mwa_rglgallery_thumb_hover_clr_2'			=> $mwa_rglgallery_thumb_hover_clr_2,
					'mwa_rglgallery_title_align'				=> $mwa_rglgallery_title_align,					
					'mwa_rglgallery_googlefont'					=> $mwa_rglgallery_googlefont,
					'mwa_rglgallery_googlefont_gallery_title'	=> $mwa_rglgallery_googlefont_gallery_title,
					'mwa_rglgallery_thumb_icon' 				=> $mwa_rglgallery_thumb_icon
				);

				$MWARGL_Gallery_Settings = "MWARGL_Gallery_Settings_" . $PostID;
				update_post_meta($PostID, $MWARGL_Gallery_Settings, $MWARGL_DefaultSettingsArray);
			}
		}	
	}
}