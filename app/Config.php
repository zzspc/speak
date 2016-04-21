<?php
namespace App;

class Config
{
    // 数据库实例1
    public static $db1 = array(
        'host'    => '127.0.0.1',
        'port'    => 3306,
        'user'    => 'root',
        'password' => 'root',
        'dbname'  => 'speak',
        'charset'    => 'utf8',
		'dbfix' => 'plf_'
    );
}

//uc center
define('UC_CONNECT', 'mysql');
define('UC_DBHOST', '127.0.0.1');
define('UC_DBUSER', 'root');
define('UC_DBPW', 'root');
define('UC_DBNAME', 'speak');
define('UC_DBCHARSET', 'utf8');
define('UC_DBTABLEPRE', '`speak`.uc_');
define('UC_DBCONNECT', '0');
define('UC_KEY', '123456789');
define('UC_API', 'http://bx.test.cn/uc_server');
define('UC_CHARSET', 'utf-8');
define('UC_IP', '');
define('UC_APPID', '1');
define('UC_PPP', '20');