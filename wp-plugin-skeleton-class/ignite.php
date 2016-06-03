<?php

namespace wpPluginSkeletonClass;


class ignite {
    public function start($config = array()){
        //echo "<pre>"; var_dump($config); echo "</pre>"; exit;
        skull::store('config', $config);
        add_action( 'admin_menu', array($this,'admin_menu'));
        //add_action( 'admin_init', array($this,'admin_menu'));
    }

    public function admin_menu(){
        require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'adminMenu.php';
        $adminMenuCls = new adminMenu();
        $adminMenuCls->adminMenuPages();//Creating Main menu pages
        $adminMenuCls->adminSubMenuPages();//Creating Sub menu pages
    }
}