<?php

function cgp_add_meta_box() {
    add_meta_box(
        'cgp_gallery_meta_box',
        'Custom Gallery',
        'cgp_meta_box_callback',
        ['post', 'page'],
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'cgp_add_meta_box' );

function cgp_meta_box_callback( $post ) {
    
    wp_nonce_field( basename( __FILE__ ), 'cgp_nonce' );
    $gallery_data = get_post_meta( $post->ID, '_cgp_gallery', true );
    ?>
    <div id="cgp-gallery-container">
        <ul id="cgp-gallery-list">
            <?php if ( ! empty( $gallery_data ) ) : ?>
                <?php foreach ( $gallery_data as $image ) : ?>
                    <li class="cgp-gallery-item">
                        <input type="hidden" name="cgp_gallery[]" value="<?php echo esc_attr( $image ); ?>">
                        <img src="<?php echo esc_url( wp_get_attachment_url( $image ) ); ?>" alt="">
                        <button type="button" class="cgp-remove-image button">Remove</button>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        <button type="button" id="cgp-add-image" class="button">Add Image</button>
    </div>
    <?php
}

function cgp_save_meta_box( $post_id ) {
    if ( ! isset( $_POST['cgp_nonce'] ) || ! wp_verify_nonce( $_POST['cgp_nonce'], basename( __FILE__ ) ) ) {
        return $post_id;
    }

    $gallery_data = get_post_meta( $post_id, '_cgp_gallery', true );

    $new_gallery_data = ( isset( $_POST['cgp_gallery'] ) ) ? array_map( 'sanitize_text_field', $_POST['cgp_gallery'] ) : [];

    update_post_meta( $post_id, '_cgp_gallery', $new_gallery_data, $gallery_data );
}
add_action( 'save_post', 'cgp_save_meta_box' );
