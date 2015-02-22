<?php

	require ('libs/Smarty/Smarty.class.php');
    require ('libs/Class/View.class.php');
	require ('libs/Function/Function.php');
	$config	= require('config.php');
	$fileMode = $config['FILE_MODE'];

    View::getInstance()->getSmarty()->setCompileDir('Common/SmartyCompile');
    View::getInstance()->getSmarty()->setCacheDir('Common/SmartyCache');

	//非debug不用创建文件夹
	if(!constant('APP_DEBUG')){
		require('libs/Class/Controller.class.php');

		if(is_array($apps))
		{
			foreach ($apps as  $app) {
                View::getInstance()->getSmarty()->setTemplateDir($app.'/Template');
			}

			require($apps[0].'/Controller/IndexController/IndexController.class.php');
			$index = new IndexController('Index');
			$index->index();

		}elseif (is_string($apps)) {
            View::getInstance()->getSmarty()->setTemplateDir($apps.'/Template');

			require($apps.'/Controller/IndexController/IndexController.class.php');
			$index = new IndexController('Index');
			$index->index();
		}
	}
    else{
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
            $path = __DIR__.'/libs/Tpl/IndexController.class.php';
            foreach ($apps as  $app) {
                createIndexController($app,$path,$fileMode);
                View::getInstance()->getSmarty()->setTemplateDir($app.'/Template');
            }

            require($apps[0].'/Controller/IndexController/IndexController.class.php');
            $index = new IndexController('Index');
            $index->index();

        }elseif (is_string($apps)) {
            createIndexController($apps,__DIR__.'/libs/Tpl/IndexController.class.php',$fileMode);
            View::getInstance()->getSmarty()->setTemplateDir($apps.'/Template');

            require($apps.'/Controller/IndexController/IndexController.class.php');
            $index = new IndexController('Index');
            $index->index();
        }
    }

 ?>