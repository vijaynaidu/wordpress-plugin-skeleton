<?php

namespace wpPluginSkeletonClass\adminSubMenu;

/**
 * @parent_slug = wp-plugin-skeleton
 * @slug = wp-ps-3
 * @page_title= Three
 * @menu_title= Sub menu 3
 * @type =main_menu
 * @permission=manage_options
 * @icon_url = __plugin_URL__/assets/images/gear.png
 * @position = 3
 */
class bAdminSubMenu {
    public function ignite(){
        echo "@=Testing sub menu...";
    }
}