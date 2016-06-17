<?php
namespace wpPluginSkeletonClass;


class gear{
    public static function getFileDocBlock($file = "", $for = '', $defaultAnnotationData = array()){
        $annotationData = $defaultAnnotationData;

        if(!empty($file)){
            if(file_exists($file)){
                $docComments = array_filter(
                    token_get_all( file_get_contents($file)), function($entry) {
                        return $entry[0] == T_DOC_COMMENT;
                    }
                );

                $fileDocComment = array_shift($docComments);
                if(!empty($fileDocComment['1'])){
                    //preg_match_all('#@(.*?)\n#s', $fileDocComment['1'], $annotations);
                    //preg_match_all('/(@+[a-zA-Z _]{3,}+[=]{1})+(.*)/', $fileDocComment['1'], $annotations);
                    preg_match_all('/@+([a-zA-Z_]{3,})+[ =]+(.*)/', $fileDocComment['1'], $annotations);
                    //echo "<pre>"; var_dump($annotations);exit;
                    if(!empty($annotations['1']) && !empty($annotations['2'])){
                        $ini = 0;
                        foreach($annotations['1'] as $ant){
                            preg_match('/[a-zA-Z_]{3,}/', $ant, $opt);
                            if(!empty($opt['0']) && isset($annotations['2'][$ini])){
                                $key = strtolower($opt['0']);
                                if(isset($annotationData[$key])){
                                    $vl = $annotations['2'][$ini];
                                    preg_match_all('/"+([(a-z)+(A-Z)+\-]{2,})+"/', $vl, $vl_opt);
                                    //var_dump($vl_opt);exit;
                                    $evlu = trim($annotations['2'][$ini]);
                                    if($key == 'position'){
                                        $evlu = (int) $evlu;
                                    }
                                    $annotationData[$key] = $evlu;
                                }
                            }

                            $ini++;
                        }
                    }
                    //var_dump($annotationData);exit;
                }
            }
        }

        if($annotationData['position'] =="null"){
            $annotationData['position'] = null;
        }

        if(in_array($for, array('add_menu_page', 'add_submenu_page'))){
            if(empty($annotationData['menu_title']) && !empty($annotationData['page_title'])){
                $annotationData['menu_title'] = $annotationData['page_title'];
            }
        }

        return $annotationData;
    }

    public static function replaceConst($string = ''){
        if(!empty($string)){
            $memory = skull::retrieveMemory();
            preg_match_all('/__+([a-zA-Z_]{3,})+__/', $string,$opt);
            if(!empty($opt['1'])){
                $arr_rep = array();
                $arr_rep_val = array();
                $i = 0;
                foreach($opt['1'] as $op){
                    $arr_rep[] = $opt['0'][$i];
                    $vl = '';
                    if(isset($memory['config'][strtolower($op)])){
                        $vl = $memory['config'][strtolower($op)];
                    }
                    $arr_rep_val[] = $vl;

                    $i++;
                }
            }
            if(!empty($arr_rep)){ $string = str_replace($arr_rep, $arr_rep_val, $string); }
        }

        return $string;
    }

    public static function renderAdminView($template = '', $data = array()){
        $html = '';
        if(!empty($template)){
            if(!empty($template)){
                $memory = skull::retrieveMemory();
                $config = $memory['config'];
                //var_dump($config['plugin_directory']);exit;
                if(file_exists($config['plugin_directory'].DIRECTORY_SEPARATOR.'html'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.$template.'.php')){
                    ob_start();
                    $data = $data;
                    include $config['plugin_directory'].DIRECTORY_SEPARATOR.'html'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.$template.'.php';
                    //$htmlData = ob_get_contents();
                    $html = ob_get_clean();
                    //ob_end_clean();
                }
            }
        }

        return $html;
    }
}


?>