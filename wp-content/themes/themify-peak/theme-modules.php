<?php

/* * *************************************************************************
 * 						Theme Modules
 * 	----------------------------------------------------------------------
 * 						DO NOT EDIT THIS FILE
 * 	----------------------------------------------------------------------
 * 
 *  					Copyright (C) Themify
 * 						http://themify.me
 *
 *  To add custom modules to the theme, create a new 'custom-modules.php' file in the theme folder.
 *  They will be added to the theme automatically.
 * 
 * ************************************************************************* */

/**
 * Default Index Layout Module
 * @param array $data Theme settings data
 * @return string Markup for module.
 * @since 1.0.0
 */
function themify_default_layout($data = array()) {
    $data = themify_get_data();
    /**
     * Theme Settings Option Key Prefix
     * @var string
     */
    $prefix = 'setting-default_';

    if (themify_get($prefix . 'more_text') == '') {
        $more_text = __('More', 'themify');
    } else {
        $more_text = themify_get($prefix . 'more_text');
    }
    /**
     * Tertiary options <blank>|yes|no
     * @var array
     */
    $default_options = array(
        array('name' => '', 'value' => ''),
        array('name' => __('Yes', 'themify'), 'value' => 'yes'),
        array('name' => __('No', 'themify'), 'value' => 'no')
    );
    /**
     * Post content display options
     * @var array
     */
    $default_display_options = array(
        array('name' => __('Full Content', 'themify'), 'value' => 'content'),
        array('name' => __('Excerpt', 'themify'), 'value' => 'excerpt'),
        array('name' => __('None', 'themify'), 'value' => 'none')
    );
    /**
     * Post layout options
     * @var array
     */
    $default_post_layout_options = array(
        array('value' => 'list-post', 'img' => 'images/layout-icons/list-post.png', 'title' => __('List Post', 'themify')),
        array('value' => 'grid4', 'img' => 'images/layout-icons/grid4.png', 'title' => __('Grid 4', 'themify')),
        array('value' => 'grid3', 'img' => 'images/layout-icons/grid3.png', 'title' => __('Grid 3', 'themify')),
        array('value' => 'grid2', 'img' => 'images/layout-icons/grid2.png', 'title' => __('Grid 2', 'themify')),
        array('value' => 'auto_tiles', 'img' => 'images/layout-icons/auto-tiles.png', 'title' => __('Auto Tiles', 'themify'), 'selected' => true),
        array('value' => 'custom_tiles', 'img' => 'images/layout-icons/custom-tiles.png', 'title' => __('Custom Tiles', 'themify'))
    );
    /**
     * Sidebar placement options
     * @var array
     */
    $sidebar_location_options = array(
        array('value' => 'sidebar1', 'img' => 'images/layout-icons/sidebar1.png', 'selected' => true, 'title' => __('Sidebar Right', 'themify')),
        array('value' => 'sidebar1 sidebar-left', 'img' => 'images/layout-icons/sidebar1-left.png', 'title' => __('Sidebar Left', 'themify')),
        array('value' => 'sidebar-none', 'img' => 'images/layout-icons/sidebar-none.png', 'title' => __('No Sidebar', 'themify'))
    );
    /**
     * Image alignment options
     * @var array
     */
    $alignment_options = array(
        array('name' => '', 'value' => ''),
        array('name' => __('Left', 'themify'), 'value' => 'left'),
        array('name' => __('Right', 'themify'), 'value' => 'right')
    );
    /**
     * Entry media position, above or below the title
     */
    $media_position = array(
        array('name' => __('Above Post Title', 'themify'), 'value' => 'above'),
        array('name' => __('Below Post Title', 'themify'), 'value' => 'below'),
    );

    /**
     * Module markup
     * @var string
     */
    $output = '<div class="themify-info-link">' . __('Here you can set the <a href="https://themify.me/docs/default-layouts">Default Layouts</a> for WordPress archive post layout (category, search, archive, tag pages, etc.), single post layout (single post page), and the static Page layout. The default single post and page layout can be override individually on the post/page > edit > Themify Custom Panel.', 'themify') . '</div>';

    /**
     * Index Sidebar Option
     */
    $output .= '<p>
        <span class="label">' . __('Archive Sidebar Option', 'themify') . '</span>';
    $val = themify_get($prefix . 'layout');
    foreach ($sidebar_location_options as $option) {
        if (( '' == $val || !$val || !isset($val) ) && ( isset($option['selected']) && $option['selected'] )) {
            $val = $option['value'];
        }
        if ($val == $option['value']) {
            $class = 'selected';
        } else {
            $class = '';
        }
        $output .= '<a href="#" class="preview-icon ' . esc_attr($class) . '" title="' . esc_attr($option['title']) . '"><img src="' . esc_url(THEME_URI . '/' . $option['img']) . '" alt="' . esc_attr($option['value']) . '"  /></a>';
    }

    $output .= '	<input type="hidden" name="' . esc_attr($prefix) . 'layout" class="val" value="' . esc_attr($val) . '" />
				</p>';

    /**
     * Post Layout
     */
    $output .= '<p>
					<span class="label">' . __('Post Layout', 'themify') . '</span>';
    $val = themify_get($prefix . 'post_layout');
    foreach ($default_post_layout_options as $option) {
        if (( '' == $val || !$val || !isset($val) ) && ( isset($option['selected']) && $option['selected'] )) {
            $val = $option['value'];
        }
        if ($val == $option['value']) {
            $class = 'selected';
        } else {
            $class = '';
        }
        $output .= '<a href="#" class="preview-icon ' . esc_attr($class) . '" title="' . esc_attr($option['title']) . '"><img src="' . esc_url(THEME_URI . '/' . $option['img']) . '" alt="' . esc_attr($option['value']) . '"  /></a>';
    }

    $output .= '	<input type="hidden" name="' . esc_attr($prefix) . 'post_layout" class="val" value="' . esc_attr($val) . '" />
				</p>';

    /**
     * Post Content Layout
     */
    $output .= '<p>
					<span class="label">' . __('Post Content Layout', 'themify') . '</span>
					<select name="setting-post_content_layout">' .
            themify_options_module(array(
                array('name' => __('Default', 'themify'), 'value' => ''),
                array('name' => __('Overlay', 'themify'), 'value' => 'overlay'),
                array('name' => __('Polaroid', 'themify'), 'value' => 'polaroid')
                    ), 'setting-post_content_layout') . '
					</select>
				</p>';

    /**
     * Enable Masonry
     */
    $output .= '<p data-show-if-element="[name=setting-default_post_layout]" data-show-if-value=' . '["grid2","grid3","grid4"]' . '>
					<span class="label">' . __('Post Masonry', 'themify') . '</span>
					<select name="setting-disable_masonry">' .
            themify_options_module($default_options, 'setting-disable_masonry') . '
					</select>
				</p>';

    /**
     * Post Gutter
     */
    $output .= '<p>
					<span class="label">' . __('Post Gutter', 'themify') . '</span>
					<select name="setting-post_gutter">' .
            themify_options_module(array(
                array('name' => __('Default', 'themify'), 'value' => 'gutter'),
                array('name' => __('No gutter', 'themify'), 'value' => 'no-gutter')
                    ), 'setting-post_gutter') . '
					</select>
				</p>';


    /**
     * Display Content
     */
    $output .= '<p>
					<span class="label">' . __('Display Content', 'themify') . '</span> 
					<select name="' . $prefix . 'layout_display">' .
            themify_options_module($default_display_options, $prefix . 'layout_display') . '
					</select>
				</p>';

    /**
     * More Text
     */
    $output .= '<p>
					<span class="label">' . __('More Text', 'themify') . '</span>
					<input type="text" name="' . $prefix . 'more_text" value="' . $more_text . '">
				</p>';

    /**
     * Display more link in excerpt mode
     */
    $output .= '<span class="pushlabel vertical-grouped"><label for="setting-excerpt_more"><input type="checkbox" value="1" id="setting-excerpt_more" name="setting-excerpt_more" ' . checked(themify_get('setting-excerpt_more'), 1, false) . '/> ' . __('Display more link button in excerpt mode as well.', 'themify') . '</label></span>';

    /**
     * Order & OrderBy Options
     */
    $output .= themify_post_sorting_options('setting-index_order', $data);

    /**
     * Hide Post Title
     */
    $output .= '<p>
					<span class="label">' . __('Hide Post Title', 'themify') . '</span>
					<select name="' . $prefix . 'post_title">' .
            themify_options_module($default_options, $prefix . 'post_title') . '
					</select>
				</p>';

    /**
     * Unlink Post Title
     */
    $output .= '<p>
					<span class="label">' . __('Unlink Post Title', 'themify') . '</span>
					<select name="' . $prefix . 'unlink_post_title">' .
            themify_options_module($default_options, $prefix . 'unlink_post_title') . '
					</select>
				</p>';

    /**
     * Hide Post Meta
     */
    $output .= themify_post_meta_options($prefix . 'post_meta', $data);

    /**
     * Hide Post Date
     */
    $output .= '<p>
					<span class="label">' . __('Hide Post Date', 'themify') . '</span>
					<select name="' . $prefix . 'post_date">' .
            themify_options_module($default_options, $prefix . 'post_date') . '
					</select>
				</p>';

    /**
     * Auto Featured Image
     */
    $output .= '<p>
					<span class="label">' . __('Auto Featured Image', 'themify') . '</span>
					<label for="setting-auto_featured_image"><input type="checkbox" value="1" id="setting-auto_featured_image" name="setting-auto_featured_image" ' . checked(themify_get('setting-auto_featured_image'), 1, false) . '/> ' . __('If no featured image is specified, display first image in content.', 'themify') . '</label>
				</p>';

    /**
     * Media Position
     */
    $output .= '<p data-show-if-element="[name=setting-default_post_layout]" data-show-if-value=' . '["list-post","grid2","grid3","grid4"]' . '>
					<span class="label">' . __('Featured Image Position', 'themify') . '</span>
					<select name="' . $prefix . 'media_position">' .
            themify_options_module($media_position, $prefix . 'media_position') . '
					</select>
				</p>';

    /**
     * Hide Featured Image
     */
    $output .= '<p>
					<span class="label">' . __('Hide Featured Image', 'themify') . '</span>
					<select name="' . $prefix . 'post_image">' .
            themify_options_module($default_options, $prefix . 'post_image') . '
					</select>
				</p>';

    /**
     * Unlink Featured Image
     */
    $output .= '<p>
					<span class="label">' . __('Unlink Featured Image', 'themify') . '</span>
					<select name="' . $prefix . 'unlink_post_image">' .
            themify_options_module($default_options, $prefix . 'unlink_post_image') . '
					</select>
				</p>';

    /**
     * Featured Image Sizes
     */
    $output .= themify_feature_image_sizes_select('image_post_feature_size');

    /**
     * Image Dimensions
     */
    $output .= '<p class="show_if_enabled_img_php">
					<span class="label">' . __('Image Size', 'themify') . '</span>  
					<input type="text" class="width2" name="setting-image_post_width" value="' . themify_get('setting-image_post_width') . '" /> ' . __('width', 'themify') . ' <small>(px)</small>
					<input type="text" class="width2" name="setting-image_post_height" value="' . themify_get('setting-image_post_height') . '" /> ' . __('height', 'themify') . ' <small>(px)</small>
					<br /><span class="pushlabel"><small>' . __('Enter height = 0 to disable vertical cropping with img.php enabled', 'themify') . '</small></span>
				</p>';

    return $output;
}

/**
 * Markup for related posts module
 * @param array $data
 * @return string
 */
function themify_related_posts($data = array()) {

    /**
     * Variable key in theme settings
     * @var string
     */
    $key = 'setting-relationship_taxonomy';

    $options = array(
        array('value' => 'category', 'name' => __('Category', 'themify')),
        array('value' => 'tag', 'name' => __('Tags', 'themify')),
        array('value' => 'none', 'name' => __('None', 'themify')),
    );

    /**
     * Post content display options
     * @var array
     */
    $display_content_options = array(
        array('name' => __('Full Content', 'themify'), 'value' => 'content'),
        array('name' => __('Excerpt', 'themify'), 'value' => 'excerpt'),
        array('name' => __('None', 'themify'), 'value' => 'none', 'selected' => true)
    );

    $number = themify_check($key . '_entries') ? themify_get($key . '_entries') : 3;

    /**
     * Module markup
     * @var string
     */
    $html = '';

    /**
     * Taxonomy to use
     */
    $html .= '<p>
				<span class="label">' . __('Relate Entries By', 'themify') . '</span>
				<select name="' . esc_attr($key) . '">' . themify_options_module($options, $key . '') . '
				</select>
			</p>';

    /**
     * Number of Entries
     */
    $html .= '<p>
				<span class="label">' . __('Number of Entries', 'themify') . '</span>
				<input type="text" name="' . esc_attr($key) . '_entries" value="' . esc_attr($number) . '">
			</p>';

    /**
     * Hide Image
     */
    $html .= sprintf('<p><span class="pushlabel"><label for="%1$s"><input type="checkbox" id="%1$s" name="%1$s" %2$s /> %3$s</label></span></p>', esc_attr($key . '_hide_image'), checked(themify_get($key . '_hide_image'), 'on', false), __('Hide Image.', 'themify')
    );

    /**
     * Display Content
     */
    $html .= '<p>
					<span class="label">' . __('Display Content', 'themify') . '</span> 
					<select name="' . esc_attr($key . '_display_content') . '">' .
            themify_options_module($display_content_options, $key . '_display_content', true, 'none') . '
					</select>
				</p>';

    return $html;
}

if (!function_exists('themify_tile_settings')) {

    /**
     * Markup for tile settings module
     * @param array $data
     * @return string
     */
    function themify_tile_settings($data = array()) {
        /**
         * Variable key in theme settings
         * @var string
         */
        $post_type = $data['attr']['category'];
        $key = 'setting-' . $post_type . '_tiled';
        $html = __('Set the tile size for each category (these tile configuration will be used when "custom_tiles" is in use).', 'themify');
        $html.= '<div class="themify_tiled_settings_wrapper">';
        $layout = array(
            array('value' => 'square-large', 'img' => 'images/layout-icons/size-sl.png', 'title' => __('Square Large', 'themify'), 'selected' => true),
            array('value' => 'square-small', 'img' => 'images/layout-icons/size-ss.png', 'title' => __('Square Small', 'themify')),
            array('value' => 'landscape', 'img' => 'images/layout-icons/size-l.png', 'title' => __('Landscape', 'themify')),
            array('value' => 'portrait', 'img' => 'images/layout-icons/size-p.png', 'title' => __('Portrait', 'themify')),
        );

        $terms = get_terms($post_type, array('hide_empty' => false, 'fields' => 'id=>name', 'hierarchical' => false));
        if (!empty($terms) && !is_wp_error($terms)) {
            $html.= '<ul class="themify_tiled_settings">';
            foreach ($terms as $id => $t) {
                $html.='<li><ul class="themify_tiled_show">';
                $id = $key . '_' . $id;
                $val = themify_get($id);
                $selected = '';
                foreach ($layout as $option) {
                    if (( '' == $val || !$val || !isset($val) ) && ( isset($option['selected']) && $option['selected'] )) {
                        $val = $option['value'];
                    }	
                    if ($val == $option['value']) {
                        $class = ' class="selected-layout" ';
                        $selected = $val;
                    } else {
                        $class = '';
                    }
                    $html.='<li data-id="' . $option['value'] . '" ' . $class . '><img title="' . $option['title'] . '" src="' . THEME_URI . '/' . $option['img'] . '" /></li>';
                }
                $html.='</ul><span>' . $t . '</span><input type="hidden" name="' . $id . '" value="'.$selected.'" /></li>';
            }
            $html.='</ul>';
        }
        $html.='</div>';
        return $html;
    }

}


if (!function_exists('themify_pagination_infinite')) {

    /**
     * Choose pagination or infinite scroll
     * @param array $data
     * @return string
     */
    function themify_pagination_infinite($data = array()) {

        $output = '<p><span class="label">' . __('Pagination Option', 'themify') . '</span>';
        //Infinite Scroll
        $output .= '<input ' . checked(themify_check('setting-more_posts') ? themify_get('setting-more_posts') : 'infinite', 'infinite', false) . ' type="radio" name="setting-more_posts" value="infinite" /> ';
        $output .= __('Infinite Scroll (posts are loaded on the same page)', 'themify');
        $output .= '<br/>';
        $output .= '<label for="setting-autoinfinite"><input class="disable-autoinfinite" type="checkbox" id="setting-autoinfinite" name="setting-autoinfinite" ' . checked( themify_get( 'setting-autoinfinite' ), 'on', false ) . '/> ' . __('Disable automatic infinite scroll', 'themify') . '</label>';
        $output .= '<br/><br/>';

        //Numbered pagination
        $output .= '<span class="pushlabel"><input ' . checked(themify_get('setting-more_posts'), 'pagination', false) . ' type="radio" name="setting-more_posts" value="pagination" /> ';
        $output .= __('Standard Pagination', 'themify') . '</span>';
        $output .= '</p>';

        return $output;
    }

}

/**
 * Option to disable drop cap.
 *
 * @param array $data
 *
 * @return string
 */
function themify_drop_cap_module($data = array()) {
    $key = 'setting-disable_drop_cap';
    $html = sprintf(
            '<p><label for="%1$s"><input type="checkbox" id="%1$s" name="%1$s" %2$s /> %3$s</label></p>', $key, checked(themify_get($key), 'on', false), __('Disable Drop Cap styling that appears in the first paragraph of post content/excerpt', 'themify')
    );
    return $html;
}


if ( ! function_exists( 'themify_exclude_rss' ) ) {
	/**
	 * Exclude RSS
	 * @return string
	 */
	function themify_exclude_rss() {
		return '<p><label for="setting-exclude_rss"><input type="checkbox" id="setting-exclude_rss" name="setting-exclude_rss" ' . checked( themify_get( 'setting-exclude_rss' ), 'on', false ) . '/> ' . __( 'Check here to exclude RSS icon/button in the header', 'themify' ) . '</label></p>';	
	}
}

if ( ! function_exists( 'themify_exclude_search_form' ) ) {
	/**
	 * Exclude Search Form
	 * @return string
	 */
	function themify_exclude_search_form() {
		return '<p><label for="setting-exclude_search_form"><input type="checkbox" id="setting-exclude_search_form" name="setting-exclude_search_form" ' . checked( themify_get( 'setting-exclude_search_form' ), 'on', false ) . '/> ' . __( 'Check here to exclude search form in the header', 'themify' ) . '</label></p>';	
	}
}

if ( ! function_exists( 'themify_footer_menu' ) ) {
	/**
	 * Exclude footer menu
	 * @return string
	 */
	function themify_footer_menu() {
		return '<p><label for="setting-exclude_footer_menu"><input type="checkbox" id="setting-exclude_footer_menu" name="setting-exclude_footer_menu" ' . checked( themify_get( 'setting-exclude_footer_menu' ), 'on', false ) . '/>' . __( 'Check here to exclude footer menu in the footer', 'themify' ) . '</label></p>';	
	}
}