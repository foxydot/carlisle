<?php 
if (!class_exists('MSDProductCPT')) {
    class MSDProductCPT {
        //Properties
        var $cpt = 'product';
        //Methods
        /**
        * PHP 4 Compatible Constructor
        */
        public function MSDProductCPT(){$this->__construct();}
    
        /**
         * PHP 5 Constructor
         */
        function __construct(){
            global $current_screen;
            //"Constants" setup
            $this->plugin_url = plugin_dir_url('msd-custom-cpt/msd-custom-cpt.php');
            $this->plugin_path = plugin_dir_path('msd-custom-cpt/msd-custom-cpt.php');
            //Actions
            add_action( 'init', array(&$this,'register_taxonomy_product_type') );
            add_action( 'init', array(&$this,'register_taxonomy_applications') );
            add_action( 'init', array(&$this,'register_cpt_product') );
            add_action('admin_head', array(&$this,'plugin_header'));
            add_action('admin_print_scripts', array(&$this,'add_admin_scripts') );
            add_action('admin_print_styles', array(&$this,'add_admin_styles') );
            add_action('admin_footer',array(&$this,'info_footer_hook') );
            // important: note the priority of 99, the js needs to be placed after tinymce loads
            add_action('admin_print_footer_scripts',array(&$this,'print_footer_scripts'),99);
            
            //Filters
            add_filter( 'pre_get_posts', array(&$this,'custom_query') );
            add_filter( 'enter_title_here', array(&$this,'change_default_title') );
        }

        function register_taxonomy_product_type(){
            
            $labels = array( 
                'name' => _x( 'Product types', 'product-types' ),
                'singular_name' => _x( 'Product type', 'product-types' ),
                'search_items' => _x( 'Search product types', 'product-types' ),
                'popular_items' => _x( 'Popular product types', 'product-types' ),
                'all_items' => _x( 'All product types', 'product-types' ),
                'parent_item' => _x( 'Parent product type', 'product-types' ),
                'parent_item_colon' => _x( 'Parent product type:', 'product-types' ),
                'edit_item' => _x( 'Edit product type', 'product-types' ),
                'update_item' => _x( 'Update product type', 'product-types' ),
                'add_new_item' => _x( 'Add new product type', 'product-types' ),
                'new_item_name' => _x( 'New product type name', 'product-types' ),
                'separate_items_with_commas' => _x( 'Separate product types with commas', 'product-types' ),
                'add_or_remove_items' => _x( 'Add or remove product types', 'product-types' ),
                'choose_from_most_used' => _x( 'Choose from the most used product types', 'product-types' ),
                'menu_name' => _x( 'Product types', 'product-types' ),
            );
        
            $args = array( 
                'labels' => $labels,
                'public' => true,
                'show_in_nav_menus' => true,
                'show_ui' => true,
                'show_tagcloud' => false,
                'hierarchical' => true, //we want a "category" style taxonomy, but may have to restrict selection via a dropdown or something.
        
                'rewrite' => array('slug'=>'product-type','with_front'=>false),
                'query_var' => true
            );
        
            register_taxonomy( 'product_type', array($this->cpt), $args );
        }

        function register_taxonomy_applications(){
            
            $labels = array( 
                'name' => _x( 'Applications', 'applications' ),
                'singular_name' => _x( 'Application', 'applications' ),
                'search_items' => _x( 'Search applications', 'applications' ),
                'popular_items' => _x( 'Popular applications', 'applications' ),
                'all_items' => _x( 'All applications', 'applications' ),
                'parent_item' => _x( 'Parent application', 'applications' ),
                'parent_item_colon' => _x( 'Parent application:', 'applications' ),
                'edit_item' => _x( 'Edit application', 'applications' ),
                'update_item' => _x( 'Update application', 'applications' ),
                'add_new_item' => _x( 'Add new application', 'applications' ),
                'new_item_name' => _x( 'New application name', 'applications' ),
                'separate_items_with_commas' => _x( 'Separate applications with commas', 'applications' ),
                'add_or_remove_items' => _x( 'Add or remove applications', 'applications' ),
                'choose_from_most_used' => _x( 'Choose from the most used applications', 'applications' ),
                'menu_name' => _x( 'Applications', 'applications' ),
            );
        
            $args = array( 
                'labels' => $labels,
                'public' => true,
                'show_in_nav_menus' => true,
                'show_ui' => true,
                'show_tagcloud' => false,
                'hierarchical' => true, //we want a "category" style taxonomy, but may have to restrict selection via a dropdown or something.
        
                'rewrite' => array('slug'=>'application','with_front'=>false),
                'query_var' => true
            );
        
            register_taxonomy( 'market_sector', array($this->cpt), $args );
        }
        
        function register_cpt_product() {
        
            $labels = array( 
                'name' => _x( 'Products', 'product' ),
                'singular_name' => _x( 'Product', 'product' ),
                'add_new' => _x( 'Add New', 'product' ),
                'add_new_item' => _x( 'Add New Product', 'product' ),
                'edit_item' => _x( 'Edit Product', 'product' ),
                'new_item' => _x( 'New Product', 'product' ),
                'view_item' => _x( 'View Product', 'product' ),
                'search_items' => _x( 'Search Product', 'product' ),
                'not_found' => _x( 'No product found', 'product' ),
                'not_found_in_trash' => _x( 'No product found in Trash', 'product' ),
                'parent_item_colon' => _x( 'Parent Product:', 'product' ),
                'menu_name' => _x( 'Product', 'product' ),
            );
        
            $args = array( 
                'labels' => $labels,
                'hierarchical' => true,
                'description' => 'Product',
                'supports' => array( 'title', 'editor', 'author', 'thumbnail' ),
                'taxonomies' => array( 'product_type', 'market_sector' ),
                'public' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'menu_position' => 20,
                
                'show_in_nav_menus' => true,
                'publicly_queryable' => true,
                'exclude_from_search' => true,
                'has_archive' => true,
                'query_var' => true,
                'can_export' => true,
                'rewrite' => array('slug'=>'product','with_front'=>false),
                'capability_type' => 'post'
            );
        
            register_post_type( $this->cpt, $args );
        }
        
        function plugin_header() {
            global $post_type;
            ?>
            <?php
        }
         
        function add_admin_scripts() {
            global $current_screen;
            if($current_screen->post_type == $this->cpt){
                wp_enqueue_script('media-upload');
                wp_enqueue_script('thickbox');
                wp_register_script('my-upload', plugin_dir_url(dirname(__FILE__)).'/js/msd-upload-file.js', array('jquery','media-upload','thickbox'),FALSE,TRUE);
                wp_enqueue_script('my-upload');
            }
        }
        
        function add_admin_styles() {
            global $current_screen;
            if($current_screen->post_type == $this->cpt){
                wp_enqueue_style('thickbox');
                wp_enqueue_style('custom_meta_css',plugin_dir_url(dirname(__FILE__)).'/css/meta.css');
            }
        }   
            
        function print_footer_scripts()
        {
            global $current_screen;
            if($current_screen->post_type == $this->cpt){
                print '<script type="text/javascript">/* <![CDATA[ */
                    jQuery(function($)
                    {
                        var i=1;
                        $(\'.customEditor textarea\').each(function(e)
                        {
                            var id = $(this).attr(\'id\');
             
                            if (!id)
                            {
                                id = \'customEditor-\' + i++;
                                $(this).attr(\'id\',id);
                            }
             
                            tinyMCE.execCommand(\'mceAddControl\', false, id);
             
                        });
                    });
                /* ]]> */</script>';
            }
        }
        function change_default_title( $title ){
            global $current_screen;
            if  ( $current_screen->post_type == $this->cpt ) {
                return __('Product Name','product');
            } else {
                return $title;
            }
        }
        
        function info_footer_hook()
        {
            global $current_screen;
            if($current_screen->post_type == $this->cpt){
                ?><script type="text/javascript">
                        jQuery('#postdivrich').before(jQuery('#_contact_info_metabox'));
                    </script><?php
            }
        }
        

        function custom_query( $query ) {
            if(!is_admin()){
                $is_product = ($query->query_vars['product_type'])?TRUE:FALSE;
                if($query->is_main_query() && $query->is_search){
                    $post_types = $query->query_vars['post_type'];
                    if(count($post_types)==0){
                        $post_types[] = 'post';
                        $post_types[] = 'page';
                    }
                    $post_types[] = $this->cpt;
                    $query->set( 'post_type', $post_types );
                }
                elseif( $query->is_main_query() && $query->is_archive && $is_product ) {
                    $query->set( 'post_type', array('post','page',$this->cpt) );
                }
            }
        }          
  } //End Class
} //End if class exists statement