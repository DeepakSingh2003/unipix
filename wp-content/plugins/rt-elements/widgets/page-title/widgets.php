<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

defined('ABSPATH') || die();

class Reactheme_Elementor_Page_Title extends \Elementor\Widget_Base
{
	public function get_name()
	{
		return 'react-page-title';
	}

	public function get_title()
	{
		return esc_html__('RT Page Title', 'rtelements');
	}

	public function get_icon()
	{
		return 'glyph-icon flaticon-price';
	}

	public function get_categories() {
		return ['pielements_category'];
	}

	protected function register_controls()
	{		
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'custom-title',
			[
				'label' => esc_html__( 'Custom Title', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type your title here', 'rtelements' ),
			]
		);
		
		$this->add_responsive_control(
			'alignments',
			[
				'label' => esc_html__( 'Alignment', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'rtelements' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'rtelements' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'rtelements' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .e_dynamic' => 'text-align: {{VALUE}};',
				],			
			]
		);	 
      		
		$this->add_control(
			'html_tag',
			[
				'label'   => esc_html__('Select HTML Tag', 'rtelements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1' => esc_html__('H1', 'rtelements'),
					'h2' => esc_html__('H2', 'rtelements'),
					'h3' => esc_html__('H3', 'rtelements'),
					'h4' => esc_html__('H4', 'rtelements'),
					'h5' => esc_html__('H5', 'rtelements'),
					'h6' => esc_html__('H6', 'rtelements'),
					'p' => esc_html__('P', 'rtelements'),
					'span' => esc_html__('span', 'rtelements'),
				],
			]
		);
		$this->add_control(
			'color',
			[
				'label' => esc_html__('Color', 'rtelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .e_dynamic' => 'color: {{VALUE}} !important;',
				],
			]
		);		
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .e_dynamic',
			]
		);
		
		$this->add_responsive_control(
			'margin',
			[
				'label' => esc_html__('Margin', 'rtelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .e_dynamic' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);		
		$this->end_controls_section();				
	}
	
	protected function render() {
    $settings = $this->get_settings_for_display();

    $tag = ! empty( $settings['html_tag'] ) ? esc_attr( $settings['html_tag'] ) : 'h2';

    $title = ! empty( $settings['custom-title'] ) 
        ? wp_kses_post( $settings['custom-title'] ) 
        : get_the_title();

    if ( $title ) : ?>       
			<<?php echo $tag; ?> class="e_dynamic">
					<?php echo $title; ?>
			</<?php echo $tag; ?>>
    <?php 
    else :
        echo esc_html__( 'Not Found', 'rtelements' );
    endif; 
}

} ?>