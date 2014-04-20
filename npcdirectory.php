<?php
   /*
   Plugin Name: NPC Directory
   Plugin URI: http://www.newtonpres.org
   Description: A plugin to to keep a system of record for the newton pres - people, families, minitries they're involved in and other demographics.
   Version: 1.0
   Author: Charles Essien, Simon Ma
   Author URI: http://byteofcuriosity.com
   License: GPL3
   */

add_filter( 'page_template', 'npcc_registration_page_template' );
function npcc_registration_page_template( $page_template )
{
    $page_template = dirname( __FILE__ ) . '/register.php';
    
    return $page_template;
}

add_shortcode("npccommunity","npc_register_page");

function npc_register_page( $atts ) {
    return "Properly hooked in!";
}

/** Step 2 (from text above). */
add_action( 'admin_menu', 'my_plugin_menu' );

/** Step 1. */
function my_plugin_menu() {
	add_options_page( 'My Plugin Options', 'My Plugin', 'manage_options', 'my-unique-identifier', 'my_plugin_options' );
    add_dashboard_page('NPC Community Directory','NPC Community','manage_options','npc-dashboard-menu','my_plugin_options');
}


/** Step 3. */
function my_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access the NPC Directory. Please contact Jes Kelly or the Church administration office.' ) );
	}
    include_once dirname( __FILE__ ) . '/admin.php';
}

/**** Everything in here and below is for registering a plugin page as a wordpress template ************************************************8*/
class PageTemplater {
    protected $plugin_slug;
    private static $instance;
    protected $templates;


    public static function get_instance() {
            if( null == self::$instance ) {
                    self::$instance = new PageTemplater();
            } 
            return self::$instance;
    } 

    private function __construct() {

            $this->templates = array();


            // Add a filter to the attributes metabox to inject template into the cache.
            add_filter(
                'page_attributes_dropdown_pages_args',
                 array( $this, 'register_project_templates' ) 
            );


            // Add a filter to the save post to inject out template into the page cache
            add_filter(
                'wp_insert_post_data', 
                array( $this, 'register_project_templates' ) 
            );


            // Add a filter to the template include to determine if the page has our 
            // template assigned and return it's path
            add_filter(
                'template_include', 
                array( $this, 'view_project_template') 
            );


            // Add your templates to this array.
            $this->templates = array('register.php'=> 'NPC Community Sign Up','search.php'=> 'NPC Community Directory');

    } 


    /**
     * Adds our template to the pages cache in order to trick WordPress
     * into thinking the template file exists where it doens't really exist.
     */

    public function register_project_templates( $atts ) {

            // Create the key used for the themes cache
            $cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

            // Retrieve the cache list. 
            // If it doesn't exist, or it's empty prepare an array
            $templates = wp_get_theme()->get_page_templates();
            if ( empty( $templates ) ) {
                    $templates = array();
            } 

            // New cache, therefore remove the old one
            wp_cache_delete( $cache_key , 'themes');

            // Now add our template to the list of templates by merging our templates
            // with the existing templates array from the cache.
            $templates = array_merge( $templates, $this->templates );

            // Add the modified cache to allow WordPress to pick it up for listing
            // available templates
            wp_cache_add( $cache_key, $templates, 'themes', 1800 );

            return $atts;

    } 

    /* Checks if the template is assigned to the page */
    public function view_project_template( $template ) {

            global $post;

            if (!isset($this->templates[get_post_meta( 
                $post->ID, '_wp_page_template', true 
            )] ) ) {

                    return $template;

            } 

            $file = plugin_dir_path(__FILE__). get_post_meta( 
                $post->ID, '_wp_page_template', true 
            );

            // Just to be safe, we check if the file exist first
            if( file_exists( $file ) ) {
                    return $file;
            } 
            else { echo $file; }

            return $template;
    } 
} 

add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );
    
?>
