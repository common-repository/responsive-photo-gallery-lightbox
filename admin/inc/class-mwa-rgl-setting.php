<?php
defined( 'ABSPATH' ) or die();
if (! class_exists( 'MWARGLSetting' )){
	class MWARGLSetting
	{
		function __construct($post){
			$PostId    = $post->ID;
			self::mwa_rgl_setting_caller($PostId);						
		}		

		public static function mwa_rgl_setting_caller($PostId){			
			
			$MWARGL_Gallery_Settings = "MWARGL_Gallery_Settings_" . $PostId;
			$MWARGL_Settings         = get_post_meta( $PostId, $MWARGL_Gallery_Settings, true );

			if ( is_array($MWARGL_Settings)){
				$mwa_rglgallery_title  				= $MWARGL_Settings['mwa_rglgallery_title'];
				$mwa_rglgallery_type   				= $MWARGL_Settings['mwa_rglgallery_type'];
				$mwa_rglgallery_ttl_clr 			= $MWARGL_Settings['mwa_rglgallery_ttl_clr'];
				$mwa_rglgallery_galcol				= $MWARGL_Settings['mwa_rglgallery_galcol'];
				$mwa_rglgallery_navtype 			= $MWARGL_Settings['mwa_rglgallery_navtype'];				
				$mwa_rglgallery_thumblbl_fg_clr		= $MWARGL_Settings['mwa_rglgallery_thumblbl_fg_clr'];
				$mwa_rglgallery_thumblbl_bg_clr		= $MWARGL_Settings['mwa_rglgallery_thumblbl_bg_clr'];
				$mwa_rglgallery_thumblbl_opacity 	= $MWARGL_Settings['mwa_rglgallery_thumblbl_opacity'];
				$mwa_rglgallery_thumb_border_size 	= $MWARGL_Settings['mwa_rglgallery_thumb_border_size'];
				$mwa_rglgallery_thumb_border_clr 	= $MWARGL_Settings['mwa_rglgallery_thumb_border_clr'];
				$mwa_rglgallery_thumb_bullets_clr	= $MWARGL_Settings['mwa_rglgallery_thumb_bullets_clr'];
				$mwa_rglgallery_thumb_bullettype	= $MWARGL_Settings['mwa_rglgallery_thumb_bullettype'];				
				$mwa_rglgallery_lb_bg_clr 			= $MWARGL_Settings['mwa_rglgallery_lb_bg_clr'];				
				$mwa_rglgallery_thumb_hover_clr_1 	= $MWARGL_Settings['mwa_rglgallery_thumb_hover_clr_1'];
				$mwa_rglgallery_thumb_hover_clr_2 	= $MWARGL_Settings['mwa_rglgallery_thumb_hover_clr_2'];
				$mwa_rglgallery_title_align			= $MWARGL_Settings['mwa_rglgallery_title_align'];				
				$mwa_rglgallery_googlefont			= $MWARGL_Settings['mwa_rglgallery_googlefont'];

				if(isset($MWARGL_Settings['mwa_rglgallery_thumb_icon'])){
					$mwa_rglgallery_thumb_icon 			= $MWARGL_Settings['mwa_rglgallery_thumb_icon'];
				}else{
					$mwa_rglgallery_thumb_icon			= "f055";
				}
				
			}else{
				$mwa_rglgallery_title				= "";
				$mwa_rglgallery_type				= 1;
				$mwa_rglgallery_ttl_clr 			= "#000000";
				$mwa_rglgallery_galcol				= 4;
				$mwa_rglgallery_navtype				= "true";
				$mwa_rglgallery_thumblbl_bg_clr		= "#000000";
				$mwa_rglgallery_thumblbl_fg_clr		= "#ffffff";
				$mwa_rglgallery_thumblbl_opacity 	= "0.8";
				$mwa_rglgallery_thumb_border_size 	= 1;
				$mwa_rglgallery_thumb_border_clr	= "#000000";
				$mwa_rglgallery_thumb_bullettype	= "50";
				$mwa_rglgallery_thumb_bullets_clr	= "#717477";
				$mwa_rglgallery_lb_bg_clr 			= "#ffffff";				
				$mwa_rglgallery_thumb_hover_clr_1 	= "#4a626e";
				$mwa_rglgallery_thumb_hover_clr_2 	= "#1e2130";
				$mwa_rglgallery_title_align			= "left";				
				$mwa_rglgallery_googlefont			= "";
				$mwa_rglgallery_thumb_icon			= "f055";
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
								<label for="mwa_rglgallery_type"><?php esc_html_e('Gallery Template',MWA_RESP_GALLERY); ?></label>
							</th>
							<td colspan="2">
								<select name="mwa_rglgallery_type" id="mwa_rglgallery_type" class="form-control">
									<option <?php selected($mwa_rglgallery_type, "1"); ?> value="1"><?php esc_html_e('Mobo Gallery 1',MWA_RESP_GALLERY); ?></option>
									<option  <?php selected($mwa_rglgallery_type, "2"); ?> value="2"><?php esc_html_e('Mobo Gallery 2',MWA_RESP_GALLERY); ?></option>
								</select>
							</td>
							<td ></td>	
						</tr>
						
						<tr>
							<th>
								<label for="mwa_rglgallery_title"><?php esc_html_e('Gallery Title',MWA_RESP_GALLERY); ?></label>
							</th>
							<td>
								<input type="text" name="mwa_rglgallery_title" id="mwa_rglgallery_title" class="form-control" value="<?php echo esc_attr($mwa_rglgallery_title); ?>" placeholder="Enter Gallery Title">
							</td>

							<th>
								<label><?php esc_html_e('Title Alignment',MWA_RESP_GALLERY); ?></label>
							</th>
							<td>
								<select id="mwa_rglgallery_title_align" name="mwa_rglgallery_title_align" class="form-control">
									<option value="center" <?php selected($mwa_rglgallery_title_align, "center"); ?>><?php esc_html_e('Center',MWA_RESP_GALLERY); ?></option>
									<option value="right" <?php selected($mwa_rglgallery_title_align, "right"); ?>><?php esc_html_e('Right',MWA_RESP_GALLERY); ?></option>
									<option value="left" <?php selected($mwa_rglgallery_title_align, "left"); ?>><?php esc_html_e('Left',MWA_RESP_GALLERY); ?></option>
								</select>
							</td>
						</tr>				

						<tr>
							<th>
								<label><?php esc_html_e('Gallery Title Color',MWA_RESP_GALLERY); ?></label>
							</th>							
							<td>
								<input type="text" name="mwa_rglgallery_ttl_clr" id="mwa_rglgallery_ttl_clr" value="<?php echo esc_attr($mwa_rglgallery_ttl_clr); ?>" class="my-color-field" data-default-color="#000000" />
							</td>							

							<th id="mwa_rglgallery_thumblbl_bg_clr">
								<label><?php esc_html_e('Thumbnail Label Background Color',MWA_RESP_GALLERY); ?></label>
							</th>
							<td id="mwa_rglgallery_thumblbl_bg_clr">
								<input type="text" name="mwa_rglgallery_thumblbl_bg_clr" id="mwa_rglgallery_thumblbl_bg_clr" value="<?php echo esc_attr($mwa_rglgallery_thumblbl_bg_clr); ?>" class="my-color-field" data-default-color="#000000" />
							</td>
						</tr>
						
						<tr>
							<th id="mwa_rglgallery_thumblbl_fg_clr">
								<label><?php esc_html_e('Thumbnail Label Text Color',MWA_RESP_GALLERY); ?></label>
							</th>
							<td id="mwa_rglgallery_thumblbl_fg_clr">
								<input type="text" name="mwa_rglgallery_thumblbl_fg_clr" id="mwa_rglgallery_thumblbl_fg_clr" value="<?php echo esc_attr($mwa_rglgallery_thumblbl_fg_clr); ?>" class="my-color-field" data-default-color="#ffffff" />
							</td>

							<th id="mwa_rglgallery_thumblbl_opacity">
								<label><?php esc_html_e('Thumbnail Label Opacity',MWA_RESP_GALLERY); ?></label>
							</th>
							<td id="mwa_rglgallery_thumblbl_opacity">
								<select name="mwa_rglgallery_thumblbl_opacity" id="mwa_rglgallery_thumblbl_opacity" class="form-control">
									<option <?php selected($mwa_rglgallery_thumblbl_opacity, "0.1"); ?> value="0.1"><?php esc_html_e('0.1',MWA_RESP_GALLERY); ?></option>
									<option  <?php selected($mwa_rglgallery_thumblbl_opacity, "0.2"); ?> value="0.2"><?php esc_html_e('0.2',MWA_RESP_GALLERY); ?></option>
									<option  <?php selected($mwa_rglgallery_thumblbl_opacity, "0.3"); ?> value="0.3"><?php esc_html_e('0.3',MWA_RESP_GALLERY); ?></option>
									<option  <?php selected($mwa_rglgallery_thumblbl_opacity, "0.4"); ?> value="0.4"><?php esc_html_e('0.4',MWA_RESP_GALLERY); ?></option>
									<option  <?php selected($mwa_rglgallery_thumblbl_opacity, "0.5"); ?> value="0.5"><?php esc_html_e('0.5',MWA_RESP_GALLERY); ?></option>
									<option  <?php selected($mwa_rglgallery_thumblbl_opacity, "0.6"); ?> value="0.6"><?php esc_html_e('0.6',MWA_RESP_GALLERY); ?></option>
									<option  <?php selected($mwa_rglgallery_thumblbl_opacity, "0.7"); ?> value="0.7"><?php esc_html_e('0.7',MWA_RESP_GALLERY); ?></option>
									<option  <?php selected($mwa_rglgallery_thumblbl_opacity, "0.8"); ?> value="0.8"><?php esc_html_e('0.8',MWA_RESP_GALLERY); ?></option>
									<option  <?php selected($mwa_rglgallery_thumblbl_opacity, "0.9"); ?> value="0.9"><?php esc_html_e('0.9',MWA_RESP_GALLERY); ?></option>
								</select>
							</td>
						</tr>

						<tr>
							<th id="mwa_rglgallery_thumb_border_clr">
								<label><?php esc_html_e('Thumbnail Border Color',MWA_RESP_GALLERY); ?></label>
							</th>
							<td id="mwa_rglgallery_thumb_border_clr">
								<input type="text" name="mwa_rglgallery_thumb_border_clr" id="mwa_rglgallery_thumb_border_clr" value="<?php echo esc_attr($mwa_rglgallery_thumb_border_clr); ?>" class="my-color-field" data-default-color="#000000" />
							</td>

							<th id="mwa_rglgallery_thumb_border_size"><label><?php esc_html_e('Thumbnail Border Size',MWA_RESP_GALLERY); ?></label></th>
							<td id="mwa_rglgallery_thumb_border_size">
								<select name="mwa_rglgallery_thumb_border_size" id="mwa_rglgallery_thumb_border_size" class="form-control">
									<option <?php selected($mwa_rglgallery_thumb_border_size, "1"); ?> value="1"><?php esc_html_e('1 PX',MWA_RESP_GALLERY); ?></option>
									<option  <?php selected($mwa_rglgallery_thumb_border_size, "2"); ?> value="2"><?php esc_html_e('2 PX',MWA_RESP_GALLERY); ?></option>
									<option  <?php selected($mwa_rglgallery_thumb_border_size, "3"); ?> value="3"><?php esc_html_e('3 PX',MWA_RESP_GALLERY); ?></option>	
									<option  <?php selected($mwa_rglgallery_thumb_border_size, "4"); ?> value="4"><?php esc_html_e('4 PX',MWA_RESP_GALLERY); ?></option>	
									<option  <?php selected($mwa_rglgallery_thumb_border_size, "5"); ?> value="5"><?php esc_html_e('5 PX',MWA_RESP_GALLERY); ?></option>
								</select>
							</td>
						</tr>

						<tr class="gallery_1 gallery_4">
							<th id="thumbclrhover_1">
								<label><?php esc_html_e('Thumbnail Hover Color 1',MWA_RESP_GALLERY); ?></label>
							</th>
							<td id="thumbclrhover_1">
								<input type="text" name="mwa_rglgallery_thumb_hover_clr_1" id="mwa_rglgallery_thumb_hover_clr_1" value="<?php echo esc_attr($mwa_rglgallery_thumb_hover_clr_1); ?>" class="my-color-field" data-default-color="#4a626e" />
							</td>
							<th id="thumbclrhover_2">
								<label><?php esc_html_e('Thumbnail Hover Color 2',MWA_RESP_GALLERY); ?></label>
							</th>
							<td id="thumbclrhover_2">
								<input type="text" name="mwa_rglgallery_thumb_hover_clr_2" id="mwa_rglgallery_thumb_hover_clr_2" value="<?php echo esc_attr($mwa_rglgallery_thumb_hover_clr_2); ?>" class="my-color-field" data-default-color="#1e2130" />
							</td>
						</tr>
						
						<tr class="gallery_1 gallery_3 gallery_4">
							<th id="thumb_bult_clr">
								<label><?php esc_html_e('Thumbnail Bullets Color',MWA_RESP_GALLERY); ?></label>
							</th>
							<td id="thumb_bult_clr">
								<input type="text" name="mwa_rglgallery_thumb_bullets_clr" id="mwa_rglgallery_thumb_bullets_clr" value="<?php echo esc_attr($mwa_rglgallery_thumb_bullets_clr); ?>" class="my-color-field" data-default-color="#717477" />
							</td>

							<th id="thumb_bult_type"><label><?php esc_html_e('Thumbnail Bullets Type',MWA_RESP_GALLERY); ?></label></th>
							<td id="thumb_bult_type">
								<select name="mwa_rglgallery_thumb_bullettype" id="mwa_rglgallery_thumb_bullettype" class="form-control">
									<option <?php selected($mwa_rglgallery_thumb_bullettype, "50"); ?> value="50"><?php esc_html_e('Circle',MWA_RESP_GALLERY); ?></option>
									<option <?php selected($mwa_rglgallery_thumb_bullettype, "0"); ?> value="0"><?php esc_html_e('Rectangle',MWA_RESP_GALLERY); ?></option>	
								</select>
							</td>
						</tr>

						<tr>
							<th id="mwa_rglgallery_thumb_icon"><label><?php esc_html_e('Thumbnail Hover Icon',MWA_RESP_GALLERY); ?></label></th>
							<td id="thumb_icon">
								<input type="text" name="mwa_rglgallery_thumb_icon" id="mwa_rglgallery_thumb_icon" value="<?php echo esc_attr($mwa_rglgallery_thumb_icon); ?>" class="form-control"/>
								<p class="para_thumbicon"><?php esc_html_e('Paste only Unicode',MWA_RESP_GALLERY); ?></p>
							</td>
							<th>
								<?php esc_html_e('Get More Icon List',MWA_RESP_GALLERY); ?> 
							</th>
							<td><a href="https://www.fontawesomecheatsheet.com/font-awesome-cheatsheet-5x/" target="_blank" class="btn btn-info"><?php esc_html_e('Click Here',MWA_RESP_GALLERY); ?></a></td>
						</tr>

						<tr class="gallery_3">
							<th id="mwa_rglgallery_galcol"><label><?php esc_html_e('Gallery Column',MWA_RESP_GALLERY); ?></label></th>
							<td id="mwa_rglgallery_galcol">
								<select name="mwa_rglgallery_galcol" id="mwa_rglgallery_galcol" class="form-control">
									<option <?php selected($mwa_rglgallery_galcol, "1"); ?> value="1"><?php esc_html_e('1 Column',MWA_RESP_GALLERY); ?></option>
									<option  <?php selected($mwa_rglgallery_galcol, "2"); ?> value="2"><?php esc_html_e('2 Column',MWA_RESP_GALLERY); ?></option>
									<option <?php selected($mwa_rglgallery_galcol, "3"); ?> value="3"><?php esc_html_e('3 Column',MWA_RESP_GALLERY); ?></option>
									<option class="gallery_5" <?php selected($mwa_rglgallery_galcol, "4"); ?> value="4"><?php esc_html_e('4 Column',MWA_RESP_GALLERY); ?></option>
									<option class="gallery_5" <?php selected($mwa_rglgallery_galcol, "5"); ?> value="5"><?php esc_html_e('5 Column',MWA_RESP_GALLERY); ?></option>
									<option class="gallery_5" <?php selected($mwa_rglgallery_galcol, "6"); ?> value="6"><?php esc_html_e('6 Column',MWA_RESP_GALLERY); ?></option>
								</select>
							</td>

							<th id="gal_navtype" class="gallery_1 gallery_3 gallery_4"><label><?php esc_html_e('Gallery Navigation Type',MWA_RESP_GALLERY); ?></label></th>
							<td id="gal_navtype" class="gallery_1 gallery_3 gallery_4">
								<select name="mwa_rglgallery_navtype" id="mwa_rglgallery_navtype" class="form-control">
									<option <?php selected($mwa_rglgallery_navtype, "true"); ?> value="true"><?php esc_html_e('Bullet',MWA_RESP_GALLERY); ?></option>
									<option  <?php selected($mwa_rglgallery_navtype, "false"); ?> value="false"><?php esc_html_e('Arrow',MWA_RESP_GALLERY); ?></option>	
								</select>
							</td>							
						</tr>
						<tr class="gallery_1 gallery_3 gallery_4">
							<th class="gallery_5">
								<label><?php esc_html_e('Lightbox Background Color',MWA_RESP_GALLERY); ?></label>
							</th>
							<td class="gallery_5">
								<input type="text" name="mwa_rglgallery_lb_bg_clr" id="mwa_rglgallery_lb_bg_clr" value="<?php echo esc_attr($mwa_rglgallery_lb_bg_clr); ?>" class="my-color-field" data-default-color="#ffffff" />
							</td>													
						</tr>													
					</tbody>					
				</table>
			</div>			
			<script type="text/javascript">				
	            jQuery(document).ready(function() {
	             	<?php
						if($mwa_rglgallery_type == 1){
							?>
								jQuery('#thumbclrhover_1,#thumbclrhover_2').hide();
								jQuery('#mwa_rglgallery_thumb_border_clr,#mwa_rglgallery_thumb_border_size,#mwa_rglgallery_galcol,#mwa_rglgallery_thumblbl_bg_clr,#mwa_rglgallery_thumblbl_fg_clr,#mwa_rglgallery_thumblbl_opacity').show();
							<?php
						}elseif($mwa_rglgallery_type == 2){
							?>
								jQuery('#thumbclrhover_1,#thumbclrhover_2').hide();
								jQuery('#thumb_bult_clr,#thumb_bult_type,#gal_navtype,#mwa_rglgallery_thumb_border_clr,#mwa_rglgallery_thumb_border_size,#mwa_rglgallery_galcol,#mwa_rglgallery_thumblbl_bg_clr,#mwa_rglgallery_thumblbl_fg_clr,#mwa_rglgallery_thumblbl_opacity').show();
							<?php
						}else{
							?>
								jQuery('#thumbclrhover_1,#thumbclrhover_2,#thumb_bult_clr,#thumb_bult_type,#gal_navtype').hide();
								jQuery('#mwa_rglgallery_thumb_border_clr,#mwa_rglgallery_thumb_border_size,#mwa_rglgallery_galcol,#mwa_rglgallery_thumblbl_bg_clr,#mwa_rglgallery_thumblbl_fg_clr,#mwa_rglgallery_thumblbl_opacity').show();
							<?php
						}
					?>
	            })
	          </script>		
			<?php
		}
	}
}