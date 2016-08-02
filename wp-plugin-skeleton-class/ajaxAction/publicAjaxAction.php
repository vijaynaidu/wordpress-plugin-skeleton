<?php

namespace wpPluginSkeletonClass\ajaxAction;
use wpPluginSkeletonClass\gear;

/**
 * @permission=public
 */
class publicAjaxAction {
    public function ignite(){
        //This occurres first
    }

    public function response(){
        $resp = array(
            'status'=> true,
            'mess'=> "Testing public access",
        );

        return $resp;
    }
}