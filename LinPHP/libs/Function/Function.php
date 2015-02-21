<?php 
/**
 * [createIndexController 创建默认的index控制器]
 * @param  [type] $dirApp     [项目路径]
 * @param  [type] $pathSource [复制用的基础index控制器]
 * @param  [type] $fileMode   [文件权限]
 */
function createIndexController($dirApp,$pathSource,$fileMode){

	//smarty模板文件存放的目录
	$dirTpl = $dirApp.'/Template';
	if(!is_dir($dirTpl)){
		mkdir($dirTpl,$fileMode,true);
		chmod($dirTpl,$fileMode);
	}

	//创建初始index控制器的模板文件夹
	$dirIndexTemplate = $dirTpl.'/Index';
	if(!is_dir($dirIndexTemplate)){
		mkdir($dirIndexTemplate,$fileMode);
		chmod($dirIndexTemplate,$fileMode);
	}

	//控制器目录
	$dirController = $dirApp.'/Controller';
	if(!is_dir($dirController)){
		mkdir($dirController,$fileMode);
		chmod($dirController,$fileMode);
	}

	//创建初始index控制器
	$dirIndexController = $dirController.'/IndexController';
	if(!is_dir($dirIndexController)){
		mkdir($dirIndexController,$fileMode);
		chmod($dirIndexController,$fileMode);
	}

	$indexController = $dirIndexController.'/IndexController.class.php';
	if(!is_file($indexController)){
		copy($pathSource, $indexController);
		chmod($indexController,$fileMode);
	}

	chmod($dirApp,$fileMode);
}

 ?>
