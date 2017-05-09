<?php
/**
 * Template for displaying posts inside mega menus
 * @package themify
 * @since 1.0.0
 */

global $post;
$dimensions = apply_filters( 'themify_mega_menu_image_dimensions', array(
	'width'  => 180,
	'height' => 120
) );
?>

<article itemscope itemtype="http://schema.org/Article" class="post type-<?php echo get_post_type(); ?>">
	<figure class="post-image">
		<a href="<?php echo themify_get_featured_image_link(); ?>">
			<?php echo themify_get_image('ignore=true&w='. $dimensions['width'] .'&h=' . $dimensions['height']); ?>
		</a>
	</figure>
	<h1 class="post-title">
		<a href="<?php echo themify_get_featured_image_link(); ?>">
			<?php echo the_title_attribute( 'echo=0&post='.$post->ID ); ?>
		</a>
	</h1>
</article>
<!-- /.post -->