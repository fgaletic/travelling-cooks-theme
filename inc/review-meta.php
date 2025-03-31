<?php

function tc_add_review_meta_boxes() {
    if (has_category('reviews')) {
        add_meta_box(
            'tc_review_meta',
            'Review Details',
            'tc_review_meta_callback',
            'post',
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'tc_add_review_meta_boxes');

function tc_review_meta_callback($post) {
    wp_nonce_field('tc_review_meta_nonce', 'tc_review_meta_nonce');
    
    $fields = [
        'product_name' => get_post_meta($post->ID, '_tc_product_name', true),
        'brand' => get_post_meta($post->ID, '_tc_brand', true),
        'rating' => get_post_meta($post->ID, '_tc_rating', true),
        'price' => get_post_meta($post->ID, '_tc_price', true),
        'pros' => get_post_meta($post->ID, '_tc_pros', true),
        'cons' => get_post_meta($post->ID, '_tc_cons', true)
    ];

    tc_output_meta_styles();
    ?>
    <div class="tc-meta-box">
        <div class="tc-meta-grid">
            <div class="tc-meta-field">
                <label for="tc_product_name">Product Name</label>
                <input type="text" id="tc_product_name" name="tc_product_name" 
                    value="<?php echo esc_attr($fields['product_name']); ?>" 
                    placeholder="e.g., Travel Coffee Kit">
            </div>

            <div class="tc-meta-field">
                <label for="tc_brand">Brand</label>
                <input type="text" id="tc_brand" name="tc_brand" 
                    value="<?php echo esc_attr($fields['brand']); ?>" 
                    placeholder="e.g., TravelBrew">
            </div>

            <div class="tc-meta-field">
                <label for="tc_rating">Rating</label>
                <select id="tc_rating" name="tc_rating">
                    <option value="">Select Rating</option>
                    <?php for ($i = 1; $i <= 5; $i += 0.5) : ?>
                        <option value="<?php echo $i; ?>" <?php selected($fields['rating'], (string)$i); ?>>
                            <?php echo $i; ?> Stars
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="tc-meta-field">
                <label for="tc_price">Price Range</label>
                <select id="tc_price" name="tc_price">
                    <option value="">Select Price Range</option>
                    <option value="budget" <?php selected($fields['price'], 'budget'); ?>>Budget ($)</option>
                    <option value="mid-range" <?php selected($fields['price'], 'mid-range'); ?>>Mid-Range ($$)</option>
                    <option value="premium" <?php selected($fields['price'], 'premium'); ?>>Premium ($$$)</option>
                </select>
            </div>

            <div class="tc-meta-field tc-meta-full">
                <label for="tc_pros">Pros</label>
                <textarea id="tc_pros" name="tc_pros" class="tc-meta-textarea" 
                    placeholder="List the positive aspects"><?php echo esc_textarea($fields['pros']); ?></textarea>
            </div>

            <div class="tc-meta-field tc-meta-full">
                <label for="tc_cons">Cons</label>
                <textarea id="tc_cons" name="tc_cons" class="tc-meta-textarea" 
                    placeholder="List the negative aspects"><?php echo esc_textarea($fields['cons']); ?></textarea>
            </div>
        </div>
    </div>
    <?php
}

function tc_save_review_meta($post_id) {
    if (!isset($_POST['tc_review_meta_nonce']) || 
        !wp_verify_nonce($_POST['tc_review_meta_nonce'], 'tc_review_meta_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = ['product_name', 'brand', 'rating', 'price', 'pros', 'cons'];

    foreach ($fields as $field) {
        if (isset($_POST['tc_' . $field])) {
            $value = in_array($field, ['pros', 'cons']) ? 
                sanitize_textarea_field($_POST['tc_' . $field]) : 
                sanitize_text_field($_POST['tc_' . $field]);
            update_post_meta($post_id, '_tc_' . $field, $value);
        }
    }
}
add_action('save_post', 'tc_save_review_meta');