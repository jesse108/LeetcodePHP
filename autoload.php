<?php
class Autoload{
    private static $autoload;
    public $classPaths = [];
    
    public static function SetAutoLoad(){
        if(!self::$autoload){
            self::$autoload = new Autoload();
        }
    }
    
    private function __construct(){
        $this->classPaths[] = dirname(__FILE__);
        $this->init();
    }
    
    /**
     * 类自动加载
     */
    public function  classAutoload($strClassName){
        $strClassName = str_replace('_', '/', $strClassName);
        $strClassName = str_replace('\\','/',$strClassName);
        $classFile = $strClassName . '.php';
        foreach ($this->classPaths as $path){
            $classPath = $path . '/' . $classFile;
            if(file_exists($classPath)){
                require_once $classPath;
                return true;
            }
        }
    }
    
    public function init(){
        spl_autoload_register(array($this,'classAutoload'));
    }
}


Autoload::SetAutoLoad();