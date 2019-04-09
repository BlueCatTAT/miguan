<?php

return array(
    /* 主题设置 */
   // 'DEFAULT_THEME' => 'wap', // 默认模板主题名称
    'DEFAULT_THEME' => 'mobile', // 默认模板主题名称
    'HTML_CACHE_ON' => false,
    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__TOOL__' => __ROOT__ . '/Public/Tool',
        '__CSS__' => __ROOT__ . '/Public/Wap/css',
        '__JS__' => __ROOT__ . '/Public/Wap/js',
        '__IMG__' => __ROOT__ . '/Public/Wap/images',
        '__COVER__' => __ROOT__ . '/Uploads/Home/cover',
        '__AVATAR__' => __ROOT__ . '/Uploads/Home/avatar',
    ),
    'ALIPAY' => array(
        'partner' => '2088711541690264',
        'key' => 'cd3tihmh4ewstowby8lrb03sfl9cwrnh',
        'sign_type' => strtoupper('MD5'),
        'input_charset' => strtolower('utf-8'),
        'cacert' => WEB_APP . '/Apps/User/Util/alipaydirect/cacert.pem',
        'transport' => 'http',
    ),
    'TENPAY' => array(
        'spnam' => "酷读网",
        'partner' => '1239717501',
        'key' => '2b7e18e25abe4a51cfc798a46d201193',
        'return_url' => "http://wap.cooldu.com/tenpay/returnurl",
        'notify_url' => "http://wap.cooldu.com/tenpay/notifyurl"
    ),
    'URL_ROUTER_ON' => true,
    'URL_ROUTE_RULES' => array(
        'top/:cid\d$' => array('top/inex'), //排行榜
        'book/:bid\d$' => array('book/index'), //书主页面
        'chapter/:bid\d$' => array('chapter/chapterlist'), //章节列表
        'chapter/:bid\d/order/:order\d$' => array('chapter/chapterlist'), //章节列表
        'chapter/:bid\d/:cid\d$' => array('chapter/chapterinfo'), //章节内容
        'chap/:bid\d/:cid\d$' => array('chapter/chapterinfo2'), //章节内容
        'comment/:bid\d$' => array('comment/all'), //评论列表
        'comment/:bid\d/:cid\d$' => array('comment/read'), //评论内容
        'tool/:bid\d$' => array('Tool/toollist'), //评论内容
        'cost/:bid\d$' => array('Tool/costlist'), //评论内容
    ),
        )
?>
