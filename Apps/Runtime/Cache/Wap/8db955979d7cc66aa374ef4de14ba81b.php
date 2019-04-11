<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>mg</title>
<link rel="stylesheet" href="//cdn.bootcss.com/zui/1.9.0/css/zui.min.css">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  </head>
  <body>
    <!-- 头部 -->
    


    <!-- /头部 -->
    <!-- 主体 -->
    
<div class="container">
  <h2>基本信息</h2> 
  <table class="table table-bordered table-striped">
    <tr>
      <td>真实姓名</td>
      <td><?php echo ($data["basic_version"]["basic"]["real_name"]); ?></td>
    </tr>
    <tr>
      <td>用户手机号码</td>
      <td><?php echo ($data["basic_version"]["basic"]["cell_phone"]); ?></td>
    </tr>
    <tr>
      <td>昵称</td>
      <td><?php echo ($data["basic_version"]["basic"]["nickname"]); ?></td>
    </tr>
    <tr>
      <td>注册时间</td>
      <td><?php echo ($data["basic_version"]["basic"]["register_date"]); ?></td>
    </tr>
    <tr>
      <td>账户等级</td>
      <td><?php echo ($data["basic_version"]["basic"]["level"]); ?></td>
    </tr>
    <tr>
      <td>是否认证</td>
      <td><?php echo ($data["basic_version"]["basic"]["is_validate_real_name"]); ?></td>
    </tr>
    <tr>
      <td>安全等级</td>
      <td><?php echo ($data["basic_version"]["basic"]["security_level"]); ?></td>
    </tr>
    <tr>
      <td>用户邮箱</td>
      <td><?php echo ($data["basic_version"]["basic"]["email"]); ?></td>
    </tr>
  </table>
</div>


    <!-- /主体 -->
    <!-- 底部 -->
    
<script src="//cdn.bootcss.com/zui/1.9.0/lib/jquery/jquery.js"></script>
<script src="//cdn.bootcss.com/zui/1.9.0/js/zui.min.js"></script>


    
<script>
</script>


  </body>
</html>