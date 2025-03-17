<?php

function tc_add_post_meta_boxes() {
    if (has_category('recipes')) {
        add_meta_box(
            'tc_recipe_meta',
            'Recipe Details',
            'tc_recipe_meta_callback',
            'post',
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'tc_add_post_meta_boxes');

function tc_recipe_meta_callback($post) {
    wp_nonce_field('tc_recipe_meta_nonce', 'tc_recipe_meta_nonce');
    
    // Get all meta values
    $fields = [
        'subtitle' => get_post_meta($post->ID, '_tc_post_subtitle', true),
        'cooking_time' => get_post_meta($post->ID, '_tc_cooking_time', true),
        'prep_time' => get_post_meta($post->ID, '_tc_prep_time', true),
        'difficulty' => get_post_meta($post->ID, '_tc_difficulty', true),
        'servings' => get_post_meta($post->ID, '_tc_servings', true),
        'cuisine' => get_post_meta($post->ID, '_tc_cuisine', true),
        'calories' => get_post_meta($post->ID, '_tc_calories', true),
        'ingredients' => get_post_meta($post->ID, '_tc_ingredients', true),
        'tips' => get_post_meta($post->ID, '_tc_tips', true)
    ];
    ?>
    <style>
        .tc-meta-box {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
        }
        .tc-meta-field {
            margin-bottom: 20px;
        }
        .tc-meta-field label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #1e1e1e;
        }
        .tc-meta-field input[type="text"],
        .tc-meta-field select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .tc-meta-field select {
            height: 38px;
        }
        .tc-meta-field input[type="text"]:focus,
        .tc-meta-field select:focus {
            border-color: #2271b1;
            box-shadow: 0 0 0 1px #2271b1;
            outline: none;
        }
        .tc-meta-description {
            color: #666;
            font-style: italic;
            font-size: 13px;
            margin-top: 4px;
        }
        .tc-meta-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .tc-meta-full {
            grid-column: 1 / -1;
        }
        .tc-meta-textarea {
            width: 100%;
            min-height: 150px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>

    <div class="tc-meta-box">
        <div class="tc-meta-grid">
            <div class="tc-meta-field tc-meta-full">
                <label for="tc_post_subtitle">Recipe Subtitle</label>
                <input type="text" id="tc_post_subtitle" name="tc_post_subtitle" 
                    value="<?php echo esc_attr($fields['subtitle']); ?>" 
                    placeholder="A brief description of your recipe">
            </div>

            <div class="tc-meta-field">
                <label for="tc_prep_time">Prep Time</label>
                <input type="text" id="tc_prep_time" name="tc_prep_time" 
                    value="<?php echo esc_attr($fields['prep_time']); ?>" 
                    placeholder="e.g., 15 minutes">
            </div>

            <div class="tc-meta-field">
                <label for="tc_cooking_time">Cooking Time</label>
                <input type="text" id="tc_cooking_time" name="tc_cooking_time" 
                    value="<?php echo esc_attr($fields['cooking_time']); ?>" 
                    placeholder="e.g., 30 minutes">
            </div>

            <div class="tc-meta-field">
                <label for="tc_servings">Servings</label>
                <input type="text" id="tc_servings" name="tc_servings" 
                    value="<?php echo esc_attr($fields['servings']); ?>" 
                    placeholder="e.g., 4-6 servings">
            </div>

            <div class="tc-meta-field">
                <label for="tc_calories">Calories (per serving)</label>
                <input type="text" id="tc_calories" name="tc_calories" 
                    value="<?php echo esc_attr($fields['calories']); ?>" 
                    placeholder="e.g., 450">
            </div>

            <div class="tc-meta-field">
                <label for="tc_cuisine">Cuisine Type</label>
                <input type="text" id="tc_cuisine" name="tc_cuisine" 
                    value="<?php echo esc_attr($fields['cuisine']); ?>" 
                    placeholder="e.g., Italian, Thai, Mexican">
            </div>

            <div class="tc-meta-field">
                <label for="tc_difficulty">Difficulty Level</label>
                <select id="tc_difficulty" name="tc_difficulty">
                    <option value="">Select Difficulty</option>
                    <option value="easy" <?php selected($fields['difficulty'], 'easy'); ?>>Easy</option>
                    <option value="medium" <?php selected($fields['difficulty'], 'medium'); ?>>Medium</option>
                    <option value="hard" <?php selected($fields['difficulty'], 'hard'); ?>>Hard</option>
                </select>
            </div>

            <div class="tc-meta-field tc-meta-full">
                <label for="tc_ingredients">Ingredients List</label>
                <textarea id="tc_ingredients" name="tc_ingredients" class="tc-meta-textarea" 
                    placeholder="Enter ingredients, one per line"><?php echo esc_textarea($fields['ingredients']); ?></textarea>
            </div>

            <div class="tc-meta-field tc-meta-full">
                <label for="tc_tips">Cooking Tips & Notes</label>
                <textarea id="tc_tips" name="tc_tips" class="tc-meta-textarea" 
                    placeholder="Add any helpful tips or notes about the recipe"><?php echo esc_textarea($fields['tips']); ?></textarea>
            </div>
        </div>
    </div>
    <?php
}

function tc_save_recipe_meta($post_id) {
    if (!isset($_POST['tc_recipe_meta_nonce']) || 
        !wp_verify_nonce($_POST['tc_recipe_meta_nonce'], 'tc_recipe_meta_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = [
        'tc_post_subtitle',
        'tc_cooking_time',
        'tc_prep_time',
        'tc_difficulty',
        'tc_servings',
        'tc_cuisine',
        'tc_calories',
        'tc_ingredients',
        'tc_tips'
    ];

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            if (in_array($field, ['tc_ingredients', 'tc_tips'])) {
                update_post_meta($post_id, '_' . $field, sanitize_textarea_field($_POST[$field]));
            } else {
                update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
            }
        }
    }
}
add_action('save_post', 'tc_save_recipe_meta');