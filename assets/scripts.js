jQuery(document).ready(function($) {
    var mediaUploader;

    $('#cgp-add-image').on('click', function(e) {
        e.preventDefault();
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: true
        });

        mediaUploader.on('select', function() {
            var attachments = mediaUploader.state().get('selection').map(function(attachment) {
                attachment = attachment.toJSON();
                return attachment;
            });

            attachments.forEach(function(attachment) {
                $('#cgp-gallery-list').append(
                    '<li class="cgp-gallery-item">' +
                    '<input type="hidden" name="cgp_gallery[]" value="' + attachment.id + '">' +
                    '<img src="' + attachment.url + '" alt="">' +
                    '<button type="button" class="cgp-remove-image button">Remove</button>' +
                    '</li>'
                );
            });
        });

        mediaUploader.open();
    });

    $('body').on('click', '.cgp-remove-image', function() {
        $(this).closest('.cgp-gallery-item').remove();
    });
});
