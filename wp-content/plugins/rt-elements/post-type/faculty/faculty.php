<?php
class ReacTheme_Project_Faculty {

	public function __construct() {
		add_action( 'init', array( $this, 'rt_faculty_register_post_type' ) );		
		add_action( 'init', array( $this, 'rt_create_faculty_category' ) );
	}

	// Register Faculty Post Type
	function rt_faculty_register_post_type() {
		$redux_value = get_option( 'unipix_option' ); // Replace with your Redux option name
		$faculty_label = !empty( $redux_value['faculty_label_text'] ) ? $redux_value['faculty_label_text'] : esc_html__( 'Faculty', 'rsaddons' );

		$labels = array(
			'name'               => $faculty_label,
			'singular_name'      => $faculty_label,
			'add_new'            => sprintf( esc_html__( 'Add New %s', 'rsaddons' ), $faculty_label ),
			'add_new_item'       => sprintf( esc_html__( 'Add New %s', 'rsaddons' ), $faculty_label ),
			'edit_item'          => sprintf( esc_html__( 'Edit %s', 'rsaddons' ), $faculty_label ),
			'new_item'           => sprintf( esc_html__( 'New %s', 'rsaddons' ), $faculty_label ),
			'all_items'          => sprintf( esc_html__( 'All %s', 'rsaddons' ), $faculty_label ),
			'view_item'          => sprintf( esc_html__( 'View %s', 'rsaddons' ), $faculty_label ),
			'search_items'       => sprintf( esc_html__( 'Search %s', 'rsaddons' ), $faculty_label ),
			'not_found'          => sprintf( esc_html__( 'No %s found', 'rsaddons' ), $faculty_label ),
			'not_found_in_trash' => sprintf( esc_html__( 'No %s found in Trash', 'rsaddons' ), $faculty_label ),
			'parent_item_colon'  => sprintf( esc_html__( 'Parent %s:', 'rsaddons' ), $faculty_label ),
			'menu_name'          => $faculty_label,
		);

		$faculty_slug = !empty( $redux_value['faculty_slug'] ) ? $redux_value['faculty_slug'] : 'rt-faculty';

		$args = array(
			'labels'             => $labels,
			'public'             => true,	
			'show_in_menu'       => true,
			'show_in_admin_bar'  => true,
			'can_export'         => true,
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 20,		
			'rewrite'            => array( 'slug' => $faculty_slug, 'with_front' => false ),
			'menu_icon'          => plugins_url( 'img/icon.png', __FILE__ ),
			'supports'           => array( 'title', 'thumbnail', 'editor', 'excerpt' ),
		);
		register_post_type( 'rt-faculty', $args );
	}

	// Register Faculty Category Taxonomy
	function rt_create_faculty_category() {
		$redux_value = get_option( 'unipix_option' );
		$faculty_label = !empty( $redux_value['faculty_label_text'] ) ? $redux_value['faculty_label_text'] : esc_html__( 'Faculty', 'rsaddons' );
		$category_slug = !empty( $redux_value['faculty_cat_slug'] ) ? $redux_value['faculty_cat_slug'] : 'rt-faculty-category';

		$labels = array(
			'name'              => sprintf( esc_html__( '%s Categories', 'rsaddons' ), $faculty_label ),
			'singular_name'     => sprintf( esc_html__( '%s Category', 'rsaddons' ), $faculty_label ),
			'search_items'      => esc_html__( 'Search Categories', 'rsaddons' ),
			'all_items'         => esc_html__( 'All Categories', 'rsaddons' ),
			'edit_item'         => esc_html__( 'Edit Category', 'rsaddons' ),
			'update_item'       => esc_html__( 'Update Category', 'rsaddons' ),
			'add_new_item'      => esc_html__( 'Add New Category', 'rsaddons' ),
			'new_item_name'     => esc_html__( 'New Category Name', 'rsaddons' ),
			'menu_name'         => esc_html__( 'Categories', 'rsaddons' ),
		);

		register_taxonomy(
			'rt-faculty-category',
			'rt-faculty',
			array(
				'labels'            => $labels,
				'hierarchical'      => true,
				'show_admin_column' => true,
				'rewrite'           => array( 'slug' => $category_slug, 'with_front' => false ),
			)
		);
	}
}
new ReacTheme_Project_Faculty();