<?php
defined( 'ABSPATH' ) or die();
if (! class_exists( 'MWARGLFontSetting' )){
	class MWARGLFontSetting
	{
		function __construct($post){
			$PostId    = $post->ID;
			self::mwa_rgl_fontsetting_caller($PostId);						
		}		

		public static function mwa_rgl_fontsetting_caller($PostId){			
			
			$MWARGL_Gallery_Settings = "MWARGL_Gallery_Settings_" . $PostId;
			$MWARGL_Settings         = get_post_meta( $PostId, $MWARGL_Gallery_Settings, true );

			if ( is_array($MWARGL_Settings)){
				$mwa_rglgallery_googlefont					= $MWARGL_Settings['mwa_rglgallery_googlefont'];
				$mwa_rglgallery_googlefont_gallery_title	= $MWARGL_Settings['mwa_rglgallery_googlefont_gallery_title'];
			}else{				
				
				$mwa_rglgallery_googlefont					= "";
				$mwa_rglgallery_googlefont_gallery_title	= "";
			}
			?>
			<div class="container">				
				<table class="form-table">
					<tbody>
						<?php 
							$nonce_rgl_setting = wp_create_nonce( 'nonce_rgl_settings' ); 
						?>
						<input type="hidden" name="nonce_hbox" value="<?php echo esc_attr( $nonce_rgl_setting ); ?>">
						<input type="hidden" id="mwargl_save_action" name="mwargl_save_action" value="mwargl-save-settings">						
						<tr>
							<th>
								<label for="mwa_rglgallery_googlefont_gallery_title"><?php esc_html_e('Font For Gallery Title',MWA_RESP_GALLERY); ?></label>
							</th>
							<td>
								<select id="mwa_rglgallery_googlefont_gallery_title" name="mwa_rglgallery_googlefont_gallery_title" class="form-control">
									<option id="mwa_freefonts_option" value="">-- <?php esc_html_e('Select Font Family',MWA_RESP_GALLERY); ?> --</option>
									<option <?php selected($mwa_rglgallery_googlefont_gallery_title, "'Altasi'"); ?> value="'Altasi'">Altasi</option>
										<option <?php selected($mwa_rglgallery_googlefont_gallery_title, "cursive"); ?> value="cursive">Cursive</option>
										<option <?php selected($mwa_rglgallery_googlefont_gallery_title, "emoji"); ?> value="emoji">Emoji</option>
										<option <?php selected($mwa_rglgallery_googlefont_gallery_title, "fangsong"); ?> value="fangsong">Fangsong</option>
										<option <?php selected($mwa_rglgallery_googlefont_gallery_title, "fantasy"); ?> value="fantasy">Fantasy</option>
										<option <?php selected($mwa_rglgallery_googlefont_gallery_title, "inherit"); ?> value="inherit">Inherit</option>
										<option <?php selected($mwa_rglgallery_googlefont_gallery_title, "monospace"); ?> value="monospace">Monospace</option>
										<option <?php selected($mwa_rglgallery_googlefont_gallery_title, "revert"); ?> value="revert">Revert</option>
								</select>
							</td>	
						</tr>
						<tr>
							<th>
								<label for="mwa_rglgallery_googlefont"><?php esc_html_e('Font For Thumbnail Title',MWA_RESP_GALLERY); ?></label>
							</th>
							<td>
								<select id="mwa_rglgallery_googlefont" name="mwa_rglgallery_googlefont" class="form-control">
									<option id="mwa_freefonts_option" readonly value="">-- <?php esc_html_e('Select Font Family',MWA_RESP_GALLERY); ?> --</option>
									<option <?php selected($mwa_rglgallery_googlefont, "'Altasi'"); ?> value="'Altasi'">Altasi</option>
									<option <?php selected($mwa_rglgallery_googlefont, "cursive"); ?> value="cursive">Cursive</option>
									<option <?php selected($mwa_rglgallery_googlefont, "emoji"); ?> value="emoji">Emoji</option>
									<option <?php selected($mwa_rglgallery_googlefont, "fangsong"); ?> value="fangsong">Fangsong</option>
									<option <?php selected($mwa_rglgallery_googlefont, "fantasy"); ?> value="fantasy">Fantasy</option>
									<option <?php selected($mwa_rglgallery_googlefont, "inherit"); ?> value="inherit">Inherit</option>
									<option <?php selected($mwa_rglgallery_googlefont, "monospace"); ?> value="monospace">Monospace</option>
									<option <?php selected($mwa_rglgallery_googlefont, "revert"); ?> value="revert">Revert</option>
								</select>
							</td>
						</tr>		
					</tbody>					
				</table>
			</div>			
			<?php
		}
	}
}