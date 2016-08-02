<?php
namespace wpPluginSkeletonClass;
//use fbPageImporterClass\adminMenu\fbimporterAdminMenu;
use ReflectionClass;

class adminMenu{
    public $loadFile = '';

    public function renderAdminMenu(){
        $closure = function(){
            ob_start();
            include $this->loadFile;
            return ob_end_flush();
        };

        $closure = $closure->bindTo($this, $this);
        $closure($this->loadFile);

    }

    /*
     * Todo: Validate $fileAnnotations and do more effective way for "add_menu_page"
     * Todo: icon_url replace with matched defined variables.
     * */
    public function adminMenuPages(){
        $files = $this->filesList();
        foreach($files as $file){
            //$fileAnnotations = $this->getFileDocBlock($file);
            $defaultAnnotationData = array(
                'parent_slug'=>'',
                'slug'=>'',
                'type'=>'',
                'page_title'=>'',
                'menu_title'=>'',
                'permission'=>'',
                'icon_url'=>'',
                'position'=>"null",
            );
            $fileAnnotations = gear::getFileDocBlock($file, 'add_menu_page', $defaultAnnotationData);
            //echo "<pre>";var_dump($fileAnnotations);exit;
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            require_once $file;
            $clsNm = __NAMESPACE__.'\adminMainMenu\\'.$fileName;
            if(class_exists($clsNm)){
                if(is_callable(array($clsNm, 'ignite'))){
                    $clsInit = new $clsNm;
                    if(!empty($fileAnnotations['slug'])){
                        add_menu_page($fileAnnotations['page_title'], $fileAnnotations['menu_title'], $fileAnnotations['permission'], $fileAnnotations['slug'], array($clsInit, 'ignite'), gear::replaceConst($fileAnnotations['icon_url']), $fileAnnotations['position']);
                    }
                }
            }
            //echo "<pre>"; var_dump($fileAnnotations);exit;

            //var_dump($this->getClassAnnotations($clsInit));exit;
        }
        //var_dump($files); exit;
    }

    public function adminSubMenuPages(){
        $files = $this->filesList('adminSubMenu');
        $arrSort = array();
        foreach($files as $file){
            //$fileAnnotations = $this->getFileDocBlock($file);
            $defaultAnnotationData = array(
                'parent_slug'=>'',
                'slug'=>'',
                'type'=>'',
                'page_title'=>'',
                'menu_title'=>'',
                'permission'=>'',
                'icon_url'=>'',
                'position'=>"null",
            );
            $fileAnnotations = gear::getFileDocBlock($file, 'add_submenu_page', $defaultAnnotationData);
            $pos = !empty($fileAnnotations['position'])?$fileAnnotations['position']:count($arrSort);
            $arrSort[] = array(
                'position'=>$pos,
                'file'=>$file,
                'annotations'=>$fileAnnotations,
            );
        }
        usort($arrSort, function($a, $b){ return $a['position'] - $b['position']; });
        foreach($arrSort as $as){
            $file = $as['file'];
            $fileAnnotations = $as['annotations'];
            //echo "<pre>";var_dump($fileAnnotations);exit;
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            require_once $file;
            $clsNm = __NAMESPACE__.'\adminSubMenu\\'.$fileName;
            if(class_exists($clsNm)){
                if(is_callable(array($clsNm, 'ignite'))){
                    $clsInit = new $clsNm;
                    if(!empty($fileAnnotations['parent_slug']) && !empty($fileAnnotations['slug'])){
                        add_submenu_page($fileAnnotations['parent_slug'], $fileAnnotations['page_title'], $fileAnnotations['menu_title'], $fileAnnotations['permission'], $fileAnnotations['slug'], array($clsInit, 'ignite'));
                    }
                }
            }
            //echo "<pre>"; var_dump($fileAnnotations);exit;

            //var_dump($this->getClassAnnotations($clsInit));exit;
        }
        //var_dump($files); exit;
    }

    protected function filesList($for = 'adminMainMenu'){
        $files = array();

        if(file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR.$for.DIRECTORY_SEPARATOR)){
            $files = glob(dirname(__FILE__).DIRECTORY_SEPARATOR.$for.DIRECTORY_SEPARATOR."*".ucfirst($for).".php");
        }

        return $files;
    }

    public function getClassAnnotations($class){
        $r = new ReflectionClass($class);
        $doc = $r->getDocComment();
        preg_match_all('#@(.*?)\n#s', $doc, $annotations);
        return $annotations[1];
    }

    /*public function getFileDocBlock($file = ""){
        $annotationData = array(
            'parent_slug'=>'',
            'slug'=>'',
            'type'=>'',
            'page_title'=>'',
            'menu_title'=>'',
            'permission'=>'',
            'icon_url'=>'',
            'position'=>"null",
        );

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

        if(empty($annotationData['menu_title'])){
            $annotationData['menu_title'] = $annotationData['page_title'];
        }

        return $annotationData;
    }*/
}



?>