<?php
defined( 'ABSPATH' ) or die();
include('gallery-libs.php');

$PostId 					= gallery_1($post_id);
$MWARGL_Gallery_Settings 	= "MWARGL_Gallery_Settings_" . $PostId;
$MWARGL_Settings         	= get_post_meta( $PostId, $MWARGL_Gallery_Settings, true );

if ( is_array($MWARGL_Settings)){
	$mwa_rglgallery_title			= $MWARGL_Settings['mwa_rglgallery_title'];
	$mwa_rglgallery_galcol			= $MWARGL_Settings['mwa_rglgallery_galcol'];
	$mwa_rglgallery_navtype			= $MWARGL_Settings['mwa_rglgallery_navtype'];	
	$mwa_rglgallery_type 			= $MWARGL_Settings['mwa_rglgallery_type'];
}else{
	$mwa_rglgallery_title			= "";
	$mwa_rglgallery_galcol			= 4;
	$mwa_rglgallery_navtype 		= "true";
	$mwa_rglgallery_type 			= 1;
}

$RGL_AllPhotosDetails  = get_post_meta($PostId, 'rgl_all_photos_details', true);
$TotalImages           = get_post_meta($PostId, 'rgl_total_images_count', true);
?>
 <section class="content">
 	<?php if(!empty($mwa_rglgallery_title)){ ?>
		<h3 class="mwa_rgl_headttl ribbon"><?php echo esc_html($mwa_rglgallery_title); ?></h3>
	<?php }?>
    <div id="thumbGallery"
		class="thumbGallery"
		data-thumbGallery="true"
		data-nav_effect="fade"
		data-nav_delay="100"
		data-nav_timing="1000"
		data-nav_show="<?php echo esc_attr($mwa_rglgallery_navtype); ?>"
		data-nav_delay_inverse="1"
		data-nav_pagination="<?php echo esc_attr($mwa_rglgallery_galcol); ?>"             
    >
    <?php
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
					<img src="<?php echo esc_url($url); ?>" data-highres="<?php echo esc_url($url); ?>" data-caption="<?php echo esc_attr($name); ?>"/>	

				<?php
			}
		}else {
			$TotalImages = 0;
		}
    ?>       
    </div>
</section>