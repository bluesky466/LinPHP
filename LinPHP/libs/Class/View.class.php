<?php

/**
 * Class View 视图类的基类,一个单例类
 */
class View {
    private static $_instance;
    private $_smarty;

    private function __construct(){
        $this->_smarty = new Smarty();
    }

    public function getSmarty(){
        return $this->_smarty;
    }

    public static function getInstance(){
        if(self::$_instance===null)
            self::$_instance = new self();

        return self::$_instance;
    }
}