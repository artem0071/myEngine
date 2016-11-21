<?php

/**
 * Created by PhpStorm.
 * User: artemdegtarev
 * Date: 20.11.16
 * Time: 14:32
 */
class Router extends App
{
    public $URL;
    public $Lang = 'en';
    public $Page = 'intro';
    public $Module = 'main';
    public $Args = array();
    public $mix;

    protected $langs = array('en', 'ru'); // доступные языки, первый по умолчанию
    
    
    function __construct($URL)
    {
        $URL = trim($URL,'/'); // удаляем "/"
        $this->URL = $URL; //записываем весь URL
        $MIX = explode('/', $URL); // разбиваем урл
        $this->mix = $MIX; //помещаем массив урл в микс

        /*
         * $MIX[0] - язык
         * $MIX[1] - страница
         * $MIX[2] - модуль
         * $MIX[3] - параметры
         */

        if (!in_array($MIX[0], $this->langs)){ // если языка нет в разрешенных
            $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2); // получаем язык браузера
            if (!in_array($lang, $this->langs)) $lang = $this->langs[0];  // если языка нет в разрешенных
            header('Location: '. $lang); //перенаправляем на язык
        } else $this->Lang = $MIX[0]; // устанавливаем язык


        $Page = (isset($MIX[1]) ? $MIX[1] : 'intro');  //если в урле установлена страница оставляем, иначе intro
        $PagePath = VIEWS.$Page.'.php'; //путь до вьюхи

        if(file_exists($PagePath) == true){ // если файл существует, то добавить, иначе 404

            $this->Page = $Page;

        } else header('Location: ../'.$this->Lang.'/404');


        $this->Module = (isset($MIX[2]) ? $MIX[2] : 'main');
        
    }

    public function getForController(){
        $arr = array(
            'Lang' => $this->Lang,
            'Page' => $this->Page,
            'Module' => $this->Module
        );
        return $arr;
    }
}