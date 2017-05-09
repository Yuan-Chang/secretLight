<?php
global $themify;
$single = is_single();
$is_post = get_post_type() === 'post';
?>
<?php if ($themify->hide_meta != 'yes') : ?>
    <div class="post-meta entry-meta clearfix">
        <div class="post-meta-inner-left">
            <?php if ($themify->hide_meta_author != 'yes' && $is_post) : ?>
                <?php $avatar_size = $single ? $themify->single_avatar_size : $themify->avatar_size; ?>
                <span class="author-avatar"><?php echo get_avatar(get_the_author_meta('user_email'), $avatar_size, ''); ?></span>
                <span class="post-author"><?php echo themify_get_author_link(); ?></span>
            <?php endif; ?>
            <?php if ($themify->hide_date != 'yes') : ?>
                <span class="post-date-wrapper">
                    <time datetime="<?php the_time('o-m-d') ?>" class="post-date entry-date updated" itemprop="datePublished"><?php the_time(apply_filters('themify_loop_date', get_option('date_format'))) ?></time>
                </span>
            <?php endif; //post date  ?>
        </div>
        <div class="post-meta-inner-right">
            <?php if ($themify->hide_meta_tag != 'yes') : ?>
                <?php the_terms(get_the_id(), 'post_tag', ' <span class="post-tag">', ', ', '</span>'); ?>
            <?php endif; ?>
            <?php if (!themify_get('setting-comments_posts') && comments_open() && $themify->hide_meta_comment != 'yes') : ?>
                <span class="post-comment"><?php comments_popup_link(__('0', 'themify'), __('1', 'themify'), __('%', 'themify')); ?></span>
            <?php endif; ?>
            <?php get_template_part('includes/social-share', 'loop'); ?>
        </div>
    </div>
    <!-- /.post-meta -->
<?php endif; ?>

<div class="post-content-inner-wrapper">
    <div class="post-content-inner">
        <?php if ($themify->hide_meta != 'yes') : ?>

            <?php if ($themify->hide_meta_category != 'yes') : ?>
                <?php the_terms(get_the_id(), $is_post ? 'category' : 'portfolio-category', ' <span class="post-category">', ', ', '</span>'); ?>
            <?php endif; ?>

            <!-- /.post-meta-top -->
        <?php endif; //post meta ?>
        <?php if ($themify->hide_title != 'yes'): ?>

            <?php themify_post_title(); ?>

        <?php endif; //post title  ?>
        <div class="entry-content" itemprop="articleBody">
            <?php if (('excerpt' == $themify->display_content || $single) && !is_attachment()) : ?>
                <?php if ($single): ?>
                    <?php if (has_excerpt()): ?>
                        <div class="post-excerpt"><?php the_excerpt(); ?></div>
                    <?php endif; ?>
                <?php else: ?>
                    <?php the_excerpt(); ?>
                <?php endif; ?>

                <?php if (!$single && themify_check('setting-excerpt_more')) : ?>
                    <p><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="more-link"><?php echo themify_check('setting-default_more_text') ? themify_get('setting-default_more_text') : __('More &rarr;', 'themify') ?></a><p>
                    <?php endif; ?>

                <?php elseif ($themify->display_content != 'none'): ?>

                    <?php the_content(themify_check('setting-default_more_text') ? themify_get('setting-default_more_text') : __('More &rarr;', 'themify')); ?>

                <?php endif; //display content  ?>

                <?php edit_post_link(__('Edit', 'themify'), '<span class="edit-button">[', ']</span>'); ?>

        </div><!-- /.entry-content -->
    </div>
</div>