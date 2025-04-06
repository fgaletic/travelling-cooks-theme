<?php

function tc_add_travel_meta_boxes()
{
    if (has_category('travel')) {
        add_meta_box(
            'tc_travel_meta',
            'Travel Details',
            'tc_travel_meta_callback',
            'post',
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'tc_add_travel_meta_boxes');

function tc_travel_meta_callback($post)
{
    wp_nonce_field('tc_travel_meta_nonce', 'tc_travel_meta_nonce');

    $fields = [
        'location' => get_post_meta($post->ID, '_tc_location', true),
        'duration' => get_post_meta($post->ID, '_tc_duration', true),
        'best_season' => get_post_meta($post->ID, '_tc_best_season', true),
        'cost_rating' => get_post_meta($post->ID, '_tc_cost_rating', true),
        'highlights' => get_post_meta($post->ID, '_tc_highlights', true),
    ];

    tc_output_meta_styles();
    ?>
    <div class="tc-meta-box">
        <div class="tc-meta-grid">
            <div class="tc-meta-field">
                <label for="tc_location">Location</label>
                <input type="text" id="tc_location" name="tc_location" 
                    value="<?php echo esc_attr($fields['location']); ?>" 
                    placeholder="e.g., Kyoto, Japan">
            </div>

            <div class="tc-meta-field">
                <label for="tc_duration">Trip Duration</label>
                <input type="text" id="tc_duration" name="tc_duration" 
                    value="<?php echo esc_attr($fields['duration']); ?>" 
                    placeholder="e.g., 5 days">
            </div>

            <div class="tc-meta-field">
                <label for="tc_best_season">Best Season to Visit</label>
                <select id="tc_best_season" name="tc_best_season">
                    <option value="">Select Season</option>
                    <option value="spring" <?php selected(
                        $fields['best_season'],
                        'spring'
                    ); ?>>Spring</option>
                    <option value="summer" <?php selected(
                        $fields['best_season'],
                        'summer'
                    ); ?>>Summer</option>
                    <option value="autumn" <?php selected(
                        $fields['best_season'],
                        'autumn'
                    ); ?>>Autumn</option>
                    <option value="winter" <?php selected(
                        $fields['best_season'],
                        'winter'
                    ); ?>>Winter</option>
                </select>
            </div>

            <div class="tc-meta-field">
                <label for="tc_cost_rating">Cost Rating</label>
                <select id="tc_cost_rating" name="tc_cost_rating">
                    <option value="">Select Cost Level</option>
                    <option value="budget" <?php selected(
                        $fields['cost_rating'],
                        'budget'
                    ); ?>>Budget</option>
                    <option value="moderate" <?php selected(
                        $fields['cost_rating'],
                        'moderate'
                    ); ?>>Moderate</option>
                    <option value="luxury" <?php selected(
                        $fields['cost_rating'],
                        'luxury'
                    ); ?>>Luxury</option>
                </select>
            </div>

            <div class="tc-meta-field tc-meta-full">
                <label for="tc_highlights">Key Highlights</label>
                <textarea id="tc_highlights" name="tc_highlights" class="tc-meta-textarea" 
                    placeholder="List the main highlights of this destination"><?php echo esc_textarea(
                        $fields['highlights']
                    ); ?></textarea>
            </div>
        </div>
    </div>
    <?php
}

function tc_save_travel_meta($post_id)
{
    if (
        !isset($_POST['tc_travel_meta_nonce']) ||
        !wp_verify_nonce($_POST['tc_travel_meta_nonce'], 'tc_travel_meta_nonce')
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
        'location',
        'duration',
        'best_season',
        'cost_rating',
        'highlights',
    ];

    foreach ($fields as $field) {
        if (isset($_POST['tc_' . $field])) {
            $value =
                $field === 'highlights'
                    ? sanitize_textarea_field($_POST['tc_' . $field])
                    : sanitize_text_field($_POST['tc_' . $field]);
            update_post_meta($post_id, '_tc_' . $field, $value);
        }
    }
}
add_action('save_post', 'tc_save_travel_meta');
