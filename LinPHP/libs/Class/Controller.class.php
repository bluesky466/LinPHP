<?php

/**
 * Class Controller 控制器类的基类
 */
class Controller{
    protected $_controllerName;

    public function __construct($controllerName){
        $this->_controllerName = $controllerName;
    }

	public function display($action=''){
        if(!isset($action{0}))
            $action = $this->_controllerName.'/index.html';
        else if(false === strpos($action,'/')){
            $action = $this->_controllerName.'/'.$action.'.html';
        }

        View::getInstance()->getSmarty()->display($action);
	}
}
 ?>
