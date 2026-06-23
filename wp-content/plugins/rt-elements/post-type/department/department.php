<?php
class ReacTheme_Project_Department {	

    public function __construct() {
        add_action( 'init', array( $this, 'rt_department_register_post_type' ) );		
        add_action( 'init', array( $this, 'rt_create_department_category' ) );
        add_action( 'init', array( $this, 'rt_program_register_post_type' ) );   
        add_action( 'init', array( $this, 'rt_create_program_category' ) );  
    }

    // Register Department Post Type
    public function rt_department_register_post_type() {
        $redux_value = get_option('unipix_option'); // Replace with your actual Redux option key
        $department_label = !empty($redux_value['department_label_text']) ? $redux_value['department_label_text'] : esc_html__('Department', 'rtelements');
        $labels = array(
            'name'               => esc_html__( $department_label, 'rtelements' ),
            'singular_name'      => esc_html__( $department_label, 'rtelements' ),
            'add_new'            => sprintf( esc_html__( 'Add New %s', 'rtelements' ), $department_label ),
            'add_new_item'       => sprintf( esc_html__( 'Add New %s', 'rtelements' ), $department_label ),
            'edit_item'          => sprintf( esc_html__( 'Edit %s', 'rtelements' ), $department_label ),
            'new_item'           => sprintf( esc_html__( 'New %s', 'rtelements' ), $department_label ),
            'all_items'          => sprintf( esc_html__( 'All %s', 'rtelements' ), $department_label ),
            'view_item'          => sprintf( esc_html__( 'View %s', 'rtelements' ), $department_label ),
            'search_items'       => sprintf( esc_html__( 'Search %s', 'rtelements' ), $department_label ),
            'not_found'          => sprintf( esc_html__( 'No %s found', 'rtelements' ), $department_label ),
            'not_found_in_trash' => sprintf( esc_html__( 'No %s found in Trash', 'rtelements' ), $department_label ),
            'parent_item_colon'  => sprintf( esc_html__( 'Parent %s:', 'rtelements' ), $department_label ),
            'menu_name'          => esc_html__( $department_label, 'rtelements' ),
        );

        global $unipix_option;
        $department_slug = (!empty($unipix_option['department_slug'])) ? $unipix_option['department_slug'] : 'rt-department';

        $args = array(
            'labels'             => $labels,
            'public'             => true,	
            'show_in_menu'       => true,
            'show_in_admin_bar'  => true,
            'can_export'         => true,
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => 25,		
            'rewrite'            => array('slug' => $department_slug, 'with_front' => false),
            'menu_icon'          => plugins_url( 'img/icon.png', __FILE__ ),
            'supports'           => array( 'title', 'thumbnail', 'editor', 'excerpt' ),		
        );

        register_post_type( 'rt-department', $args );
    }

    public function rt_create_department_category() {		
        global $unipix_option;
		$dep_category_slug = (!empty($unipix_option['department_cat_slug'])) ? $unipix_option['department_cat_slug'] : 'rt-department-category';
        
        $redux_value = get_option('unipix_option'); // Replace with your actual Redux option key
        $department_label = !empty($redux_value['department_label_text']) ? $redux_value['department_label_text'] : esc_html__('Department', 'rtelements');
        register_taxonomy(
            'rt-department-category',
            'rt-department',
            array(
                'label'             => sprintf(esc_html__( '%s Categories', 'rtelements' ), $department_label),
                'hierarchical'      => true,
                'show_admin_column' => true,
				'rewrite'           => array('slug' => $dep_category_slug, 'with_front' => false),
            )
        );
    }
    
    // program sub post type 
	function rt_program_register_post_type() {
		$labels = array(
			'name'               => esc_html__( 'Program', 'rtelements'),
			'singular_name'      => esc_html__( 'Program', 'rtelements'),
			'add_new'            => esc_html_x( 'Add New Program', 'rtelements'),
			'add_new_item'       => esc_html__( 'Add New Program', 'rtelements'),
			'edit_item'          => esc_html__( 'Edit Program', 'rtelements'),
			'new_item'           => esc_html__( 'New Program', 'rtelements'),
			'all_items'          => esc_html__( 'All Program', 'rtelements'),
			'view_item'          => esc_html__( 'View Program', 'rtelements'),
			'search_items'       => esc_html__( 'Search Program', 'rtelements'),
			'not_found'          => esc_html__( 'No Program found', 'rtelements'),
			'not_found_in_trash' => esc_html__( 'No Program found in Trash', 'rtelements'),
			'parent_item_colon'  => esc_html__( 'Parent Program:', 'rtelements'),
			'menu_name'          => esc_html__( 'Program', 'rtelements'),
		);
	
		global $unipix_option;
		$rt_program_slug = (!empty($unipix_option['rt_program_slug'])) ? $unipix_option['rt_program_slug'] : 'rt-program';
	
		$args = array(
			'labels'             => $labels,
			'public'             => true,	
			'show_in_menu'       => true,
			'show_in_admin_bar'  => true,
			'show_in_nav_menus'  => false,
			'can_export'         => true,
			'has_archive'        => false,
			'hierarchical'       => false,
			'rewrite'            => array('slug' => $rt_program_slug, 'with_front' => false),
			'menu_icon'          => plugins_url( 'img/icon.png', __FILE__ ),
			'supports'           => array( 'title', 'thumbnail', 'editor', 'excerpt' ),		
		);
	
		register_post_type( 'rt-program', $args );        
	}
    public function rt_create_program_category() {	
        global $unipix_option;
		$program_category_slug = (!empty($unipix_option['program_cat_slug'])) ? $unipix_option['program_cat_slug'] : 'rt-program-category';	
        register_taxonomy(
            'rt-program-category',
            'rt-program',
            array(
                'label'             => esc_html__( 'Program Categories', 'rtelements' ),
                'hierarchical'      => true,
                'show_admin_column' => true,
				'rewrite'           => array('slug' => $program_category_slug, 'with_front' => false),
            )
        );
    }
	
}
new ReacTheme_Project_Department();


// Register Program Post type 
function program_submenu_register() {
    add_submenu_page(
        'edit.php?post_type=rt-department', 
        'Program', 
        'Program', 
        'manage_options', 
        'edit.php?post_type=rt-program', 
        '',
		null
    );		
}
add_action('admin_menu', 'program_submenu_register');

function rt_add_program_category_menu() {
    add_submenu_page(
        'edit.php?post_type=rt-department', // Parent menu (related to Department)
        esc_html__( 'Program Categories', 'rtelements' ), // Page title
        esc_html__( 'Program Categories', 'rtelements' ), // Menu title
        'manage_options', // Capability
        'edit-tags.php?taxonomy=rt-program-category&post_type=rt-program' // Taxonomy URL
    );
}
add_action( 'admin_menu', 'rt_add_program_category_menu' );


function rt_program_register_post_type() {
    $labels = array(
        'name'               => esc_html__( 'Program', 'rtelements'),
        'singular_name'      => esc_html__( 'Program', 'rtelements'),
        'add_new'            => esc_html_x( 'Add New Program', 'rtelements'),
        'add_new_item'       => esc_html__( 'Add New Program', 'rtelements'),
        'edit_item'          => esc_html__( 'Edit Program', 'rtelements'),
        'new_item'           => esc_html__( 'New Program', 'rtelements'),
        'all_items'          => esc_html__( 'All Program', 'rtelements'),
        'view_item'          => esc_html__( 'View Program', 'rtelements'),
        'search_items'       => esc_html__( 'Search Program', 'rtelements'),
        'not_found'          => esc_html__( 'No Program found', 'rtelements'),
        'not_found_in_trash' => esc_html__( 'No Program found in Trash', 'rtelements'),
        'parent_item_colon'  => esc_html__( 'Parent Program:', 'rtelements'),
        'menu_name'          => esc_html__( 'Program', 'rtelements'),
    );

    global $unipix_option;
    $program_slug = (!empty($unipix_option['program_slug'])) ? $unipix_option['program_slug'] : 'rt-program';
    $args = array(
        'labels'             => $labels,
        'public'             => true,	
        'show_in_menu'       => true,
        'show_in_admin_bar'  => true,
        'show_in_nav_menus'  => false,
        'can_export'         => true,
        'has_archive'        => false,
        'hierarchical'       => false,
        'rewrite'            => array('slug' => $program_slug, 'with_front' => false),
        'menu_icon'          => plugins_url( 'img/icon.png', __FILE__ ),
        'supports'           => array( 'title', 'thumbnail', 'editor', 'excerpt' ),		
    );
    register_post_type( 'rt-program', $args);

    
}
add_action( 'init', 'rt_program_register_post_type' );



function remove_program_post_type_menu() {
    remove_menu_page('edit.php?post_type=rt-program'); 
}
add_action('admin_menu', 'remove_program_post_type_menu', 9);




/**** department Select Faculty ***/
add_action('cmb2_admin_init', 'department_field_metabox');

function department_field_metabox() {
	$prefix = 'rt_department_';

	/**
	 * Metabox for selecting a department in the Faculty post type
	 */
	$cmb_faculty_dep = new_cmb2_box(array(
		'id'           => $prefix . 'metabox',
		'title'        => esc_html__('Faculty', 'rs-function'),
		'object_types' => array('rt-department'), // Apply to the 'rt-faculty' post type
		'priority'     => 'low',  // 'high', 'core', 'default' or 'low'		
	));

	// Add a field to select a department
	$cmb_faculty_dep->add_field(array(
		'name'    => esc_html__('Select Faculty', 'rs-function'),
		'id'      => 'department_select_faculty',
		'type'    => 'select',
		'options' => get_myposttype_options('rt-faculty'),
	));
}



