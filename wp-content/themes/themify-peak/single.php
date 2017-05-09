<?php
/**
 * Template for single post view
 * @package themify
 * @since 1.0.0
 */
?>
<?php
get_header();

global $themify;
?>

<?php if (have_posts()) while (have_posts()) : the_post(); ?>

	<?php themify_content_before(); // hook  ?>

	<div class="featured-area fullcover">
		<?php if ($themify->post_layout_type && $themify->post_layout_type !== 'split' && $themify->post_layout_type !== 'fullwidth'): ?>
		   <?php if($themify->hide_image != 'yes'):?>
				<?php get_template_part('includes/single-' . $themify->post_layout_type, 'single'); ?>
			<?php endif;?> 
		<?php else: ?>
			<?php get_template_part('includes/post-media', 'single'); ?>
		<?php endif; ?> 
		<div class="post-content">
			<?php get_template_part('includes/post-meta', 'single'); ?>
		</div>
	</div>

	<!-- layout-container -->
	<div id="layout" class="pagewidth clearfix">
		<!-- content -->
		<div id="content">

			<?php themify_post_before(); // hook ?>
			<?php $post_id = get_the_id(); ?>
			<article itemscope itemtype="http://schema.org/Article" id="post-<?php echo $post_id; ?>" <?php post_class('post clearfix'); ?>>
				<?php themify_post_start(); // hook  ?>
				<div class="post-content">
					<div class="entry-content" itemprop="articleBody">
						<?php if (get_post_type() === 'portfolio' &&  $themify->hide_meta!='yes'): ?>
							<?php
							$client = get_post_meta($post_id, 'project_client', true);
							$services = get_post_meta($post_id, 'project_services', true);
							$date = get_post_meta($post_id, 'project_date', true);
							$launch = get_post_meta($post_id, 'project_launch', true);
							if ($client || $services || $date || $launch) :
								?>
								<div class="project-meta">
									<?php if ($client) : ?>
										<div class="project-client">
											<strong><?php _e('Client', 'themify'); ?></strong>
											<?php echo wp_kses_post($client); ?>
										</div>
									<?php endif; ?>

									<?php if ($services) : ?>
										<div class="project-services">
											<strong><?php _e('Services', 'themify'); ?></strong>
											<?php echo wp_kses_post($services); ?>
										</div>
									<?php endif; ?>

									<?php if ($date && $themify->hide_date!='yes'): ?>
										<div class="project-date">
											<strong><?php _e('Date', 'themify'); ?></strong>
											<?php echo wp_kses_post($date); ?>
										</div>
									<?php endif; ?>

									<?php if ($launch) : ?>
										<div class="project-view">
											<strong><?php _e('View', 'themify'); ?></strong>
											<a target="_blank" href="<?php echo esc_url($launch); ?>"><?php _e('Launch Project', 'themify'); ?></a>
										</div>
									<?php endif; ?>
								</div>
							<?php endif; // $client || $services || $date || $launch ?>
						<?php endif; ?>
						<?php the_content(); ?>
					</div>
				</div>
				<?php themify_post_end(); // hook  ?>
			</article>

			<?php themify_post_after(); // hook ?>

			<?php wp_link_pages( array( 'before' => '<p class="post-pagination"><strong>' . __( 'Pages:', 'themify' ) . ' </strong>', 'after' => '</p>', 'next_or_number' => 'number' ) ); ?>

			<?php get_template_part('includes/author-box', 'single'); ?>

			<?php get_template_part('includes/post-nav', 'single'); ?>

			<?php if ('none' != themify_get('setting-relationship_taxonomy')) : ?>
				<?php get_template_part('includes/related-posts', 'single'); ?>
			<?php endif; ?>

			<?php if (!themify_check('setting-comments_posts')) : ?>
				<?php comments_template(); ?>
			<?php endif; ?>

			<?php themify_content_end(); // hook  ?>
		</div><!-- /content -->

		<?php themify_content_after(); // hook  ?>

		<?php
		/////////////////////////////////////////////
		// Sidebar
		/////////////////////////////////////////////
		if ($themify->layout != 'sidebar-none') : get_sidebar();
		endif;
		?>
	</div><!-- /layout-container -->

<?php endwhile; ?>

<?php get_footer(); ?>