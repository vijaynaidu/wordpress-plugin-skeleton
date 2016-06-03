<?php
namespace wpPluginSkeletonClass;


class gear{
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