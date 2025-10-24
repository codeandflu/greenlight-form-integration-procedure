	
/* -----------------------------
 * 4️⃣ Frontend Shortcode: Display Submissions
 * ----------------------------- */
function caf_display_form_submissions() {
    $args = array(
        'post_type'      => 'form_submission',
        'post_status'    => 'publish',
        'posts_per_page' => 50,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    $submissions = new WP_Query($args);

    if ($submissions->have_posts()) {
        ob_start();
        echo '<table class="caf-submissions-table" border="1" cellpadding="8" cellspacing="0" style="border-collapse:collapse; width:100%">';
        echo '<thead><tr><th>Name</th><th>Email</th><th>Message</th><th>Date</th></tr></thead><tbody>';

        while ($submissions->have_posts()) {
            $submissions->the_post();
            $name    = get_post_meta(get_the_ID(), 'name', true);
            $email   = get_post_meta(get_the_ID(), 'email', true);
            $message = get_the_content();
            $date    = get_the_date();
            $truncated = wp_trim_words($message, 15, '...');

            echo '<tr>';
            echo '<td>' . esc_html($name) . '</td>';
            echo '<td>' . esc_html($email) . '</td>';
            echo '<td><span class="caf-message-preview" style="cursor:pointer;" data-full="' . esc_attr($message) . '">' . esc_html($truncated) . '</span></td>';
            echo '<td>' . esc_html($date) . '</td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
        wp_reset_postdata();


        return ob_get_clean();
    } else {
        return '<p>No form submissions yet.</p>';
    }
}
add_shortcode('form_submissions', 'caf_display_form_submissions'); //switch form_submissions to whatever shortcode you require
