<?php

return array(
    //'配置项'=>'配置值'
	
    'MODULE_ALLOW_LIST' => array('Admin', 'Api','Wap'),
    'DEFAULT_MODULE' => 'Wap',
    'USER_ADMINISTRATOR1' => 1, //管理员用户ID
    'USER_ADMINISTRATOR2' => 2, //管理员用户ID
    'USER_ADMINISTRATOR3' => 3, //管理员用户ID
    //'USER_ADMINISTRATOR' => array(1,2), //管理员用户ID
    'URL_CASE_INSENSITIVE' => true,
    'TOKEN_ON' => false, // 是否开启令牌验证
    'TOKEN_NAME' => '__hash__', // 令牌验证的表单隐藏字段名称
    'TOKEN_TYPE' => 'md5', //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET' => true,
    'VAR_ADDON' => 'addons',
    'PAYTYPE' => array(
        1 => '支付宝',
        2 => '网银',
        3 => '财付通',
        10 => '移动充值卡',
        11 => '联通充值卡',
        12 => '电信充值卡',
        20 => '骏网一卡通',
        21 => '盛大卡',
        22 => '征途卡',
        23 => '久游一卡通',
        24 => '易宝E卡通',
        25 => '网易一卡通',
        26 => '完美一卡通',
        27 => '纵游一卡通',
        28 => '天下一卡通',
    ),
	//系统参数配置
	'BUY_PRICE_VIP1' => 5, //购买章节单价  VIP1~4 5酷读币/千字
	'BUY_PRICE_VIP2' => 4, //购买章节单价  VIP5~8 4酷读币/千字
	'BUY_PRICE_VIP3' => 3, //购买章节单价  VIP9~15 3酷读币/千字
	'COMPANY_NAME' => '北京酷读文化有限公司',
	'COMPANY_NAME_SIMPLE' => '酷读文化',
	'HIT_DIS_NUM'	=> 3,
    'COLLECT_DIS_NUM'	=> 3,
    //redis
    'REDIS_HOST' => '127.0.0.1',
    'REDIS_PORT' => 6379,
    'REDIS_AUTH' => '4d9c7054', 
);
