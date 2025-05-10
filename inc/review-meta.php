<?php

function add_review_meta_boxes()
{
    add_meta_box(
        'review_details',
        'Review Details',
        'render_review_meta_box',
        'post',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_review_meta_boxes');

function render_review_meta_box($post)
{
    // Get existing values
    $rating = get_post_meta($post->ID, '_tc_rating', true);
    $price = get_post_meta($post->ID, '_tc_price', true);
    $affiliate_link = get_post_meta(
        $post->ID,
        '_tc_affiliate_link_amazon',
        true
    );
    $featured_review = get_post_meta($post->ID, '_tc_featured_review', true);
    $quick_note = get_post_meta($post->ID, '_tc_quick_note', true);
    $short_title = get_post_meta($post->ID, '_tc_short_title', true); // Add this line

    // Add nonce for security
    wp_nonce_field('review_meta_box', 'review_meta_box_nonce');
    ?>
    <div class="review-meta-box">
        <p>
            <label for="short_title">Short Product Title:</label>
            <input type="text" id="short_title" name="_tc_short_title" 
                   value="<?php echo esc_attr($short_title); ?>" 
                   placeholder="e.g. Hotel Hoxton"
                   style="width: 100%;">
            <span class="description">A concise product name for the featured products grid</span>
        </p>
        <p>
            <label for="rating">Rating (1-5):</label>
            <input type="number" id="rating" name="_tc_rating" 
                   value="<?php echo esc_attr($rating); ?>" 
                   min="1" max="5" step="0.5" style="width: 70px;">
        </p>
        <p>
            <label for="price">Price:</label>
            <input type="text" id="price" name="_tc_price" 
                   value="<?php echo esc_attr($price); ?>" 
                   placeholder="e.g. $29.99">
        </p>
        <p>
            <label for="affiliate_link">Amazon Affiliate Link:</label>
            <input type="url" id="affiliate_link" name="_tc_affiliate_link_amazon" 
                   value="<?php echo esc_url($affiliate_link); ?>" 
                   style="width: 100%;">
        </p>
        <p>
            <label>
                <input type="checkbox" name="_tc_featured_review" 
                       value="1" <?php checked($featured_review, '1'); ?>>
                Feature this review in category page
            </label>
        </p>
        <p>
            <label for="quick_note">Quick Note (for featured reviews):</label>
            <textarea id="quick_note" name="_tc_quick_note" 
                      rows="2" style="width: 100%;"><?php echo esc_textarea(
                          $quick_note
                      ); ?></textarea>
        </p>
    </div>
    <style>
        .review-meta-box label {
            display: inline-block;
            min-width: 120px;
            margin-bottom: 5px;
        }
    </style>
    <?php
}

function save_review_meta($post_id)
{
    // Security checks
    if (
        !isset($_POST['review_meta_box_nonce']) ||
        !wp_verify_nonce($_POST['review_meta_box_nonce'], 'review_meta_box')
    ) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = [
        '_tc_rating' => 'floatval',
        '_tc_price' => 'sanitize_text_field',
        '_tc_affiliate_link_amazon' => 'esc_url_raw',
        '_tc_featured_review' => 'intval',
        '_tc_quick_note' => 'sanitize_textarea_field',
        '_tc_short_title' => 'sanitize_text_field', // Add this line
    ];

    foreach ($fields as $field => $sanitize_callback) {
        if (isset($_POST[$field])) {
            update_post_meta(
                $post_id,
                $field,
                $sanitize_callback($_POST[$field])
            );
        } elseif ($field === '_tc_featured_review') {
            delete_post_meta($post_id, $field);
        }
    }
}
add_action('save_post', 'save_review_meta');
