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
    <link type="text/css" rel="stylesheet" href="/Public/Tool/Hui/css/H-ui.css"/>
    <link type="text/css" rel="stylesheet" href="/Public/Tool/Hui/css/H-ui.admin.css"/>
    <link type="text/css" rel="stylesheet" href="/Public/Tool/Hui/font/font-awesome.min.css"/>
    <!--[if IE 7]>
      <link href="http://www.bootcss.com/p/font-awesome/assets/css/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <title>修改密码</title>
  </head>
  <body>
    <div class="pd-20">
      <table class="table table-border table-bordered table-striped">
        <tbody>
          <tr>
            <td>账户资金</td>
            <td><?php echo ($user_info['balance']); ?></td>
          </tr>
          <tr>
            <td>上次登录</td>
            <td></td>
          </tr>
          <tr>
            <td>上次IP</td>
            <td></td>
          </tr>
          <tr>
            <td>用户名</td>
            <td><?php echo ($user_info['username']); ?></td>
          </tr>
          <tr>
            <td>邀请码</td>
            <td><?php echo ($user_info['code']); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <script type="text/javascript" src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js"></script> 
    <script type="text/javascript" src="/Public/Tool/Hui/js/H-ui.js"></script> 
    <script type="text/javascript" src="/Public/Tool/Hui/js/H-ui.admin.js"></script>
  </body>
</html>