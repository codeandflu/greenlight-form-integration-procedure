/* -----------------------------
 * 2️⃣ Make CPT Read-Only & Admin Customization
 * ----------------------------- */
// Prevent editing/deleting/publishing
function caf_make_form_submission_readonly($allcaps, $cap, $args, $user) {
    if (isset($args[2])) {
        $post = get_post($args[2]);
        if ($post && $post->post_type === 'form_submission') {
            $allcaps['edit_post'] = false;
            $allcaps['delete_post'] = false;
            $allcaps['edit_others_posts'] = false;
            $allcaps['delete_others_posts'] = false;
            $allcaps['publish_posts'] = false;
        }
    }
    return $allcaps;
}
add_filter('user_has_cap', 'caf_make_form_submission_readonly', 10, 4);

// Remove "Add New" from sub-menu
function caf_remove_form_submission_add_new() {
    global $submenu;
    if(isset($submenu['edit.php?post_type=form_submission'])) {
        unset($submenu['edit.php?post_type=form_submission'][10]);
    }
}
add_action('admin_menu', 'caf_remove_form_submission_add_new', 999);





// Remove row actions for post
function caf_remove_form_submission_row_actions($actions, $post) {
    if ($post->post_type === 'form_submission') {
        unset($actions['edit']);
        unset($actions['inline hide-if-no-js']); //hides quik-edit
        unset($actions['view']);
        unset($actions['trash']);
    }
    return $actions;
}
add_filter('post_row_actions', 'caf_remove_form_submission_row_actions', 10, 2);

// Customize admin columns
function caf_form_submission_columns($columns) {
    $columns = array(
        'cb'      => $columns['cb'],
        'title'   => 'Name',
        'email'   => 'Email',
        'date'    => $columns['date'],
        'message' => 'Message',
    );
    return $columns;
}
add_filter('manage_form_submission_posts_columns', 'caf_form_submission_columns');

// Admin column content
function caf_form_submission_columns_content($column, $post_id) {
    switch ($column) {
        case 'email':
            echo esc_html(get_post_meta($post_id, 'email', true));
            break;
        case 'message':
            $message = get_post_field('post_content', $post_id);
            $truncated = wp_trim_words($message, 10, '...');
            echo '<span class="caf-message-preview" style="cursor:pointer;" data-full="' . esc_attr($message) . '">' . esc_html($truncated) . '</span>';
            break;
    }
}
add_action('manage_form_submission_posts_custom_column', 'caf_form_submission_columns_content', 10, 2);