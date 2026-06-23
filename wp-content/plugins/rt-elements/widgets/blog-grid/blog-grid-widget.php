<?php

use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class ReacTheme_Elementor_Blog_Grid_Widget extends \Elementor\Widget_Base {

    
	/**
	 * Get widget name.
	 *
	 * Retrieve rsgallery widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'react-blog';
	}		

	/**
	 * Get widget title.
	 *
	 * Retrieve rsgallery widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'RT Blog Grid', 'rtelements' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve rsgallery widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'glyph-icon flaticon-blogging';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the rsgallery widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
        return [ 'pielements_category' ];
    }


	/**
	 * Register rsgallery widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {		

		$post_categories = get_terms( 'category' );

        $post_options = [];
        foreach ( $post_categories as $category ) {
            $post_options[ $category->slug ] = $category->name;
        }
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content Settings', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'blog_grid_style',
			[
				'label'   => esc_html__( 'Select Style', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [					
                    'style1' => esc_html__( 'Style 1', 'rtelements'),
                    'style2' => esc_html__( 'Style 2', 'rtelements'),
                    'style3' => esc_html__( 'Style 3', 'rtelements'),
                    'style4' => esc_html__( 'Style 4', 'rtelements'),
                    'style5' => esc_html__( 'Style 5', 'rtelements'),
                    'style6' => esc_html__( 'Style 6', 'rtelements'),
                    'style7' => esc_html__( 'Style 7', 'rtelements'),
				],
			]
		);   
		$this->add_control(
			'category',
			[
				'label'   => esc_html__( 'Category', 'rtelements' ),				
				'type'        => Controls_Manager::SELECT2,
                'options'     => $post_options,
                'default'     => [],
				'multiple' => true,		
			]
		);
        $this->add_control(
            'orderby',
            [
                'label' => esc_html__( 'Order By', 'rtelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => esc_html__( 'Date', 'rtelements' ),
                    'title' => esc_html__( 'Title', 'rtelements' ),
                    'menu_order' => esc_html__( 'Menu Order', 'rtelements' ),
                    'rand' => esc_html__( 'Random', 'rtelements' ),
                    'comment_count' => esc_html__( 'Comment Count', 'rtelements' ),
                    'author' => esc_html__( 'Author', 'rtelements' ),
                    'ID' => esc_html__( 'ID', 'rtelements' ),
                    'modified' => esc_html__( 'Modified Date', 'rtelements' ),
                    'name' => esc_html__( 'Slug', 'rtelements' ),
                ],
            ]
        );
        
        $this->add_control(
            'order',
            [
                'label' => esc_html__( 'Order', 'rtelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC' => esc_html__( 'Descending', 'rtelements' ),
                    'ASC' => esc_html__( 'Ascending', 'rtelements' ),
                ],
            ]
        );
		$this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Per Page', 'rtelements' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '6', 'rtelements' ),
			]
		);        
        $this->add_control(
            'post_offset',
            [
                'label' => esc_html__( 'Offset', 'rtelements' ),
                'type' => Controls_Manager::TEXT,  
            ]
        ); 
        $this->add_control(
            'title_word_count',
            [
                'label' => esc_html__( 'Title Word Limit', 'rtelements' ),
                'type' => Controls_Manager::NUMBER,     
                'placeholder' => esc_html__( '5', 'rtelements' ),      
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'exclude' => [
                    'custom'
                ],
            ]
        ); 
        $this->add_control(
            'blog_des',
            [
                'label' => esc_html__( 'Blog Description', 'rtelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Show', 'rtelements' ),
                    'no' => esc_html__( 'Hide', 'rtelements' ),
                ],     
                'condition' => [
                    'blog_grid_style' => ['style3', 'style7']
                ]           
            ]
        );
        $this->add_control(
            'blog_pagination_show_hide',
            [
                'label' => esc_html__( 'Pagination Show / Hide', 'rtelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rtelements' ),
                    'no' => esc_html__( 'No', 'rtelements' ),
                ],                
            ]
        );
		$this->add_control(
			'blog_columns',
			[
				'label'   => esc_html__( 'Desktops > 1199px', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,
                'default' => 3,			
				'options' => [
                    '1' => esc_html__('1 Column', 'rtelements'),
                    '2' => esc_html__('2 Column', 'rtelements'),
                    '3' => esc_html__('3 Column', 'rtelements'),
                    '4' => esc_html__('4 Column', 'rtelements'),
                    '5' => esc_html__('5 Column', 'rtelements'),
                    '6' => esc_html__('6 Column', 'rtelements'),				
				],							
			]
		);
        $this->add_control(
            'col_md',
            [
                'label'   => esc_html__('Laptop > 991px', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 2,
                'options' => [
                    '1' => esc_html__('1 Column', 'rtelements'),
                    '2' => esc_html__('2 Column', 'rtelements'),
                    '3' => esc_html__('3 Column', 'rtelements'),
                    '4' => esc_html__('4 Column', 'rtelements'),
                    '5' => esc_html__('5 Column', 'rtelements'),
                    '6' => esc_html__('6 Column', 'rtelements'),
                ],
            ]

        );
        $this->add_control(
            'col_sm',
            [
                'label'   => esc_html__('Tablets > 767px', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 1,
                'options' => [
                    '1' => esc_html__('1 Column', 'rtelements'),
                    '2' => esc_html__('2 Column', 'rtelements'),
                    '3' => esc_html__('3 Column', 'rtelements'),
                    '4' => esc_html__('4 Column', 'rtelements'),
                    '5' => esc_html__('5 Column', 'rtelements'),
                    '6' => esc_html__('6 Column', 'rtelements'),
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'meta_section',
            [
                'label' => esc_html__( 'Meta Settings', 'rtelements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
		$this->add_control(
            'blog_avatar_show_hide',
            [
                'label' => esc_html__( 'Author Show / Hide', 'rtelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rtelements' ),
                    'no' => esc_html__( 'No', 'rtelements' ),
                ],                
            ]
        );

		$this->add_control(
            'blog_date_show_hide',
            [
                'label' => esc_html__( 'Date Show / Hide', 'rtelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rtelements' ),
                    'no' => esc_html__( 'No', 'rtelements' ),
                ],                
            ]
        );
        $this->add_control(
            'blog_category_show_hide',
            [
                'label' => esc_html__( 'Category Show / Hide', 'rtelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rtelements' ),
                    'no' => esc_html__( 'No', 'rtelements' ),
                ],                
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__( 'Button Settings', 'rtelements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'blog_grid_style' => ['style4','style5','style7']
                ]
            ]
        );
        $this->add_control(
			'button_text',
			[
				'label' => esc_html__('Button', 'rtelements'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Read More', 'rtelements'),
				'placeholder' => esc_html__('Type your button text here', 'rtelements'),
				'label_block' => true,
			]
		);
        $this->add_control(
			'button_icon',
			[
				'label' => esc_html__('Button Icon', 'rtelements'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'library' => 'solid',
				],
			]
		);
        $this->end_controls_section();

        // ===============================Style==================================//
		$this->start_controls_section(
			'section_slider_style',
			[
				'label' => esc_html__( 'Item', 'rtelements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);        
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient', 'rtelements' ],
                'selector' => '{{WRAPPER}} .blog-item',                
            ]
        );        
        $this->add_control(
            'bitem_border_color',
            [
                'label' => esc_html__( 'Divider Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item' => 'border-color: {{VALUE}};', 
                ],  
                'condition' => [
                    'blog_grid_style' => 'style7',
                ],              
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__( 'Box Shadow', 'plugin-domain' ),
                'selector' => '{{WRAPPER}} .blog-item',
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'item_border',
				'selector' => '{{WRAPPER}} .blog-item',
                'condition' => [
                    'blog_grid_style!' => 'style7',
                ],
			]
		);
        $this->add_responsive_control(
            'blog_border_radius',
            [
                'label' => esc_html__( 'Item Border radius', 'rtelements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
					'{{WRAPPER}} .blog-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],              
            ]
        );  
        $this->add_responsive_control(
			'item_padding',
			[
				'label' => esc_html__( 'Padding', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .blog-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'item_margin',
			[
				'label' => esc_html__( 'Margin', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .grid-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'img_styles',
			[
				'label' => esc_html__( 'Images', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::HEADING,
                'condition' => [
                    'blog_grid_style' => ['style3']
                ]
			]
		);
        $this->add_responsive_control(
			'img_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .grid-item .blog__single--item--link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'condition' => [
                    'blog_grid_style' => ['style3']
                ]
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'section_blog_cats',
            [
                'label' => esc_html__( 'Category', 'rtelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_category_show_hide' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'blog_category_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-cat a' => 'color: {{VALUE}} !important;', 
                    '{{WRAPPER}} .rt-cat span i' => 'color: {{VALUE}} !important;', 
                ],                
            ]
        );
        $this->add_control(
            'blog_category_hover_color',
            [
                'label' => esc_html__( 'Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-cat:hover a' => 'color: {{VALUE}} !important;',                
                    '{{WRAPPER}} .rt-cat:hover i' => 'color: {{VALUE}} !important;',                
                ],               
            ]
        );        	
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'cat_typography',
		        'selector' => '{{WRAPPER}} .rt-cat,{{WRAPPER}} .rt-cat a',		        
		    ]
		);
        $this->add_control(
            'blog_category_bg',
            [
                'label' => esc_html__( 'Background', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-cat a' => 'background: {{VALUE}};', 
                ],                    
                'condition' => [
                    'blog_grid_style' => ['style3','style6']
                ]           
            ]
        );
        $this->add_responsive_control(
            'category_content_padding',
            [
                'label' => esc_html__( 'Padding', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ], 
                'selectors' => [                  
                    '{{WRAPPER}} .rt-cat a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',                    
                ],
            ]
        );
        $this->add_responsive_control(
            'category_content_margin',
            [
                'label' => esc_html__( 'Margin', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ], 
                'selectors' => [
                    '{{WRAPPER}} .rt-cat a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',                    
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_grid_style',
            [
                'label' => esc_html__( 'Date', 'rtelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'blog_date_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .rt-date' => 'color: {{VALUE}} !important;',                  
                    '{{WRAPPER}} .rt-date span i' => 'color: {{VALUE}} !important;',                 
                    '{{WRAPPER}} .rt-date::before' => 'background: {{VALUE}} !important;',                 
                ],                
            ]
        );
        $this->add_control(
            'blog_date_hover_color',
            [
                'label' => esc_html__( 'Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .rt-date:hover' => 'color: {{VALUE}} !important;',                  
                    '{{WRAPPER}} .rt-date:hover span i' => 'color: {{VALUE}} !important;',             
                    '{{WRAPPER}} .rt-date:hover::before' => 'background: {{VALUE}} !important;',               
                ],                
            ]
        );      	
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'date_typography',
		        'selector' => '{{WRAPPER}} .rt-date',		        
		    ]
		);
        $this->add_responsive_control(            
            'blog_date_padding',
            [
                'label' => esc_html__( 'Padding', 'rtelements' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],               
                'selectors' => [
                    '{{WRAPPER}} .rt-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(            
            'blog_date_spacing',
            [
                'label' => esc_html__( 'Margin', 'rtelements' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],               
                'selectors' => [
                    '{{WRAPPER}} .rt-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_author',
            [
                'label' => esc_html__( 'Author', 'rtelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'blog_author_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-author' => 'color: {{VALUE}};', 
                    '{{WRAPPER}} .rt-author a' => 'color: {{VALUE}};', 
                    '{{WRAPPER}} .rt-author span i' => 'color: {{VALUE}};', 
                    '{{WRAPPER}} .rt-author::before' => 'background: {{VALUE}};', 
                ],
                'condition' => [
                    'blog_avatar_show_hide' => 'yes',
                ]                
            ]
        );
        $this->add_control(
            'blog_author_hover_color',
            [
                'label' => esc_html__( 'Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-author:hover a' => 'color: {{VALUE}} !important;',                
                    '{{WRAPPER}} .rt-author:hover i' => 'color: {{VALUE}} !important;',     
                    '{{WRAPPER}} .rt-author:hover::before' => 'background: {{VALUE}};',            
                ],
                'condition' => [
                    'blog_avatar_show_hide' => 'yes',
                ]                
            ]
        );           	
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'author_typography',
		        'selector' => '{{WRAPPER}} .rt-author',		        
		    ]
		);
        $this->add_responsive_control(
            'author_content_padding',
            [
                'label' => esc_html__( 'Padding', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ], 
                'selectors' => [
                    '{{WRAPPER}} .rt-author' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',                    
                ],
            ]
        );
        $this->add_responsive_control(
            'author_content_margin',
            [
                'label' => esc_html__( 'Margin', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ], 
                'selectors' => [
                    '{{WRAPPER}} .rt-author' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_title',
            [
                'label' => esc_html__( 'Title', 'rtelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-title' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .post-title a' => 'color: {{VALUE}} !important;',
                ],                
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-title:hover' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .post-title:hover a' => 'color: {{VALUE}} !important;',
                ],                
            ]            
        );        
        $this->add_control(
			'title_hover_border_color',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Hover Border Color', 'rtelements' ),
                'separator' => 'before',
                'condition' => [
                    'blog_grid_style' => 'style1'
                ]
			]
		);        
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'title_border_color',
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .rts-blog .rts-blog-post.blog-v-full .blog-content .post-title',              
                'separator' => 'after',
                'condition' => [
                    'blog_grid_style' => 'style1'
                ]
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'rtelements' ),
				  
				'selector' => 
                    '{{WRAPPER}} .post-title',
			]
		);

        $this->add_responsive_control(
            'title_content_padding',
            [
                'label' => esc_html__( 'Margin', 'rtelements' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],  
                'selectors' => [
                    '{{WRAPPER}} .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_content_pad',
            [
                'label' => esc_html__( 'Padding', 'rtelements' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],  
                'selectors' => [
                    '{{WRAPPER}} .post-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

        $this->start_controls_section(
            'section_slider_des',
            [
                'label' => esc_html__( 'Description', 'rtelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_des' => 'yes',
                    'blog_grid_style' => ['style3','style7']
                ]
            ]
        );
        $this->add_control(
            'des_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-des' => 'color: {{VALUE}} !important;',
                ],                
            ]
        );      
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'des_typography',
				'label' => esc_html__( 'Typography', 'rtelements' ),
				  
				'selector' => 
                    '{{WRAPPER}} .post-des',
			]
		);

        $this->add_responsive_control(
            'des_content_padding',
            [
                'label' => esc_html__( 'Margin', 'rtelements' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],  
                'selectors' => [
                    '{{WRAPPER}} .post-des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'des_content_pad',
            [
                'label' => esc_html__( 'Padding', 'rtelements' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],  
                'selectors' => [
                    '{{WRAPPER}} .post-des' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

        $this->start_controls_section(
		    '_section_style_button',
		    [
		        'label' => esc_html__( 'Button', 'rtelements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_grid_style' => ['style4']
                ]
		    ]
		);

		$this->start_controls_tabs('_tabs_button');

		$this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rtelements' ),
            ]
        ); 
		$this->add_control(
		    'btn_text_color',
		    [
		        'label' => esc_html__( 'Text Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .react_button' => 'color: {{VALUE}};',
		        ],
		    ]
		);	
		$this->add_control(
		    'btn_bg_color',
		    [
		        'label' => esc_html__( 'Background', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .react_button' => 'background: {{VALUE}};',
		        ],
		    ]
		);		
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .react_button',
		        
		    ]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'btn_border',
		        'selector' => '{{WRAPPER}} .react_button',
		    ]
		);
		$this->add_control(
		    'btn_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .react_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',       
		        ],
		    ]
		);
		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_box_shadow',
		        'selector' => '{{WRAPPER}} .react_button',
		    ]
		);
		$this->add_responsive_control(
		    'btn_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .react_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'btn_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .react_button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->end_controls_tab();
        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rtelements' ),
            ]
        ); 
		$this->add_control(
		    'btn_hover_text_color',
		    [
		        'label' => esc_html__( 'Text Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .react_button:hover' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .react_button:hover span i' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .react_button:hover span svg path' => 'fill: {{VALUE}};',
		        ],
		    ]
		);	
		$this->add_control(
		    'btn_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .react_button::after' => 'background: {{VALUE}};',
		        ],
		    ]
		);		
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_hover_typography',
		        'selector' => '{{WRAPPER}} .react_button:hover',
		        
		    ]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'btn_hover_border',
		        'selector' => '{{WRAPPER}} .react_button:hover',
		    ]
		);
		$this->add_control(
		    'btn_hover_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .react_button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',       
		        ],
		    ]
		);
		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_hover_box_shadow',
		        'selector' => '{{WRAPPER}} .react_button:hover',
		    ]
		);
		$this->add_responsive_control(
		    'btn_hover_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .react_button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'btn_hover_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .react_button:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
        $this->start_controls_section(
		    '_section_nbg_style_button',
		    [
		        'label' => esc_html__( 'Button', 'rtelements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_grid_style' => ['style5','style7']
                ]
		    ]
		);    
        $this->add_control(
		    'nbg_btn_text_color',
		    [
		        'label' => esc_html__( 'Text Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rts-nbg-btn' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .rts-nbg-btn i' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .rts-nbg-btn svg path' => 'fill: {{VALUE}};',
		        ],
		    ]
		);
        $this->add_control(
		    'nbg_btn_hover_text_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rts-nbg-btn:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rts-nbg-btn:hover i' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .rts-nbg-btn:hover svg path' => 'fill: {{VALUE}};',
		        ],
		    ]
		);		
        $this->add_control(
		    'nbg_btn_border_color',
		    [
		        'label' => esc_html__( 'Border Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rts-nbg-btn::before' => 'background: {{VALUE}};',
		            '{{WRAPPER}} .blog-btn' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);	
        $this->add_control(
		    'nbg_btn_border_hover_color',
		    [
		        'label' => esc_html__( 'Border Hover Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rts-nbg-btn:hover::before' => 'background: {{VALUE}};',
		        ],
                'condition' => [
                    'blog_grid_style' => 'style5'
                ]
		    ]
		);		
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'nbg_btn_typography',
		        'selector' => '{{WRAPPER}} .rts-nbg-btn',
		        
		    ]
		);    
        $this->add_control(
			'nbg_btn_border_width',
			[
				'label' => esc_html__('Icon Size', 'rtelements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%','px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rts-nbg-btn svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rts-nbg-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);	
		$this->end_controls_section();
	}

	/**
	 * Render rsgallery widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
        $bstyle = $settings['blog_grid_style'];
        if( $bstyle ){
            $styleClass = ' blog--'.$bstyle;
        }
        if($bstyle=='style2'){
            $styleClass .= ' rts-solari-blog-area-start reveal';
        }
        if($bstyle=='style3'){
            $styleClass .= 'blog-area-style-four';
        }
        $col_lg          = 12 / $settings['blog_columns'] ;
        $col_md          = 12 / $settings['col_md'];
        $col_sm          = 12 / $settings['col_sm'];
        $col = 'col-lg-'.$col_lg.' col-md-'.$col_md.' col-sm-'.$col_sm.' col-12';    
        ?>
		<div class="reactheme-blog-grid2x reactheme-blog-grid<?php echo esc_attr( $styleClass);?>"> 
            <div class="row blog-gird-item">
			 	<?php
			        $cat = $settings['category'];
                    
                    // Get current page - handle both regular pagination and Elementor pagination
                    $paged = 1;
                    if (get_query_var('paged')) {
                        $paged = get_query_var('paged');
                    } elseif (get_query_var('page')) {
                        $paged = get_query_var('page');
                    }
                    $paged = max(1, $paged);
                    
                    // Calculate offset for pagination
                    $post_offset = !empty($settings['post_offset']) ? absint($settings['post_offset']) : 0;
                    
                    $args = [
                        'post_type'      => 'post',
                        'posts_per_page' => $settings['per_page'],
                        'orderby'        => $settings['orderby'],
                        'order'          => $settings['order'],
                    ];
                    
                    // Handle pagination with offset properly
                    if ($settings['blog_pagination_show_hide'] === 'yes') {
                        // When pagination is enabled, calculate offset based on page number
                        // Note: Don't use 'paged' when using 'offset' - they conflict!
                        $offset = $post_offset + (($paged - 1) * $settings['per_page']);
                        if ($offset > 0) {
                            $args['offset'] = $offset;
                        } else {
                            // If no offset, use paged instead for better compatibility
                            $args['paged'] = $paged;
                        }
                    } else {
                        // If pagination is disabled, just use the offset as is
                        if ($post_offset > 0) {
                            $args['offset'] = $post_offset;
                        }
                    }
                                        
                    if (!empty($cat)) {
                        $args['tax_query'] = [
                            [
                                'taxonomy' => 'category',
                                'field'    => 'slug',
                                'terms'    => $cat,
                            ],
                        ];
                    }                    
                    $best_wp = new WP_Query($args);
                    
			        $x=1;
					while($best_wp->have_posts()): $best_wp->the_post(); 
                     $termsArray = get_the_terms( $best_wp->ID, "category" );  //Get the terms for this particular item
                     $termsString = ""; //initialize the string that will contain the terms
                     foreach ( $termsArray as $term ) { // for each term 
                        $termsString .= 'filter_'.$term->slug.' '; //create a string that has all the slugs 
                     }

					$full_date      = get_the_date();
					$blog_date      = get_the_date();	
					$post_admin     = get_the_author();

					if(!empty($settings['blog_word_show'])){
						$limit = $settings['blog_word_show'];
					}
					else{
						$limit = 20;
					} 

                    // include files 
                    include plugin_dir_path(__FILE__) . "/$bstyle.php"; 

                    $x++;
					endwhile;                    
					wp_reset_query();  ?>             
                         
                </div>                                 
            	    
                <?php 
                    $blog_item_data = array(
                    'per_page'  => $settings['per_page']
                );
            wp_localize_script( 'vloglab-main', 'blog_load_data', $blog_item_data );

            // Fix pagination count when using offset
            // When using offset with pagination, we need to manually calculate max_num_pages
            if ($settings['blog_pagination_show_hide'] === 'yes') {
                if ($post_offset > 0 || $paged > 1) {
                    // When using manual offset, WordPress doesn't calculate max_num_pages correctly
                    $total_posts = $best_wp->found_posts - $post_offset;
                    $max_num_pages = ceil($total_posts / $settings['per_page']);
                } else {
                    // Use WordPress calculated value when no offset
                    $max_num_pages = $best_wp->max_num_pages;
                }
            } else {
                $max_num_pages = $best_wp->max_num_pages;
            }

            // Get the base URL for pagination
            $big = 999999999;
			$paginate = paginate_links( array(
			    'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format'    => '?paged=%#%',
                'current'   => max(1, $paged),
                'total'     => $max_num_pages,
                'prev_text' => '&laquo;',
                'next_text' => '&raquo;',
			));

			if(!empty($paginate ) && ($settings['blog_pagination_show_hide'] == 'yes')){ ?>
				<div class="reactheme-pagination-area"><div class="nav-links"><?php echo wp_kses_post($paginate); ?></div></div>
			<?php } ?>              
		</div>
	   <?php

	}
}?>