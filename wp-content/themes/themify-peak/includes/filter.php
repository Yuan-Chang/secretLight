<?php
/**
 * Partial template that displays an entry filter.
 *
 * Created by themify
 * @since 1.0.0
 */
global $themify;
$taxo = false;
if ((!defined('DOING_AJAX') || !DOING_AJAX) && $themify->post_layout !== 'list-post') {
    if (isset($themify->is_shortcode) && $themify->is_shortcode) {
        $cats = $themify->shortcode_query_category;
        $taxo = $themify->shortcode_query_taxonomy;
    } elseif ($themify->is_isotop) {
        $cats = is_array($themify->query_category) ? join(',', $themify->query_category) : $themify->query_category;
        $taxo = $themify->query_taxonomy;
    }
}
?>
<?php if ($taxo): ?>
    <ul class="post-filter">
        <?php wp_list_categories("hierarchical=0&show_count=0&title_li=&include=$cats&taxonomy=$taxo"); ?>
    </ul>
    <!-- /post-filter -->
<?php endif; ?>
