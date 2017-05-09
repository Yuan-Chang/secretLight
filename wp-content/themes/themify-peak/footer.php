<?php
/**
 * Template for site footer
 * @package themify
 * @since 1.0.0
 */

/** Themify Default Variables
 *  @var object */
	global $themify; ?>

				<?php themify_layout_after(); // hook ?>
			</div>
			<!-- /body -->
                        <div class="footer-widgets-wrap">
                            <?php get_template_part( 'includes/footer-widgets' ); ?>
                            <div class="back-top clearfix">
                                    <div class="arrow-up">
                                            <a href="#header"></a>
                                    </div>
                            </div>
                        </div>
			<div id="footerwrap">

				<?php themify_footer_before(); // hook ?>

				<footer id="footer" class="pagewidth">

					<?php themify_footer_start(); // hook ?>
					
					<?php if (!themify_get('setting-exclude_footer_menu')) : ?>
						<div class="footer-nav-wrap">
							<?php wp_nav_menu( array(
								'theme_location' => 'footer-nav',
								'fallback_cb' => '',
								'container'  => '',
								'menu_id' => 'footer-nav',
								'menu_class' => 'footer-nav',
							)); ?>
						</div>
						<!-- /.footer-nav-wrap -->
					<?php endif; // exclude menu navigation ?>
					<div class="footer-text clearfix">
						<?php themify_the_footer_text(); ?>
						<?php themify_the_footer_text('right'); ?>
					</div>
					<!-- /footer-text -->
					<?php themify_footer_end(); // hook ?>

				</footer>
				<!-- /#footer -->

				<?php themify_footer_after(); // hook ?>

			</div>
			<!-- /#footerwrap -->

		</div>
		<!-- /#pagewrap -->

		<?php
		/**
		 *  Stylesheets and Javascript files are enqueued in theme-functions.php
		 */
		?>

		<!-- wp_footer -->
		<?php wp_footer(); ?>
		<?php themify_body_end(); // hook ?>
	</body>
</html>