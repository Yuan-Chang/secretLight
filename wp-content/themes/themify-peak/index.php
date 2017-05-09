<?php
/**
 * Template for common archive pages, author and search results
 * @package themify
 * @since 1.0.0
 */
?>
<?php get_header(); ?>

<?php 
/** Themify Default Variables
 *  @var object */
global $themify;
?>

		<?php
			// author bio
			if( is_author() ) :
				themify_author_bio();
			endif;
		?>

        <?php 
        /////////////////////////////////////////////
        // Search Title	 							
        /////////////////////////////////////////////
        ?>
        <?php if( is_search() ): ?>

                <div class="page-category-title-wrap"><div class="category-title-overlay"></div><h1 class="page-title"><?php _e('Search Results for:','themify'); ?> <em><?php echo get_search_query(); ?></em></h1></div>

        <?php endif; ?>

        <?php
        /////////////////////////////////////////////
        // Date Archive Title
        /////////////////////////////////////////////
        ?>
        <?php if ( is_day() ) : ?>
                <div class="page-category-title-wrap"><div class="category-title-overlay"></div><h1 class="page-title"><?php printf( __( 'Daily Archives: <span>%s</span>', 'themify' ), get_the_date() ); ?></h1></div>
        <?php elseif ( is_month() ) : ?>
                <div class="page-category-title-wrap"><div class="category-title-overlay"></div><h1 class="page-title"><?php printf( __( 'Monthly Archives: <span>%s</span>', 'themify' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'themify' ) ) ); ?></h1></div>
        <?php elseif ( is_year() ) : ?>
                <div class="page-category-title-wrap"><div class="category-title-overlay"></div><h1 class="page-title"><?php printf( __( 'Yearly Archives: <span>%s</span>', 'themify' ), get_the_date( _x( 'Y', 'yearly archives date format', 'themify' ) ) ); ?></h1></div>
        <?php endif; ?>

        <?php 
        /////////////////////////////////////////////
        // Category Title	 							
        /////////////////////////////////////////////
        ?>
        <?php if( is_category() || is_tag() || is_tax() ): ?>
                <div class="page-category-title-wrap"><div class="category-title-overlay"></div>
                        <h1 class="page-title"><?php single_cat_title(); ?></h1>
                         <p class="page-category-description"><?php echo strip_tags(themify_get_term_description()); ?></p>
                </div>

        <?php endif; ?>

        <?php 
        /////////////////////////////////////////////
        // Loop	 							
        /////////////////////////////////////////////
        ?>
     <!-- layout -->
    <div id="layout" class="pagewidth clearfix">
    <!-- content -->
        <?php themify_content_before(); //hook ?>
            <div id="content" class="list-post">
                    <?php themify_content_start(); //hook ?>
           
                        
      
                    <?php if (have_posts()) : ?>
                        <!-- loops-wrapper -->
                        <div id="loops-wrapper" class="loops-wrapper clearfix <?php echo esc_attr( themify_theme_query_classes() );?>">

                                <?php while (have_posts()) : the_post(); ?>

                                        <?php if(is_search()): ?>
                                                <?php get_template_part( 'includes/loop' , 'search'); ?>
                                        <?php else: ?>
                                                <?php get_template_part( 'includes/loop' , 'index'); ?>
                                        <?php endif; ?>

                                <?php endwhile; ?>

                        </div>
                        <!-- /loops-wrapper -->

                        <?php get_template_part( 'includes/pagination'); ?>

                <?php 
                /////////////////////////////////////////////
                // Error - No Page Found	 							
                /////////////////////////////////////////////
                ?>

                <?php else : ?>
                        <p><?php _e( 'Sorry, nothing found.', 'themify' ); ?></p>
                <?php endif; ?>			
        <?php themify_content_end(); //hook ?>
        </div>
        <?php themify_content_after(); //hook ?>
<!-- /#content -->

<?php 
/////////////////////////////////////////////
// Sidebar							
/////////////////////////////////////////////
if ($themify->layout !== 'sidebar-none'): get_sidebar(); endif; ?>

</div>
<!-- /#layout -->

<?php get_footer(); ?>