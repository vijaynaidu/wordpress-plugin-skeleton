<?php
namespace wpPluginSkeletonClass;

class skull{
    protected static $memory = array();

    public static function store($reference='', $data = ''){
        if(!empty($reference)){
            self::$memory[$reference] = $data;
        }

        return $data;
    }

    public static function retrieve($reference='', $defaultData = ''){
        $data = $defaultData;

        if(!empty($reference)){
            $data = self::$memory[$reference];
        }

        return $data;
    }

    public static function retrieveMemory(){
        return self::$memory;
    }
}


?>