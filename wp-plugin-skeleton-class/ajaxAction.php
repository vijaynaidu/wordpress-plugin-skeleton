<?php
namespace wpPluginSkeletonClass;
use ReflectionClass;

class ajaxAction{
    public function ignite(){
        $ajaxName = skull::retrieve('ajax_action');
        add_action( 'wp_ajax_nopriv_'.$ajaxName, array($this,'ajaxAction'));
        add_action( 'wp_ajax_'.$ajaxName, array($this,'ajaxAction'));
    }

    public function ajaxAction(){
        $resp = array(
            'status'=>false,
            'mess'=>"",
        );
        $ajaxName = skull::retrieve('ajax_action');
        if(!empty($_REQUEST['_wpnonce']) && wp_verify_nonce($_REQUEST['_wpnonce'], $ajaxName)){
            if(!empty($_REQUEST['do'])){
                $do = wpcf7_sanitize_query_var($_REQUEST['do']);
                $files = $this->filesList($do);
                if(!empty($files['0'])){
                    $file = $files['0'];
                    $defaultAnnotationData = array(
                        'permission'=>'',
                    );
                    $fileAnnotations = gear::getFileDocBlock($file, 'ajax_action', $defaultAnnotationData);
                    $fileName = pathinfo($file, PATHINFO_FILENAME);
                    require_once $file;
                    $clsNm = __NAMESPACE__.'\ajaxAction\\'.$fileName;
                    if(class_exists($clsNm)){
                        if(is_callable(array($clsNm, 'ignite')) && is_callable(array($clsNm, 'response')) ){
                            $clsInit = new $clsNm;
                            if(!empty($fileAnnotations['permission'])){
                                if(($fileAnnotations['permission'] =='public') || current_user_can($fileAnnotations['permission'])){
                                    $clsInit->ignite();
                                    $resp = $clsInit->response();
                                }
                                else{
                                    $resp['status'] = false;
                                    $resp['mess'] = 'Not authorized to perform action.';
                                }
                            }
                            else{
                                $resp['status'] = false;
                                $resp['mess'] = 'Invalid permissions.';
                            }
                        }
                    }
                }
            }
            else{
                $resp['status'] = false;
                $resp['mess'] = 'Nothing todo.';
            }
        }
        else{
            $resp['status'] = false;
            $resp['mess'] = 'Invalid authorization';
        }

        header('Content-Type: application/json');
        echo json_encode($resp); exit;
    }

    protected function filesList($do = '', $for = 'ajaxAction'){
        $files = array();

        if(!empty($do)){
            $fNameOri = $do.ucfirst($for);
            preg_match('/[a-zA-Z]{1,}/', $fNameOri, $extracted);
            if(!empty($extracted['0'])){
                $fName = $extracted['0'];
                if(file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR.$for.DIRECTORY_SEPARATOR.$fName.".php")){
                    $files[] = dirname(__FILE__).DIRECTORY_SEPARATOR.$for.DIRECTORY_SEPARATOR.$fName.".php";
                }
            }
        }

        return $files;
    }
}



?>