<?php
/**
 * Plugin Name:       Mail Sender
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            John Smith
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */
defined( 'ABSPATH' ) || exit;
add_action("admin_menu", "add_my_custom_menu");
function add_my_custom_menu(){
    add_menu_page(
        "customplugin", // page title
        "MailSender",      // menu title
        "manage_options", // admin level
        "my-menu-slug",   // page slug
        "call_mailsender", // callback function
        "dashicons-menu", //icon url
         80 //positions
        );
    add_submenu_page(
        "my-menu-slug", //parent slug
        "customplugin", //page title
        "MailSender", //menu title
        "manage_options", //capability = user_level_access
        "my-menu-slug", //menu slug
        "call_mailsender" //callback function
    );
    add_submenu_page(
        "my-menu-slug", //parent slug
        "setting", //page title
        "Setting", //menu title
        "manage_options", //capability = user_level_access
        "mail-setting", //menu slug
        "mail_testing" //callback function
    );
}
function call_mailsender(){
    //all-page functions
}
function mail_testing(){
    //submenu1 functions
    include_once dirname( __FILE__ ) . '/includes/mail-testing.php';
}
function ajax_form_scripts() {
	$translation_array = array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    );
    wp_localize_script( 'main', 'cpm_object', $translation_array );
}
add_action( 'wp_enqueue_scripts', 'ajax_form_scripts' );
// THE AJAX ADD ACTIONS
add_action( 'wp_ajax_set_form', 'set_form' );    //execute when wp logged in
add_action( 'wp_ajax_nopriv_set_form', 'set_form'); //execute when logged out

function set_form(){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];
$admin =get_option('admin_email');
	// wp_mail($email,$name,$message);  main sent to admin and the user
	if(wp_mail($email, $name, $message)  &&  wp_mail($admin, $name, $message) )
       {
           echo "mail sent";
   } else {
          echo "mail not sent";
   }
	die();

}