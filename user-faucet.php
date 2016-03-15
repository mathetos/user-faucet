<?php
/*
Plugin Name: User Faucet
Plugin URI: https://www.mattcromwell.com
Description: This is an extension of the "Beyond 2016" theme. It enhances the archives and single product pages for the Give Donation plugin, Easy Digital Downloads, and WooCommerce for "Beyond 2016".
Version: 1.0.0
Author: webdevmattcrom
Author URI: https://www.mattcromwell.com
License: GPLv2 or later
Text Domain: b16ecom
*/
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
Copyright 2016 Matt Cromwell
*/
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}
// Globals
define( 'WIPUF_SLUG', 'b16ecom' );
define( 'WIPUF_PATH', plugin_dir_path( __FILE__ ) );
define( 'WIPUF_URL', plugin_dir_url( __FILE__ ) );
define( 'WIPUF_VERSION', '1.0' );

class USERFAUCET_Loader {
  public function __construct() {
    $this->plugin_slug = WIPUF_SLUG;
    $this->version = WIPUF_VERSION;

    add_action( 'plugins_loaded', array( $this, 'wipuf_admin' ) );
    add_action( 'admin_enqueue_scripts', array($this, 'wipuf_load_admin_scripts') );

  }

  public function wipuf_admin() {
      require_once( WIPUF_PATH . '/admin/wipuf_admin.php');
  }

  public function wipuf_load_admin_scripts($hook) {

		global $wipuf_adminpage;

		if( $hook != $wipuf_adminpage ) {
			return; }

		wp_register_style( 'wipuf-datatables-css', 'https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css', false, '1.0.0' );
    wp_enqueue_style( 'wipuf-datatables-css' );

		wp_register_script( 'wipuf-databales-js', 'https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js', false, '1.0.0' );
		wp_enqueue_script( 'wipuf-databales-js' );
	}

  public function run() {
 }
}

function run_userfaucet_loader() {
   $b16ecom = new USERFAUCET_Loader();
   $b16ecom->run();
}

run_userfaucet_loader();
