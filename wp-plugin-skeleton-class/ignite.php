<?php

namespace wpPluginSkeletonClass;

/*
* Start place to ignite for extending any Wordpress functionalities
*/
class ignite {
    public function start($config = array()){
        //echo "<pre>"; var_dump($config); echo "</pre>"; exit;
        skull::store('config', $config);
        $ajaxName = "ajx_".str_replace('-', '_', strtolower($config['plugin_name']));
        $ajaxUrl = admin_url('admin-ajax.php');
        skull::store('ajax_action', $ajaxName);
        skull::store('ajax_url', $ajaxUrl);

        //add_action( 'admin_init', array($this,'admin_menu'));
        add_action( 'wp_enqueue_scripts', array($this,'default_scripts') );
        add_action( 'admin_menu', array($this,'admin_menu'));
        add_action( 'admin_init', array($this,'processAfterInit'));

        add_action( 'wp_head', function(){
            $ajaxName = skull::retrieve('ajax_action');
            $ajaxUrl = skull::retrieve('ajax_url');
            if(!empty($ajaxName)){
                $nonce = wp_create_nonce($ajaxName);
                /*echo '
                    <script type="text/javascript">
                        var '.$ajaxName.' = "'.$ajaxUrl.'?action='.$ajaxName.'&_wpnonce='.$nonce.'";
                    </script>
                ';*/

                echo '
                    <script type="text/javascript">
                        var '.$ajaxName.' = "'.wp_nonce_url($ajaxUrl, $ajaxName).'&action='.$ajaxName.'";
                    </script>
                ';
            }
        } );
    }

    public function processAfterInit(){
        $this->ajaxAction();
    }

    public function admin_menu(){
        require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'adminMenu.php';
        $adminMenuCls = new adminMenu();
        $adminMenuCls->adminMenuPages();//Creating Main menu pages
        $adminMenuCls->adminSubMenuPages();//Creating Sub menu pages
    }

    public function default_scripts(){
        //
    }

    public function ajaxAction(){
        require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'ajaxAction.php';
        $ajaxActionCls = new ajaxAction();
        $ajaxActionCls->ignite();
    }
}