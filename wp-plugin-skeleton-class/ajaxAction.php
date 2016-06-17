<?php
namespace wpPluginSkeletonClass;
use ReflectionClass;

class ajaxAction{
    public function ignite(){
        /*
         * Todo: Store the ajax name, form ajax accessible url
         * Todo: Ajax functionality automate with security options.
         * */
        $ajaxName = skull::retrieve('ajax_action');
        add_action( 'wp_ajax_nopriv_'.$ajaxName, array($this,'ajaxAction'));
        add_action( 'wp_ajax_'.$ajaxName, array($this,'ajaxAction'));
    }

    public function ajaxAction(){
        $resp = array(
            'status'=>false,
            'mess'=>"",
        );
        //var_dump($_REQUEST);
        $ajaxName = skull::retrieve('ajax_action');
        if(!empty($_REQUEST['_wpnonce']) && wp_verify_nonce($_REQUEST['_wpnonce'], $ajaxName)){
            //Nounce is valid
            //var_dump('meow');exit;
        }
        else{
            $resp['status'] = false;
            $resp['mess'] = 'Invalid authorization';
        }

        header('Content-Type: application/json');
        echo json_encode($resp); exit;
    }
}



?>