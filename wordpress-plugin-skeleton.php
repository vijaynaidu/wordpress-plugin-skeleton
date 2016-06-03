<?php
/*
Plugin Name: Wordpress Plugin Skeleton
Plugin URI: http://www.vijaynaidu.co.in/
Description: Facebook Page Importer by VijayNaidu.
Author: Vijay M
Text Domain: vijaynaidu
Domain Path: /languages/
Version: 0.1
*/
defined( 'ABSPATH' ) or die('');

$pluginName = "WP_PLUGIN_SKELETON";
//$pluginSlug = strtolower(str_ireplace('_', '-', $pluginName));
$pluginSlug = "wp-plugin-skeleton-class";
$pluginNameSpace = "wpPluginSkeletonClass";


if(defined($pluginName)){
    //If plugin already included
    return;
}

define( $pluginName, true );
define( $pluginName.'_VERSION', '0.1' );
define( $pluginName.'_PLUGIN', __FILE__ );//Eg. /home/me/example.com/wp-content/plugins/vj-plugin/plugin.php
define( $pluginName.'_PLUGIN_BASENAME', plugin_basename( constant($pluginName.'_PLUGIN') ) );//Eg. vj-plugin/plugin.php
define( $pluginName.'_PLUGIN_NAME', trim( dirname( constant($pluginName.'_PLUGIN_BASENAME') ), '/' ) );//Eg. vj-plugin
define( $pluginName.'_PLUGIN_DIR', untrailingslashit( dirname( constant($pluginName.'_PLUGIN') ) ) );//Eg. /home/me/example.com/wp-content/plugins/vj-plugin
define( $pluginName.'_PLUGIN_URL', untrailingslashit( plugins_url( '/', __FILE__ ) ) );//Eg. http://example.com/wp-content/plugins/vj-plugin

$pPath = untrailingslashit( dirname( __FILE__ ) );
require_once $pPath.DIRECTORY_SEPARATOR.$pluginSlug.DIRECTORY_SEPARATOR.'ignite.php';
require_once $pPath.DIRECTORY_SEPARATOR.$pluginSlug.DIRECTORY_SEPARATOR.'skull.php';
require_once $pPath.DIRECTORY_SEPARATOR.$pluginSlug.DIRECTORY_SEPARATOR.'gear.php';
$clsInit = $pluginNameSpace.'\ignite';
$fbPageImporterClass = new $clsInit;
$fbPageImporterClass->start(
    array(
        'access'=>constant($pluginName),
        'version'=>constant($pluginName.'_VERSION'),
        'plugin'=>constant($pluginName.'_PLUGIN'),
        'plugin_base_name'=>constant($pluginName.'_PLUGIN_BASENAME'),
        'plugin_name'=>constant($pluginName.'_PLUGIN_NAME'),
        'plugin_directory'=>constant($pluginName.'_PLUGIN_DIR'),
        'plugin_url'=>constant($pluginName.'_PLUGIN_URL'),
    )
);//Initializing the plugin.

function pluginAdminLinks(){
    add_menu_page('My Custom Page', 'My Custom Page', 'manage_options', 'my-top-level-slug');
}



/*function wp_init_plgn_mod()
{
    var_dump(is_page('share'));exit;
    if(is_page('share')){
        $dir = plugin_dir_path( __FILE__ );
        include($dir."frontend-form.php");
        die();
    }
}

add_action( 'wp', 'wp_init_plgn_mod' );*/
?>