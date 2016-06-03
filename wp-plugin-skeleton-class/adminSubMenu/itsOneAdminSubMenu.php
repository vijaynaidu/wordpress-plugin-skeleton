<?php

namespace wpPluginSkeletonClass\adminSubMenu;

/**
 * @parent_slug = wp-plugin-skeleton
 * @slug = wp-ps-1
 * @page_title= One
 * @menu_title= Sub menu 1
 * @type =main_menu
 * @permission=manage_options
 * @icon_url = __plugin_URL__/assets/images/gear.png
 * @position = 1
 */
class itsOneAdminSubMenu {
    public function ignite(){
        echo "@=Testing sub menu...";
    }
}