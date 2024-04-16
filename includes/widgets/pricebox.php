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
		return 'https://ariazdevs.com/';
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
			'pricebox_icon',
			[
				'label' => esc_html__( 'Icon', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
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
				'default' => esc_html__( 'Types of shared web hosting services', 'hb-price-box' ),
				'placeholder' => esc_html__( 'Type your title here', 'hb-price-box' ),
			]
		);

		$this->add_control(
			'pricebox_image',
			[
				'label' => esc_html__( 'Choose Image', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
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
							'value' => 'fas fa-check',
							'library' => 'fa-solid',
						],
						'list_text' => esc_html__( 'Best price available', 'hb-price-box' ),
					],
					[
						'list_icon' => [
							'value' => 'fas fa-check',
							'library' => 'fa-solid',
						],
						'list_text' => esc_html__( '24 hour support', 'hb-price-box' ),
					],
					[
						'list_icon' => [
							'value' => 'fas fa-check',
							'library' => 'fa-solid',
						],
						'list_text' => esc_html__( 'Dedicated servers', 'hb-price-box' ),
					],
					[
						'list_icon' => [
							'value' => 'fas fa-check',
							'library' => 'fa-solid',
						],
						'list_text' => esc_html__( 'High speed and optimized', 'hb-price-box' ),
					],
				],
				'title_field' => '{{{ list_text }}}',
			]
		);

		$this->add_control(
			'pricebox_price',
			[
				'label' => esc_html__( 'Price', 'hb-price-box' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'step' => 1,
				'default' => 200,
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
			'icon',
			[
				'label' => esc_html__( 'Icon', 'hb-price-box' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
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
				'selectors' => [
					'{{WRAPPER}} .price-box .icon svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pricebox_icon_padding',
			[
				'label' => esc_html__( 'Padding', 'hb-price-box' ),
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
					'{{WRAPPER}} .price-box .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->end_controls_section();

		$this->start_controls_section(
			'subtitle',
			[
				'label' => esc_html__( 'Subtitle', 'hb-price-box' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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

		$this->end_controls_section();

		$this->start_controls_section(
			'image',
			[
				'label' => esc_html__( 'Image', 'hb-price-box' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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

		$this->end_controls_section();

		$this->start_controls_section(
			'list',
			[
				'label' => esc_html__( 'List', 'hb-price-box' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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

		$this->end_controls_section();

		$this->start_controls_section(
			'button',
			[
				'label' => esc_html__( 'Button', 'hb-price-box' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
			<div class="price-box">

				<?php if($settings['pricebox_icon']): ?>
				<div class="icon"><?php \Elementor\Icons_Manager::render_icon( $settings['pricebox_icon'], [ 'aria-hidden' => 'true' ] ); ?></div>
				<?php endif; ?>

				<?php if($settings['pricebox_title']): ?>
				<div class="title"><?php echo $settings['pricebox_title']; ?></div>
				<?php endif; ?>

				<?php if($settings['pricebox_subtitle']): ?>
				<div class="subtitle"><?php echo $settings['pricebox_subtitle']; ?></div>
				<?php endif; ?>

				<?php if($settings['pricebox_image']): ?>
				<div class="image">
					<img src="<?php echo $settings['pricebox_image']['url']; ?>" alt="<?php echo $settings['pricebox_image']['url']; ?>">
				</div>
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
								<p><?php echo $list['list_text']; ?></p>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>

				<?php if($settings['pricebox_price']): ?>
				<div class="price">
					شروع قیمت از <?php echo $settings['pricebox_price']; ?> هزار تومان
				</div>
				<?php endif; ?>

				<?php if($settings['pricebox_button_text']): ?>
				<div class="link">
					<a href="<?php echo $settings['pricebox_button_link']; ?>"><?php echo $settings['pricebox_button_text']; ?></a>
				</div>
				<?php endif; ?>

			</div>
			<?php
	}

	
}