(function ($) {
    "use strict";

    $(document).ready(function () {
        var post_formats_select = $('#post-formats-select');
        var post_format_options = post_formats_select.find('input[type="radio"][name="post_format"]');
        var post_format_video_metabox = $('#post_format_video');
        var post_format_gallery_metabox = $('#post_format_gallery');
        var post_format_audio_metabox = $('#post_format_audio');
        var post_format_link_metabox = $('#post_format_link');
        var post_format_quote_metabox = $('#post_format_quote');

        setTimeout(function () {
            showPostFormatsMetaboxes();
        }, 500);

        post_format_options.on('change', function () {
            showPostFormatsMetaboxes();
        });

        // Gutenberg
        if (typeof wp != 'undefined' && typeof wp.data != 'undefined' && typeof wp.data.subscribe != 'undefined') {
            wp.data.subscribe(function () {
                showPostFormatsMetaboxes();
            });
        }

        function showPostFormatsMetaboxes() {
            var post_format = post_formats_select.find('input[type="radio"][name="post_format"]:checked').val();
            if (typeof wp != 'undefined' && typeof wp.data != 'undefined' && typeof wp.data.select('core/editor') != 'undefined' && wp.data.select('core/editor') != null) {
                post_format = wp.data.select('core/editor').getEditedPostAttribute('format');
            }
            if (post_format == '0' || post_format == 'standard') {
                post_format_video_metabox.hide();
                post_format_gallery_metabox.hide();
                post_format_audio_metabox.hide();
                post_format_link_metabox.hide();
                post_format_quote_metabox.hide();
            } else if (post_format == 'video') {
                post_format_video_metabox.show();
                post_format_gallery_metabox.hide();
                post_format_audio_metabox.hide();
                post_format_link_metabox.hide();
                post_format_quote_metabox.hide();
            } else if (post_format == 'gallery') {
                post_format_video_metabox.hide();
                post_format_gallery_metabox.show();
                post_format_audio_metabox.hide();
                post_format_link_metabox.hide();
                post_format_quote_metabox.hide();
            } else if (post_format == 'audio') {
                post_format_video_metabox.hide();
                post_format_gallery_metabox.hide();
                post_format_audio_metabox.show();
                post_format_link_metabox.hide();
                post_format_quote_metabox.hide();
            } else if (post_format == 'link') {
                post_format_video_metabox.hide();
                post_format_gallery_metabox.hide();
                post_format_audio_metabox.hide();
                post_format_link_metabox.show();
                post_format_quote_metabox.hide();
            } else if (post_format == 'quote') {
                post_format_video_metabox.hide();
                post_format_gallery_metabox.hide();
                post_format_audio_metabox.hide();
                post_format_link_metabox.hide();
                post_format_quote_metabox.show();
            }
        }
    });
}(jQuery));