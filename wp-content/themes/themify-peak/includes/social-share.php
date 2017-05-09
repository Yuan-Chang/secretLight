<?php
/**
 * Template for Like button.
 * @since 2.2.6
 */
global $themify;
?>
<?php if(is_singular() && '' != $themify->query_category && !themify_get('setting-hidelike_index') ||
        (is_singular() && '' == $themify->query_category && !themify_get('setting-hidelike_single')) ||
        (!is_singular() && !themify_get('setting-hidelike_index'))):?>

<div class="likeit-wrap">
    <a href="#" class="likeit" data-postid="<?php the_ID(); ?>">
            <span class="like-text"><?php _e('Like', 'themify'); ?></span>
            <ins class="like-count"><?php themify_get_like(); ?></ins>
    </a>
    <span class="newliker"><?php _e('Thanks!', 'themify'); ?></span>
    <span class="isliker"><?php _e("You've already liked this", 'themify'); ?></span>
</div>
    <!-- /.likeit-wrap -->
<?php endif;?>