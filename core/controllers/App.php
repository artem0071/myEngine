<?php

/**
 * Created by PhpStorm.
 * User: artemdegtarev
 * Date: 20.11.16
 * Time: 15:15
 */
class App
{
    public $Rout;
    public $User;
    
    public function __construct($Rout,$User)
    {
        $this->Rout = $Rout;
        $this->User = $User;
    }

    function render(){

        $this->loadModules($this->Rout->Module);
        include_once HEADER.'1.php';
        include_once LANGUAGES.$this->Rout->Lang.'.php'; // подключение языков
        include_once VIEWS.$this->Rout->Page.'.php';
    }

    function loadModules($modules){

        $modules = explode('&', $modules );

        foreach ($modules as $module){
            if (file_exists(MODULES.$module.'.php') == true){
                include MODULES.$module.'.php';
            }
        }
    }
    
    function loadHeader(){
        
    }
    
    function loadFooter(){
        
    }

}
