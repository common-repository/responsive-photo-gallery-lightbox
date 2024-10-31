<?php
	defined('ABSPATH') or die();
	wp_enqueue_style('mb-gallery-css', MWA_RESP_GAL_URL . 'assets/gallery-assets/gallery-1/css/jquery.mb.gallery.min.css');
	wp_enqueue_script( 'mb-gallery-js', MWA_RESP_GAL_URL . 'assets/gallery-assets/gallery-1/js/jquery.mb.gallery.js' );
	wp_enqueue_script( 'bootstrap-min-js', MWA_RESP_GAL_URL . 'assets/js/bootstrap.min.js' );
	wp_enqueue_style('bootstrap-min-css', MWA_RESP_GAL_URL . 'assets/css/bootstrap.min.css');
    wp_enqueue_style('mwa-rgl-fontawesome', MWA_RESP_GAL_URL . 'assets/fontawesome/css/all.min.css', array(), true, 'all');
	
    $PostId 					= gallery_2($post_id);
    $MWARGL_Gallery_Settings    = "MWARGL_Gallery_Settings_" . $PostId;
    $MWARGL_Settings            = get_post_meta( $PostId, $MWARGL_Gallery_Settings, true );

    if ( is_array($MWARGL_Settings)){
        $mwa_rglgallery_ttl_clr             = $MWARGL_Settings['mwa_rglgallery_ttl_clr'];
        $mwa_rglgallery_thumblbl_bg_clr     = $MWARGL_Settings['mwa_rglgallery_thumblbl_bg_clr'];     
        $mwa_rglgallery_thumblbl_fg_clr     = $MWARGL_Settings['mwa_rglgallery_thumblbl_fg_clr'];
        $mwa_rglgallery_thumblbl_opacity    = $MWARGL_Settings['mwa_rglgallery_thumblbl_opacity'];

        $mwa_rglgallery_thumb_border_size   = $MWARGL_Settings['mwa_rglgallery_thumb_border_size'];
        $mwa_rglgallery_thumb_border_clr    = $MWARGL_Settings['mwa_rglgallery_thumb_border_clr'];
        $mwa_rglgallery_thumb_bullets_clr   = $MWARGL_Settings['mwa_rglgallery_thumb_bullets_clr'];
        $mwa_rglgallery_thumb_bullettype    = $MWARGL_Settings['mwa_rglgallery_thumb_bullettype'];
        $mwa_rgl_desc_custcss               = $MWARGL_Settings['mwa_rgl_desc_custcss'];
        $mwa_rglgallery_title_align         = $MWARGL_Settings['mwa_rglgallery_title_align'];
        $mwa_rglgallery_googlefont                = $MWARGL_Settings['mwa_rglgallery_googlefont'];
        $mwa_rglgallery_googlefont_gallery_title  = $MWARGL_Settings['mwa_rglgallery_googlefont_gallery_title'];
        $mwa_rglgallery_lb_bg_clr  = $MWARGL_Settings['mwa_rglgallery_lb_bg_clr']; 
        if(isset($MWARGL_Settings['mwa_rglgallery_thumb_icon'])){
            $mwa_rglgallery_thumb_icon          = $MWARGL_Settings['mwa_rglgallery_thumb_icon'];
        }else{
            $mwa_rglgallery_thumb_icon          = "f055";
        }     
        
    }else{
        $mwa_rglgallery_ttl_clr                     = "#000000";
        $mwa_rglgallery_thumblbl_bg_clr             = "#000000";
        $mwa_rglgallery_thumblbl_fg_clr             = "#ffffff";
        $mwa_rglgallery_thumblbl_opacity            = "0.8";
        $mwa_rglgallery_thumb_border_size           = 1;
        $mwa_rglgallery_thumb_border_clr            = "#000000";
        $mwa_rglgallery_thumb_bullettype            = "50";
        $mwa_rglgallery_thumb_bullets_clr           = "#717477";
        $mwa_rgl_desc_custcss                       = "";
        $mwa_rglgallery_title_align                 = "left";
        $mwa_rglgallery_googlefont                  = "inherit";
        $mwa_rglgallery_googlefont_gallery_title    = "inherit";
        $mwa_rglgallery_thumb_icon                  = "f055";
    }
?>
<style type="text/css">
	 .thumb-grid .thumbWrapper {
            width: 100%;
            height: 400px;
        }

        /******** DEMO SWITCHER *******/
        #customize {
            color: white;
            text-align: right;
            position: relative;
            margin: auto;
            width: 100%;
            margin-bottom: 120px;
        }

        #customize input, #customize select {
            font-size: 15px;
            margin: 3px;
            padding: 4px 4px 4px 8px;
            border: 1px solid rgba(38, 41, 43, 0.44);
            color:#fff;
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }

        #customize select {
            margin: 0;
            outline: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            -ms-appearance: none;
            -o-appearance: none;
            appearance: none;
            vertical-align: middle;
        }

        #customize label {
            font-size: 13px;
            margin: 3px 0;
            padding: 3px 10px 3px 0;
            /*width: 160px;*/
            display: inline-block;
            text-align: left;
            text-transform: uppercase;
            font-weight: 500;
        }

        .thumbGallery {
            display: none;
        }

        .tg-captionBox, .tg-img-caption{
            color: <?php echo esc_html($mwa_rglgallery_thumblbl_fg_clr); ?> !important;            
        }
        .tg-captionBox{
            font-family: <?php echo esc_html($mwa_rglgallery_googlefont); ?> !important;
        }
        /*.tg-captionBox, .tg-img-caption, .tg-close, .tg-next, .tg-prev {
            color: <?php //echo $mwa_rglgallery_lbl_clr; ?> !important;
        }*/
        .tg-captionBox, .tg-img-wrapper label {  
            color : <?php echo esc_html($mwa_rglgallery_thumblbl_fg_clr); ?> !important;
            background: <?php echo esc_html($mwa_rglgallery_thumblbl_bg_clr); ?> !important;
            opacity: <?php echo esc_html($mwa_rglgallery_thumblbl_opacity); ?> !important;
        }
        .thumb_box {
            border: <?php echo esc_html($mwa_rglgallery_thumb_border_size); ?>px solid <?php echo esc_html($mwa_rglgallery_thumb_border_clr); ?>;
        }
        nav.thumbGridNav a{
            background: <?php echo esc_html($mwa_rglgallery_thumb_bullets_clr); ?> !important;
            border-radius: <?php echo esc_html($mwa_rglgallery_thumb_bullettype); ?>% !important;
        }
        .mwa_rgl_headttl{
            color: <?php echo esc_html($mwa_rglgallery_ttl_clr); ?>;
            text-align: <?php echo esc_html($mwa_rglgallery_title_align); ?>;
            margin-bottom: 20px;
            font-family: <?php echo esc_html($mwa_rglgallery_googlefont_gallery_title); ?>;
        }
        .tg-placeHolder {            
            background: <?php echo esc_html($mwa_rglgallery_lb_bg_clr); ?> !important;
        }
        <?php
            echo esc_textarea($mwa_rgl_desc_custcss);
        ?>

        @media (max-width: 480px){
            .grid-layout li.thumbWrapper {
                width: 100% !important;
                height: 261px !important;
            }
        }

        .thumbWrapper:hover:after{
            font-family: "Font Awesome 5 Free" !important;
            content: "\<?php echo $mwa_rglgallery_thumb_icon; ?>" !important;
            display: inline-block !important;            
            vertical-align: middle !important;
            font-weight: 900 !important;
        }        
</style>
<script>
jQuery(document).ready( function () {
    var isIframe = function() {
        var a = !1;
        try {
            self.location.href != top.location.href && ( a = !0 )
        } catch ( b ) {
            a = !0
        }
        return a
    };
    if ( !isIframe() ) {
        var logo = jQuery( "<a href='http://pupunzi.com/#mb.components/components.html' style='position:absolute;top:0;z-index:1000'><img id='logo' border='0' src='http://pupunzi.com/images/logo.png' alt='mb.ideas.repository'></a>" );
        jQuery( "#wrapper" ).prepend( logo ), jQuery( "#logo" ).fadeIn();
    }

    /* Initialize the mbGallery */
   var myGallery = jQuery("#thumbGallery").mbGallery();

    /* customizer */
    jQuery("#effect").on("change",function(){
        var x = jQuery(this).val();
        myGallery.data("nav_effect", x);

    });

    jQuery("#delay").on("change",function(){
        var x = parseFloat(jQuery(this).val());
        myGallery.data("nav_delay", x);
    });

    jQuery("#timing").on("change",function(){
        var x = parseFloat(jQuery(this).val());
        myGallery.data("nav_timing", x);
    });

    if(jQuery.isMobile){
        jQuery("body").css({marginBottom: 140})
    }
});	
</script>