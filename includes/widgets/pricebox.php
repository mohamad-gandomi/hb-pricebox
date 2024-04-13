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
		//wp_register_style( 'hb-pricebox', HBPB_PDU . 'includes/assets/css/widgets/pricebox.css' , array(), '1.0.0' );
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

	}
}