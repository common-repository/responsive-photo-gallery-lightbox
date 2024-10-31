<html>
    <head>
        <title><?php _e('Gallery Preview', MWA_RESP_GALLERY); ?></title>
        <?php wp_head(); ?>
        <style>
            body:before{display:none !important;}
            body:after{display:none !important;}
            body{background:#F1F1F1 !important;}
            .mwargl-preview-subtitle a { color: #116CB9;}.mwargl-form-preview-wrap {
                width: 60%;
                margin: 0 auto;
                padding: 60px;
                background: #fff;
                box-shadow: 0 0 2px;
                margin-bottom: 20px;
            }
            .mwargl-preview-title-wrap {
                text-align: center;
                font-size: 20px;
            }
            .mwargl-preview-note {
                width: 60%;
                margin: 20px auto;
                font-size: 15px;
                text-align: center;
            }
        </style>       
    </head>
    <body>
        <div class="mwargl-preview-title-wrap">           
            <div class="mwargl-preview-title"><?php _e('Preview Mode', MWA_RESP_GALLERY); ?></div>
        </div>
        <div class="mwargl-preview-note"><?php _e('This is just the basic preview and it may look different when used in frontend as per your theme styles. If Lightbox may also not work properly in the preview mode then try to paste the shortcode in page or post.', MWA_RESP_GALLERY); ?></div>
        <div class="mwargl-form-preview-wrap">
            <?php                                
                echo do_shortcode('[MWA_RGL id="' . force_balance_tags( wp_kses_post($rgliddata) ) . '"]');
            ?>
        </div>
    </body>
    <?php //wp_footer(); ?>
</html>
