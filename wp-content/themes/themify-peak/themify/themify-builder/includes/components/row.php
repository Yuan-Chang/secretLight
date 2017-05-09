<?php

class Themify_Builder_Component_Row extends Themify_Builder_Component_Base {
	public function __construct() {}

	public function get_name() {
		return 'row';
	}

	public function get_settings() {
		$options = apply_filters('themify_builder_row_fields_options', array(
			// Row Width
			array(
				'id' => 'row_width',
				'label' => __('Row Width', 'themify'),
				'type' => 'radio',
				'description' => '',
				'meta' => array(
					array('value' => '', 'name' => __('Default', 'themify'), 'selected' => true),
					array('value' => 'fullwidth', 'name' => __('Fullwidth row container', 'themify')),
					array('value' => 'fullwidth-content', 'name' => __('Fullwidth content', 'themify'))
				),
				'wrap_with_class' => '',
			),
			// Row Height
			array(
				'id' => 'row_height',
				'label' => __('Row Height', 'themify'),
				'type' => 'radio',
				'description' => '',
				'meta' => array(
					array('value' => '', 'name' => __('Default', 'themify'), 'selected' => true),
					array('value' => 'fullheight', 'name' => __('Fullheight (100% viewport height)', 'themify'))
				),
				'wrap_with_class' => '',
			),
			// Additional CSS
			array(
				'type' => 'separator',
				'meta' => array('html' => '<hr/>')
			),
			array(
				'id' => 'custom_css_row',
				'type' => 'text',
				'label' => __('Additional CSS Class', 'themify'),
				'class' => 'large exclude-from-reset-field',
				'description' => sprintf('<br/><small>%s</small>', __('Add additional CSS class(es) for custom styling', 'themify'))
			),
			array(
				'id' => 'row_anchor',
				'type' => 'text',
				'label' => __('Row Anchor', 'themify'),
				'class' => 'large exclude-from-reset-field',
				'description' => sprintf('<br/><small>%s</small>', __('Example: enter ‘about’ as row anchor and add ‘#about’ link in navigation menu. When link is clicked, it will scroll to this row.', 'themify'))
			),
		));
		return $options;
	}

	public function get_style_settings() {
		$options = apply_filters('themify_builder_row_fields_styling', array(
	
			// Font
			array(
				'id' => 'separator_font',
				'type' => 'separator',
				'meta' => array('html' => '<h4>' . __('Font', 'themify') . '</h4>'),
			),
			array(
				'id' => 'font_family',
				'type' => 'font_select',
				'label' => __('Font Family', 'themify'),
				'class' => 'font-family-select',
				'prop' => 'font-family',
				'selector' => array( '.module_row', '.module_row h1', '.module_row h2', '.module_row h3:not(.module-title)', '.module_row h4', '.module_row h5', '.module_row h6' )
			),
			array(
				'id' => 'font_color',
				'type' => 'color',
				'label' => __('Font Color', 'themify'),
				'class' => 'small',
				'prop' => 'color',
				'selector' => array( '.module_row', '.module_row h1', '.module_row h2', '.module_row h3:not(.module-title)', '.module_row h4', '.module_row h5', '.module_row h6' ),
			),
			array(
				'id' => 'multi_font_size',
				'type' => 'multi',
				'label' => __('Font Size', 'themify'),
				'fields' => array(
					array(
						'id' => 'font_size',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'font-size',
						'selector' => '.module_row'
					),
					array(
						'id' => 'font_size_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
												array('value' => 'em', 'name' => __('em', 'themify')),
												array('value' => '%', 'name' => __('%', 'themify')),
						)
					)
				)
			),
			array(
				'id' => 'multi_line_height',
				'type' => 'multi',
				'label' => __('Line Height', 'themify'),
				'fields' => array(
					array(
						'id' => 'line_height',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'line-height',
						'selector' => '.module_row'
					),
					array(
						'id' => 'line_height_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
												array('value' => 'em', 'name' => __('em', 'themify')),
												array('value' => '%', 'name' => __('%', 'themify')),
						)
					)
				)
			),
			array(
				'id' => 'text_align',
				'label' => __('Text Align', 'themify'),
				'type' => 'radio',
				'meta' => array(
					array('value' => '', 'name' => __('Default', 'themify'), 'selected' => true),
					array('value' => 'left', 'name' => __('Left', 'themify')),
					array('value' => 'center', 'name' => __('Center', 'themify')),
					array('value' => 'right', 'name' => __('Right', 'themify')),
					array('value' => 'justify', 'name' => __('Justify', 'themify'))
				),
				'prop' => 'text-align',
				'selector' => '.module_row'
			),
			// Link
			array(
				'type' => 'separator',
				'meta' => array('html' => '<hr />')
			),
			array(
				'id' => 'separator_link',
				'type' => 'separator',
				'meta' => array('html' => '<h4>' . __('Link', 'themify') . '</h4>'),
			),
			array(
				'id' => 'link_color',
				'type' => 'color',
				'label' => __('Color', 'themify'),
				'class' => 'small',
				'prop' => 'color',
				'selector' => '.module_row a'
			),
			array(
				'id' => 'text_decoration',
				'type' => 'select',
				'label' => __('Text Decoration', 'themify'),
				'meta' => array(
					array('value' => '', 'name' => '', 'selected' => true),
					array('value' => 'underline', 'name' => __('Underline', 'themify')),
					array('value' => 'overline', 'name' => __('Overline', 'themify')),
					array('value' => 'line-through', 'name' => __('Line through', 'themify')),
					array('value' => 'none', 'name' => __('None', 'themify'))
				),
				'prop' => 'text-decoration',
				'selector' => '.module_row a'
			),
			// Padding
			array(
				'type' => 'separator',
				'meta' => array('html' => '<hr />')
			),
			array(
				'id' => 'separator_padding',
				'type' => 'separator',
				'meta' => array('html' => '<h4>' . __('Padding', 'themify') . '</h4>'),
			),
			array(
				'id' => 'multi_padding_top',
				'type' => 'multi',
				'label' => __('Padding', 'themify'),
				'fields' => array(
					array(
						'id' => 'padding_top',
						'type' => 'text',
						'class' => 'style_padding style_field xsmall',
						'prop' => 'padding-top',
						'selector' => '.module_row',
					),
					array(
						'id' => 'padding_top_unit',
						'type' => 'select',
						'description' => __('top', 'themify'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
												array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify'))
						)
					),
				)
			),
			array(
				'id' => 'multi_padding_right',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'padding_right',
						'type' => 'text',
						'class' => 'style_padding style_field xsmall',
						'prop' => 'padding-right',
						'selector' => '.module_row',
					),
					array(
						'id' => 'padding_right_unit',
						'type' => 'select',
						'description' => __('right', 'themify'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
												array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify'))
						)
					),
				)
			),
			array(
				'id' => 'multi_padding_bottom',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'padding_bottom',
						'type' => 'text',
						'class' => 'style_padding style_field xsmall',
						'prop' => 'padding-bottom',
						'selector' => '.module_row',
					),
					array(
						'id' => 'padding_bottom_unit',
						'type' => 'select',
						'description' => __('bottom', 'themify'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
												array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify'))
						)
					),
				)
			),
			array(
				'id' => 'multi_padding_left',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'padding_left',
						'type' => 'text',
						'class' => 'style_padding style_field xsmall',
						'prop' => 'padding-left',
						'selector' => '.module_row',
					),
					array(
						'id' => 'padding_left_unit',
						'type' => 'select',
						'description' => __('left', 'themify'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
												array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify'))
						)
					),
				)
			),
			// "Apply all" // apply all padding
			array(
				'id' => 'checkbox_padding_apply_all',
				'class' => 'style_apply_all style_apply_all_padding',
				'type' => 'checkbox',
				'label' => false,
				'options' => array(
					array( 'name' => 'padding', 'value' => __( 'Apply to all padding', 'themify' ) )
				)
			),
			// Margin
			array(
				'type' => 'separator',
				'meta' => array('html' => '<hr />')
			),
			array(
				'id' => 'separator_margin',
				'type' => 'separator',
				'meta' => array('html' => '<h4>' . __('Margin', 'themify') . '</h4>'),
			),
			array(
				'id' => 'multi_margin_top',
				'type' => 'multi',
				'label' => __('Margin', 'themify'),
				'fields' => array(
					array(
						'id' => 'margin_top',
						'type' => 'text',
						'class' => 'style_margin style_field xsmall',
						'prop' => 'margin-top',
						'selector' => '.module_row',
					),
					array(
						'id' => 'margin_top_unit',
						'type' => 'select',
						'description' => __('top', 'themify'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
												array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify'))
						)
					),
				)
			),
			array(
				'id' => 'multi_margin_right',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'margin_right',
						'type' => 'text',
						'class' => 'style_margin style_field xsmall',
						'prop' => 'margin-right',
						'selector' => '.module_row',
					),
					array(
						'id' => 'margin_right_unit',
						'type' => 'select',
						'description' => __('right', 'themify'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
												array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify'))
						)
					),
				)
			),
			array(
				'id' => 'multi_margin_bottom',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'margin_bottom',
						'type' => 'text',
						'class' => 'style_margin style_field xsmall',
						'prop' => 'margin-bottom',
						'selector' => '.module_row',
					),
					array(
						'id' => 'margin_bottom_unit',
						'type' => 'select',
						'description' => __('bottom', 'themify'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
												array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify'))
						)
					),
				)
			),
			array(
				'id' => 'multi_margin_left',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'margin_left',
						'type' => 'text',
						'class' => 'style_margin style_field xsmall',
						'prop' => 'margin-left',
						'selector' => '.module_row',
					),
					array(
						'id' => 'margin_left_unit',
						'type' => 'select',
						'description' => __('left', 'themify'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
												array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify'))
						)
					),
				)
			),
			// "Apply all" // apply all margin
			array(
				'id' => 'checkbox_margin_apply_all',
				'class' => 'style_apply_all style_apply_all_margin',
				'type' => 'checkbox',
				'label' => false,
				'options' => array(
					array( 'name' => 'margin', 'value' => __( 'Apply to all margin', 'themify' ) )
				)
			),
			// Border
			array(
				'type' => 'separator',
				'meta' => array('html' => '<hr />')
			),
			array(
				'id' => 'separator_border',
				'type' => 'separator',
				'meta' => array('html' => '<h4>' . __('Border', 'themify') . '</h4>'),
			),
			array(
				'id' => 'multi_border_top',
				'type' => 'multi',
				'label' => __('Border', 'themify'),
				'fields' => array(
					array(
						'id' => 'border_top_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-top-color',
						'selector' => '.module_row',
					),
					array(
						'id' => 'border_top_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-top-width',
						'selector' => '.module_row',
					),
					array(
						'id' => 'border_top_style',
						'type' => 'select',
						'description' => __('top', 'themify'),
						'meta' => Themify_Builder_model::get_border_styles(),
						'prop' => 'border-top-style',
						'selector' => '.module_row',
					)
				)
			),
			array(
				'id' => 'multi_border_right',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_right_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-right-color',
						'selector' => '.module_row',
					),
					array(
						'id' => 'border_right_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-right-width',
						'selector' => '.module_row',
					),
					array(
						'id' => 'border_right_style',
						'type' => 'select',
						'description' => __('right', 'themify'),
						'meta' => Themify_Builder_model::get_border_styles(),
						'prop' => 'border-right-style',
						'selector' => '.module_row',
					)
				)
			),
			array(
				'id' => 'multi_border_bottom',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_bottom_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-bottom-color',
						'selector' => '.module_row',
					),
					array(
						'id' => 'border_bottom_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-bottom-width',
						'selector' => '.module_row',
					),
					array(
						'id' => 'border_bottom_style',
						'type' => 'select',
						'description' => __('bottom', 'themify'),
						'meta' => Themify_Builder_model::get_border_styles(),
						'prop' => 'border-bottom-style',
						'selector' => '.module_row',
					)
				)
			),
			array(
				'id' => 'multi_border_left',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_left_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-left-color',
						'selector' => '.module_row',
					),
					array(
						'id' => 'border_left_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-left-width',
						'selector' => '.module_row',
					),
					array(
						'id' => 'border_left_style',
						'type' => 'select',
						'description' => __('left', 'themify'),
						'meta' => Themify_Builder_model::get_border_styles(),
						'prop' => 'border-left-style',
						'selector' => '.module_row',
					)
				)
			),
			// "Apply all" // apply all border
			array(
				'id' => 'checkbox_border_apply_all',
				'class' => 'style_apply_all style_apply_all_border',
				'type' => 'checkbox',
				'label' => false,
				'default'=>'border',
				'options' => array(
					array( 'name' => 'border', 'value' => __( 'Apply to all border', 'themify' ) )
				)
			),
		));

		return $options;
	}

	public function get_form_settings() {
		$row_form_settings = array(
			'options' => array(
				'name' => esc_html__( 'Row Options', 'themify' ),
				'options' => $this->get_settings()
			),
			'styling' => array(
				'name' => esc_html__( 'Styling', 'themify' ),
				'options' => $this->get_style_settings()
			)
		);
		return apply_filters( 'themify_builder_row_lightbox_form_settings', $row_form_settings );
	}

	protected function _form_template() { 
		$row_form_settings = $this->get_form_settings();
	?>
	
		<form id="tfb_row_settings">
			<div id="themify_builder_lightbox_options_tab_items">
				<?php foreach( $row_form_settings as $setting_key => $setting ): ?>
				<li><a href="#themify_builder_row_fields_<?php echo esc_attr( $setting_key ); ?>">
					<?php echo esc_attr( $setting['name'] ); ?>
				</a></li>
				<?php endforeach; ?>
			</div>

			<div id="themify_builder_lightbox_actions_items">
				<button id="builder_submit_row_settings" class="builder_button"><?php _e('Save', 'themify') ?></button>
			</div>
			
			<?php foreach( $row_form_settings as $setting_key => $setting ): ?>
			<div id="themify_builder_row_fields_<?php echo esc_attr( $setting_key ); ?>" class="themify_builder_options_tab_wrapper<?php echo $setting_key==='styling'?' themify_builder_style_tab':''?>">
				<div class="themify_builder_options_tab_content">
					<?php 
					if ( isset( $setting['options'] ) && count( $setting['options'] ) > 0 ) 
						themify_render_row_fields( $setting['options'] );
					?>

					<?php if ( 'styling' == $setting_key ): ?>
					<p>
						<a href="#" class="reset-styling" data-reset="row">
							<i class="ti ti-close"></i>
							<?php _e('Reset Styling', 'themify') ?>
						</a>
					</p>
					<?php endif; ?>
				</div>
			</div>
			<?php endforeach; ?>

		</form>

	<?php
	}
}