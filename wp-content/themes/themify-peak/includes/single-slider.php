<?php
$slider = false;
$shortcode = themify_get('post_layout_slider');
if ($shortcode) {
	$slider = themify_get_images_from_gallery_shortcode($shortcode);
}
if (!$slider) {
	return;
}
$img_width = themify_get('image_width');
$img_height = themify_get('image_height');
$image_size = !$img_width?themify_get_gallery_param_option($shortcode, 'size'):'full';
?>

<div class="flexslider">
	<ul class="slides">
		<?php foreach ($slider as $image): ?>
			<?php
			$alt = get_post_meta($image->ID, '_wp_attachment_image_alt', true);
			$caption = $image->post_excerpt ? $image->post_excerpt : $image->post_content;
			if (!$alt) {
				$alt = get_post_meta($image->ID, '_wp_attachment_image_title', true);
			}
			if (!$caption) {
				$caption = $alt;
			}
			$img = wp_get_attachment_image_src($image->ID, $image_size);
			$img = $img[0];
			if($img_width>0){
				$img = themify_get_image(array('w'=>$img_width,'h'=>$img_height,'urlonly'=>TRUE,'ignore'=>TRUE,'src'=>$img,'crop'=>true));
			}
			?>
			<li>
				<img src="<?php echo esc_url( $img ) ?>" alt="<?php echo esc_attr( $alt ) ?>" />
				<?php if ($caption): ?>
					<p class="flex-caption"><?php echo esc_html( $caption ); ?></p>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
</div>