jQuery(function (jQuery) {

    var file_frame,
        lightboxslider = {
            admin_thumb_ul: '',
            init: function () {
                this.admin_thumb_ul = jQuery('#rgl_gallery_thumbs');
                this.admin_thumb_ul.sortable({
                    placeholder: ''
                });
                this.admin_thumb_ul.on('click', '.lbsremove_bt', function () {
                    if (confirm('Are you sure you want to delete this?')) {
                        jQuery(this).parent().fadeOut(1000, function () {
                            jQuery(this).remove();
                        });
                    }
                    return false;
                });

                jQuery('#rgl_gallery_upload_button').on('click', function (event) {
                    event.preventDefault();
                    if (file_frame) {
                        file_frame.open();
                        return;
                    }

                    file_frame = wp.media.frames.file_frame = wp.media({
                        title: jQuery(this).data('uploader_title'),
                        button: {
                            text: jQuery(this).data('uploader_button_text'),
                        },
                        multiple: true
                    });

                    file_frame.on('select', function () {
                        var images = file_frame.state().get('selection').toJSON(),
                            length = images.length;
                        for (var i = 0; i < length; i++) {
                            lightboxslider.get_thumbnail(images[i]['id']);
                        }
                    });
                    file_frame.open();
                });

                jQuery('#rgl_delete_all_button').on('click', function () {
                    if (confirm('Are you sure you want to delete all the image slides?')) {
                        lightboxslider.admin_thumb_ul.empty();
                    }
                    return false;
                });
            },
            get_thumbnail: function (id, cb) {
                cb = cb || function () {
                };
                var data = {
                    action: 'rgl_get_thumbnail',
                    imageid: id
                };
                jQuery.post(ajaxurl, data, function (response) {
                    lightboxslider.admin_thumb_ul.append(response);
                    cb();
                });
            },
            get_all_thumbnails: function (post_id, included) {
                var data = {
                    action: 'lightboxslider_get_all_thumbnail',
                    post_id: post_id,
                    included: included
                };
                jQuery('#rpggallery_spinner').show();
                jQuery.post(ajaxurl, data, function (response) {
                    lightboxslider.admin_thumb_ul.append(response);
                    jQuery('#rpggallery_spinner').hide();
                });
            }
        };
    lightboxslider.init();
});

jQuery(document).ready(function($){
    jQuery('.my-color-field').wpColorPicker();
});