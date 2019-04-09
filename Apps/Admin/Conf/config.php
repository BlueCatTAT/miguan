<?php
return array(
    /* 主题设置 */
//    'DEFAULT_THEME' => 'default', // 默认模板主题名称
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
    'PAY_TYPE' => 1
)
?>
