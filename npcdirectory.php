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

function npc_create_tables () {
   global $wpdb;

	$npc_people = "npc_people";
   $npc_family = "npc_family";
	$npc_communities = "npc_communities";

	$npc_people_sql = "CREATE TABLE ".$npc_people." (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		created datetime DEFAULT '000-00-00 00:00:00' NOT NULL,
		name tin	
	";
	 
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
    
?>
