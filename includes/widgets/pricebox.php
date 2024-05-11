<?php
namespace HB_Price_Box\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Price Box Widget.
 *
 * Elementor widget that inserts a price box with limitless customization options
 *
 * @since 1.0.0
 */
class Elementor_Price_Box_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		wp_register_style( 'hb-pricebox', HBPB_PDU . 'includes/assets/css/widgets/pricebox.css' ,['elementor-frontend'], '1.0.0' );
		//wp_register_script( 'hb-pricebox', HBPB_PDU . 'includes/assets/js/widgets/pricebox.js', ['elementor-frontend'], '1.0.0', true );
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Price Box widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	public function get_style_depends() {
		return [ 'hb-pricebox' ];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Price Box widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	public function get_script_depends() {
		return [ 'hb-pricebox' ];
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve Price Box widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'hb_price_box';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Price Box widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Price Box', 'hb-price-box' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Price Box widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-price-table';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://hadesboard.com/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve categories the Price Box widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve keywords the Price Box widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['price, box, price box'];
	}

	/**
	 * Register Price Box widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'hb-price-box' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'active_pricebox',
			[
				'label' => esc_html__( 'Active', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'hb-price-box' ),
				'label_off' => esc_html__( 'Off', 'hb-price-box' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'top_border',
			[
				'label' => esc_html__( 'Border Top', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'hb-price-box' ),
				'label_off' => esc_html__( 'Off', 'hb-price-box' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'pricebox_icon',
			[
				'label' => esc_html__( 'Icon', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-server',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'pricebox_title',
			[
				'label' => esc_html__( 'Title', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Buy Host', 'hb-price-box' ),
				'placeholder' => esc_html__( 'Type your title here', 'hb-price-box' ),
			]
		);

		$this->add_control(
			'pricebox_subtitle',
			[
				'label' => esc_html__( 'Subtitle', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Types of shared web hosting', 'hb-price-box' ),
				'placeholder' => esc_html__( 'Type your title here', 'hb-price-box' ),
			]
		);

		$this->add_control(
			'show_image',
			[
				'label' => esc_html__( 'Show Image', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'hb-price-box' ),
				'label_off' => esc_html__( 'Hide', 'hb-price-box' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'pricebox_image',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .price-box .image',
				'condition' => [
					'show_image' => 'yes',
				],
			]
		);

		$this->add_control(
			'pricebox_description',
			[
				'label' => esc_html__( 'Description', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', 'hb-price-box' ),
				'placeholder' => esc_html__( 'Type your description here', 'hb-price-box' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_icon',
			[
				'label' => esc_html__( 'Icon', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$repeater->add_control(
			'list_text',
			[
				'label' => esc_html__( 'Title', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		/* End repeater */
		$this->add_control(
			'pricebox_list',
			[
				'label' => esc_html__( 'Price Box List', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'prevent_empty' => false,
				'default' => [
					[
						'list_icon' => [
							'value' => 'far fa-check-circle',
							'library' => 'fa-regular',
						],
						'list_text' => esc_html__( 'Best price available', 'hb-price-box' ),
					],
					[
						'list_icon' => [
							'value' => 'far fa-check-circle',
							'library' => 'fa-regular',
						],
						'list_text' => esc_html__( '24 hour support', 'hb-price-box' ),
					],
					[
						'list_icon' => [
							'value' => 'far fa-check-circle',
							'library' => 'fa-regular',
						],
						'list_text' => esc_html__( 'Dedicated servers', 'hb-price-box' ),
					],
					[
						'list_icon' => [
							'value' => 'far fa-check-circle',
							'library' => 'fa-regular',
						],
						'list_text' => esc_html__( 'High speed and optimized', 'hb-price-box' ),
					],
				],
				'title_field' => '{{{ list_text }}}',
			]
		);

		$this->add_control(
			'pricebox_price_text',
			[
				'label' => esc_html__( 'Price Text', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Price starts from', 'hb-price-box' ),
			]
		);

		$this->add_control(
			'pricebox_price_currency',
			[
				'label' => esc_html__( 'Currency', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '$', 'hb-price-box' ),
			]
		);

		$this->add_control(
			'pricebox_price',
			[
				'label' => esc_html__( 'Price', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '65', 'hb-price-box' ),
			]
		);

		$this->add_control(
			'pricebox_button_text',
			[
				'label' => esc_html__( 'Button', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Buy Host', 'hb-price-box' ),
				'placeholder' => esc_html__( 'Type your title here', 'hb-price-box' ),
			]
		);

		$this->add_control(
			'pricebox_button_link',
			[
				'label' => esc_html__( 'Button Link', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'General', 'hb-price-box' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pricebox_width',
			[
				'label' => esc_html__( 'Width', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .price-box' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pricebox_padding',
			[
				'label' => esc_html__( 'Padding', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 24,
					'right' => 24,
					'bottom' => 24,
					'left' => 24,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'pricebox_border',
				'selector' => '{{WRAPPER}} .price-box',
			]
		);

		$this->add_responsive_control(
			'pricebox_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 16,
					'right' => 16,
					'bottom' => 16,
					'left' => 16,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'pricebox_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .price-box',
			]
		);

		$this->add_control(
			'pricebox_top_border_color',
			[
				'label' => esc_html__( 'Top Border Color', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#2A99FF',
				'selectors' => [
					'{{WRAPPER}} .border-top::before' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'hb-price-box' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'pricebox_icon_width',
			[
				'label' => esc_html__( 'Width', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 52,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box .icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'pricebox_icon_color',
			[
				'label' => esc_html__( 'Color', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#2A99FF',
				'selectors' => [
					'{{WRAPPER}} .price-box .icon svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'pricebox_icon_margin',
			[
				'label' => esc_html__( 'Margin', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 24,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title',
			[
				'label' => esc_html__( 'Title', 'hb-price-box' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pricebox_title_color',
			[
				'label' => esc_html__( 'Color', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#2A99FF',
				'selectors' => [
					'{{WRAPPER}} .price-box .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'pricebox_title_typography',
				'selector' => '{{WRAPPER}} .price-box .title',
			]
		);

		$this->add_responsive_control(
			'pricebox_title_margin',
			[
				'label' => esc_html__( 'Margin', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 8,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'subtitle',
			[
				'label' => esc_html__( 'Subtitle', 'hb-price-box' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'pricebox_subtitle_color',
			[
				'label' => esc_html__( 'Color', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#2A99FF',
				'selectors' => [
					'{{WRAPPER}} .price-box .subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'pricebox_subtitle_typography',
				'selector' => '{{WRAPPER}} .price-box .subtitle',
			]
		);

		$this->add_responsive_control(
			'pricebox_subtitle_margin',
			[
				'label' => esc_html__( 'Margin', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 24,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'image',
			[
				'label' => esc_html__( 'Image', 'hb-price-box' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pricebox_image_width',
			[
				'label' => esc_html__( 'Width', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'default' => [
						'unit' => '%',
						'size' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .price-box .image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'pricebox_image_height',
			[
				'label' => esc_html__( 'Height', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box .image' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pricebox_image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 12,
					'right' => 12,
					'bottom' => 12,
					'left' => 12,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box .image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pricebox_image_margin',
			[
				'label' => esc_html__( 'Margin', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 24,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box .image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'description',
			[
				'label' => esc_html__( 'Description', 'hb-price-box' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pricebox_description_color',
			[
				'label' => esc_html__( 'Color', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#227ACC',
				'selectors' => [
					'{{WRAPPER}} .price-box .description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'pricebox_description_typography',
				'selector' => '{{WRAPPER}} .price-box .description',
			]
		);

		$this->add_responsive_control(
			'pricebox_description_padding',
			[
				'label' => esc_html__( 'Padding', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 12,
					'right' => 12,
					'bottom' => 12,
					'left' => 12,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pricebox_description_margin',
			[
				'label' => esc_html__( 'Margin', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 24,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'pricebox_description_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .price-box .description',
			]
		);

		$this->add_responsive_control(
			'pricebox_description_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 12,
					'right' => 12,
					'bottom' => 12,
					'left' => 12,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box .description' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'list',
			[
				'label' => esc_html__( 'List', 'hb-price-box' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'pricebox_list_icon_width',
			[
				'label' => esc_html__( 'Icon Width', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 18,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box .list .list-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pricebox_list_icon_distance',
			[
				'label' => esc_html__( 'Icon Distance', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 6,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box .list .list-icon ' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pricebox_list_items_distance',
			[
				'label' => esc_html__( 'Items Distance', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 16,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box .list .list-item ' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pricebox_list_margin',
			[
				'label' => esc_html__( 'Margin', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 24,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box .list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'pricebox_list_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#2A99FF',
				'selectors' => [
					'{{WRAPPER}} .price-box .list .list-icon' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pricebox_list_text_color',
			[
				'label' => esc_html__( 'Text Color', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#16161D',
				'selectors' => [
					'{{WRAPPER}} .price-box .list .list-item span' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'pricebox_list_typography',
				'selector' => '{{WRAPPER}} .list-item span',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'price',
			[
				'label' => esc_html__( 'Price', 'hb-price-box' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pricebox_price_text_color',
			[
				'label' => esc_html__( 'Price Text Color', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#16161D',
				'selectors' => [
					'{{WRAPPER}} .price-container .price-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'pricebox_price_text_typography',
				'selector' => '{{WRAPPER}} .price-container .price-text',
			]
		);

		$this->add_control(
			'pricebox_price_color',
			[
				'label' => esc_html__( 'Price Color', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#2A99FF',
				'selectors' => [
					'{{WRAPPER}} .price-container .price-number' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'pricebox_price_typography',
				'selector' => '{{WRAPPER}} .price-container .price-number',
			]
		);

		$this->add_control(
			'pricebox_price_currency_color',
			[
				'label' => esc_html__( 'Currency Color', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#2A99FF',
				'selectors' => [
					'{{WRAPPER}} .price-container .currency' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'pricebox_price_currency_typography',
				'selector' => '{{WRAPPER}} .price-container .currency',
			]
		);

		$this->add_responsive_control(
			'pricebox_price_margin',
			[
				'label' => esc_html__( 'Margin', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 24,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box .price-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button',
			[
				'label' => esc_html__( 'Button', 'hb-price-box' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'pricebox_button_margin',
			[
				'label' => esc_html__( 'Margin', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box .link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pricebox_button_padding',
			[
				'label' => esc_html__( 'Margin', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 12,
					'right' => 0,
					'bottom' => 12,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box .link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'pricebox_button_color',
			[
				'label' => esc_html__( 'Text Color', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#2A99FF',
				'selectors' => [
					'{{WRAPPER}} .price-box .link' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'pricebox_button_typography',
				'selector' => '{{WRAPPER}} .price-box .link',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .price-box .link',
			]
		);

		$this->add_responsive_control(
			'pricebox_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 12,
					'right' => 12,
					'bottom' => 12,
					'left' => 12,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box .link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'active',
			[
				'label' => esc_html__( 'Active', 'hb-price-box' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'pricebox_active_margin',
			[
				'label' => esc_html__( 'Margin', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 40,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .price-box.active .icon, {{WRAPPER}} .price-box.active .subtitle, {{WRAPPER}} .price-box.active .image, {{WRAPPER}} .price-box.active .description, {{WRAPPER}} .price-box.active .list, {{WRAPPER}} .price-box.active .price-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'pricebox_active_background_color',
			[
				'label' => esc_html__( 'Active Color', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .price-box.active' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pricebox_active_color',
			[
				'label' => esc_html__( 'Active Color', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FF8A00',
				'selectors' => [
					'{{WRAPPER}} .price-box.active' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .price-box.active .icon svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .price-box.active .icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .price-box.active .title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .price-box.active .subtitle' => 'color: {{VALUE}}',
					'{{WRAPPER}} .price-box.active .list-icon svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .price-box.active .list-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .price-box.active .price-number' => 'color: {{VALUE}}',
					'{{WRAPPER}} .price-box.active .currency' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pricebox_active_button_background_color',
			[
				'label' => esc_html__( 'Button Background', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FF8A00',
				'selectors' => [
					'{{WRAPPER}} .price-box.active .link' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pricebox_active_button_color',
			[
				'label' => esc_html__( 'Button Color', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .price-box.active .link' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pricebox_active_discription_color',
			[
				'label' => esc_html__( 'Description Color', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#16161D',
				'selectors' => [
					'{{WRAPPER}} .price-box.active .description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pricebox_active_discription_background_color',
			[
				'label' => esc_html__( 'Description Background', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFEBCC',
				'selectors' => [
					'{{WRAPPER}} .price-box.active .description' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();


	}

	/**
	 * Render Price Box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

			?>
			<div class="price-box <?php echo $settings['active_pricebox'] == 'yes' ? 'active' : '' ?> <?php echo $settings['top_border'] == 'yes' ? 'border-top' : '' ?>">

				<?php if($settings['pricebox_icon']): ?>
				<div class="icon"><?php \Elementor\Icons_Manager::render_icon( $settings['pricebox_icon'], [ 'aria-hidden' => 'true' ] ); ?></div>
				<?php endif; ?>

				<?php if($settings['pricebox_title']): ?>
				<div class="title"><?php echo $settings['pricebox_title']; ?></div>
				<?php endif; ?>

				<?php if($settings['pricebox_subtitle']): ?>
				<div class="subtitle"><?php echo $settings['pricebox_subtitle']; ?></div>
				<?php endif; ?>

				<?php if('yes' === $settings['show_image']): ?>
				<div class="image"></div>
				<?php endif; ?>

				<?php if($settings['pricebox_description']): ?>
				<div class="description"><?php echo $settings['pricebox_description']; ?></div>
				<?php endif; ?>

				<?php if($settings['pricebox_list']): ?>
				<div class="list">
					<ul>
						<?php foreach (  $settings['pricebox_list'] as $list ): ?>
							<li class="list-item">
								<div class="list-icon"><?php \Elementor\Icons_Manager::render_icon( $list['list_icon'], [ 'aria-hidden' => 'true' ] ); ?></div>
								<span><?php echo $list['list_text']; ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>

				<?php if($settings['pricebox_price']): ?>
				<div class="price-container">
					<div class="price-text">
						<?php echo $settings['pricebox_price_text']; ?>
					</div>
					<div class="price">
						<div class="price-number"><?php echo $settings['pricebox_price']; ?> </div>
						<div class="currency"><?php echo $settings['pricebox_price_currency']; ?></div>
					</div>
				</div>
				<?php endif; ?>

				<?php if($settings['pricebox_button_text']): ?>
				<a href="<?php echo $settings['pricebox_button_link']; ?>" class="link">
					<span><?php echo $settings['pricebox_button_text']; ?></span>
				</a>
				<?php endif; ?>

			</div>
			<?php
	}

	
}