<?php
//@初始化常量
define("CKCODE","ckcode"); //验证码名称,用于后台管理员验证，用于在session,及cookie中使用的数组键值,如：$_SEESION[SJSES][CKCODE];
define("USER","log_username"); //session中数组键值名称，用于存放用户登录后的用户名，如：$_SEESION[SJSES][USER];
define('TBNAME',"admin"); //初始化表名，主要用于登录系统的表，这个主要是管理员后台控制信息表
define('FIELDNAME',"username");
define("FIELDPSW" ,"userpsw");
define("ADMIN_USER_NAME","xqdzjy");
define("PATH_IMG","../../htmleditor/attached/image/mainpic/");
define('IMG_DIR', '/htmleditor/attached/image/mainpic/');
define('PAGESIZE', 10);
?>