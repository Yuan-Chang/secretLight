(function ($) {
    'use strict';
    $(document).ready(function () {
        $('.themify_tiled_settings li.selected-layout').each(function () {
            $(this).closest('ul').after('<div class="selected">' + $(this).html() + '</div>');
        });
        $('.themify_tiled_settings>li')
                .mouseenter(function () {
                    var $parent = $(this).closest('li').children('ul');
                    $parent.stop().slideDown();
                })
                .mouseleave(function () {
                    var $parent = $(this).closest('li').children('ul');
                    if (!$parent.is(':hover')) {
                        $parent.stop().slideUp();
                    }
                });
        $('.themify_tiled_show li').click(function (e) {
            var $ul = $(this).closest('ul'),
                    $input = $ul.closest('li').find('input[type="hidden"]');
            $input.val($(this).data('id'));
            $ul.find('.selected-layout').removeClass('selected-layout');
            $(this).addClass('selected-layout');
            $ul.next('div').html($(this).html());
        });
        $('#query-posts input[name="layout"],#query-portfolio input[name="portfolio_layout"]').change(function (e) {
            var $val = $(this).val(),
                    $post_type = $(this).parents('#query-posts').length > 0 ? '' : 'portfolio_',
                    $media = $post_type == '' ? $('#media_position').closest('.themify_field_row') : $(),
                    $masonary = $('#' + $post_type + 'disable_masonry').closest('.themify_field_row'),
                    $content_layout = $post_type == '' ? $('#post_content_layout') : $('#portfolio_content_layout'),
                    $content_layout = $content_layout.closest('.themify_field_row'),
                    $category = $('#' + $post_type + 'query_category').val();


            // SlideUp/animation doesn't work when element is hidden
            if (!$category) {
                $masonary.hide();
                $media.hide();
                $content_layout.hide();
                return;
            }
            if ($val === 'list-post' || $val === 'custom_tiles' || $val === 'auto_tiles') {
                $masonary.slideUp();
                if ($val === 'list-post') {
                    $media.slideDown()
                    $content_layout.slideDown()
                }
                else {
                    $media.slideUp();
                    $content_layout.slideUp();
                }
            }
            else {
                $masonary.slideDown()
                $media.slideDown()
                $content_layout.slideDown()
            }
        });
        $('#query_category,#portfolio_query_category').change(function () {
            var $post_type = $(this).closest('#query_category').length > 0 ? '' : 'portfolio_';
            $('input[name="' + $post_type + 'layout"],#' + $post_type + 'more_posts').trigger('change');
        });

        $('#portfolio_more_posts, #more_posts').change(function (e) {
            var $val = $(this).val(),
                    $post_type = $(this).parents('#query-posts').length > 0 ? '' : 'portfolio_',
                    $pagination = $('#' + $post_type + 'hide_navigation'),
                    $category = $('#' + $post_type + 'query_category').val();

            $pagination = $pagination.closest('.themify_field_row');
            if (!$category) {
                $pagination.hide();
                return;
            }
            if ($val === 'infinite' || !$('#' + $post_type + 'query_category').val()) {
                $pagination.slideUp();
            }
            else {
                $pagination.slideDown();
            }
        });

        $('input[name="post_layout"]').change(function () {
            var $sidebar = $(this).closest('.themify_write_panel').find('input[name="layout"]').closest('.themify_field'),
                    $sidebar_layouts = $sidebar.find('a');
            if ($(this).val() === 'split') {
                $sidebar_layouts.css('pointer-events', 'none').last().trigger('click');
                $sidebar.css({'opacity': 0.5, 'cursor': 'not-allowed'});
            }
            else {
                $sidebar_layouts.css('pointer-events', 'auto');
                $sidebar.css({'opacity': 1, 'cursor': 'auto'});
            }
        });
        $('input[name="post_layout"]').trigger('change');
        $('.themify_tiled_settings_wrapper>label input:checked').trigger('change');
    });

}(jQuery));