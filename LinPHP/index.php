<?php 
	require ("libs/Smarty/Smarty.class.php");
	require ("libs/Function/Function.php");
	$config	= require("config.php");
	$fileMode = $config['FILE_MODE'];

	$smarty = new Smarty();
	$smarty->compile_dir = 'Common/SmartyCompile';
	$smarty->cache_dir     = 'Common/SmartyCache';

	//非debug不用创建文件夹
	if(!constant('APP_DEBUG')){
		require('libs/Class/Controller.class.php');

		if(is_array($apps))
		{
			foreach ($apps as  $app) {
				$smarty->setTemplateDir($app.'/Template');
			}

			require($apps[0].'/Controller/IndexController/IndexController.class.php');
			$index = new IndexController();
			$index->index();

		}elseif (is_string($apps)) {
			$smarty->setTemplateDir($app.'/Template');

			require($apps.'/Controller/IndexController/IndexController.class.php');
			$index = new IndexController();
			$index->index();
		}
		return;
	}

	if(!is_dir('Common')){
		mkdir('Common',$fileMode);
		chmod('Common',$fileMode);
	}

	if(!is_dir('Common/SmartyCompile')){
		mkdir('Common/SmartyCompile',$fileMode);
		chmod('Common/SmartyCompile',$fileMode);
	}

	if(!is_dir('Common/SmartyCache')){
		mkdir('Common/SmartyCache',$fileMode);
		chmod('Common/SmartyCache',$fileMode);
	}

	//一些公用的配置,如数据库账号密码等的配置
	if(!is_file('Common/config.php')){
		touch('Common/config.php');
		chmod('Common/config.php',$fileMode);
	}

	require('libs/Class/Controller.class.php');

	//生成项目文件夹
	if(is_array($apps))
	{
		$path = __DIR__.'/libs/Class/IndexController.class.php';
		foreach ($apps as  $app) {
			createIndexController($app,$path,$fileMode);
			$smarty->setTemplateDir($app.'/Template');
		}

		require($apps[0].'/Controller/IndexController/IndexController.class.php');
		$index = new IndexController();
		$index->index();

	}elseif (is_string($apps)) {
		createIndexController($apps,__DIR__.'/libs/Class/IndexController.class.php',$fileMode);
		$smarty->setTemplateDir($apps.'/Template');

		require($apps.'/Controller/IndexController/IndexController.class.php');
		$index = new IndexController();
		$index->index();
	}
 ?>