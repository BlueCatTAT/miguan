<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
      <script type="text/javascript" src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
      <script type="text/javascript" src="http://libs.useso.com/js/respond.js/1.4.2/respond.min.js"></script>
      <script type="text/javascript" src="http://cdn.bootcss.com/css3pie/2.0beta1/PIE_IE678.js"></script>
    <![endif]-->
    <link type="text/css" rel="stylesheet" href="/Public/Tool/Hui/static/h-ui/css/H-ui.css"/>
    <link type="text/css" rel="stylesheet" href="/Public/Tool/Hui/static/h-ui.admin/css/H-ui.admin.css"/>
    <link type="text/css" rel="stylesheet" href="/Public/Tool/Hui/lib/Hui-iconfont/1.0.8/iconfont.css"/>
    <!--[if IE 7]>
      <link href="http://www.bootcss.com/p/font-awesome/assets/css/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <title>Index</title>
  </head>
  <body>
    
<div class="page-container">
  <table class="table table-border table-bordered table-bg">
    <thead>
      <tr><th>ID</th><th>mch_id</th><th>secret_key</th><th>状态</th><th>操作</th></tr>
    </thead>
    <tbody>
    <?php if(is_array($list)): foreach($list as $key=>$item): ?><tr>
      <td><?php echo ($item['id']); ?></td>
      <td><?php echo ($item['mch_id']); ?></td>
      <td><?php echo ($item['secret_key']); ?></td>
      <td><?php echo ($item['status']); ?></td>
      <td>
        <a href="<?php echo U('/admin/channel/account_edit', array('id' => $item['id']));?>">修改</a> 
        <a href="<?php echo U('/admin/channel/account_del', array('id' => $item['id']));?>">删除</a>
      </td>
    </tr><?php endforeach; endif; ?>
    </tbody>
  </table>
</div>

    <script type="text/javascript" src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js"></script> 
    <script type="text/javascript" src="/Public/Tool/Hui/static/h-ui/js/H-ui.js"></script> 
    <script type="text/javascript" src="/Public/Tool/Hui/static/h-ui.admin/js/H-ui.admin.js"></script>
  </body>
</html>