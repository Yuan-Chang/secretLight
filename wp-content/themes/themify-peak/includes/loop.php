<?php
/**
 * Template for generic post display.
 * @package themify
 * @since 1.0.0
 */
?>
<?php
global $more, $themify;
$more = 0;
$class = array('post', 'clearfix');
if (($themify->is_isotop || (strpos($themify->post_layout,'custom_tiles')!==false)) && in_array(get_post_type(), array('portfolio', 'post'))) {
    $post_type = get_post_type();
    $tax = $post_type == 'portfolio' ? 'portfolio-category' : 'category';
    $categories = wp_get_object_terms(get_the_id(), $tax);
    if (!is_wp_error($categories) && !empty($categories)) {

        $tax_id = array();
        foreach ($categories as $cat) {
            if (is_object($cat)) {
                $tax_id[] = $cat->term_id;
                if ($themify->is_isotop) {
                    $class[] = ' cat-' . $cat->term_id;
                }
            }
        }
        if ($themify->is_isotop) {
            $class[] = $post_type == 'portfolio' ? 'portfolio-post' : 'category-post';
            $class[] = 'filter-cat';
        }
        if (!$themify->query_category && (strpos($themify->post_layout,'custom_tiles')!==false) && !empty($tax_id)) {
            $category = max($tax_id);
            $tiled = themify_get('setting-' . $tax . '_tiled_' . $category);
            if (!$tiled) {
                $tiled = 'square-large';
            }
            $class[] = 'post-tiled tiled-' . $tiled;
        }
    }
}
?>
<?php themify_post_before(); // hook    ?>
<?php $media_position = strpos($themify->post_layout,'custom_tiles')!==false || strpos($themify->post_layout,'auto_tiles')!==false; ?>
<article itemscope itemtype="http://schema.org/Article" id="post-<?php the_id(); ?>" <?php post_class($class); ?>>

    <?php themify_post_start(); // hook   ?>

    <?php if ('below' != $themify->media_position || $media_position) get_template_part('includes/post-media', 'loop'); ?>

    <div class="post-content">
        <?php if($media_position &&  $themify->unlink_image != 'yes'):?>
			<?php echo themify_open_link( array( 'class' => 'tiled_overlay_link' ) ); ?></a>
        <?php endif;?>
        <?php if ('below' == $themify->media_position && !$media_position) get_template_part('includes/post-media', 'loop'); ?>

        <?php get_template_part('includes/post-meta', 'loop') ?>

    </div>
    <!-- /.post-content -->
    <?php themify_post_end(); // hook    ?>

</article>
<!-- /.post -->

<?php
themify_post_after(); // hook ?>