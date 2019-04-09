<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
  <head lang="zh-cn">
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MZUI</title>
<!-- MZUI CSS 文件 -->
<link href="/Public/Tool/mzui/css/mzui.min.css" rel="stylesheet">
<link href="/Public/Tool/mescroll/mescroll.min.css" rel="stylesheet">
<!-- MZUI 的 JavaScript 插件依赖 jQuery，请使用 jQuery 最新版本 -->
<!--
<script src="/Public/Tool/mzui/js/lib/jquery/jquery.js"></script>
-->
<script src="http://easysoft.github.io/mzui/dist/lib/jquery/jquery-3.2.1.min.js"></script>
<!-- 引入 MZUI 的 JS 文件 -->
<!--
<script src="/Public/Tool/mzui/js/mzui.min.js"></script>
-->
<script src="http://easysoft.github.io/mzui/dist/js/mzui.js"></script>
<script src="/Public/Tool/TouchSlide/TouchSlide.1.1.js"></script>
<script src="/Public/Tool/socket.io.js"></script>
<script src="/Public/Tool/mescroll/mescroll.min.js"></script>
<script src="/Public/Tool/Highstock-6.1.1/code/highstock.js"></script>
<script src="/Public/Tool/Highstock-6.1.1/code/modules/exporting.js"></script>
<script src="/Public/Tool/Highstock-6.1.1/highcharts-zh_CN.js"></script>
<script src="/Public/Tool/qrcode.min.js"></script>
<script src="/Public/Tool/math.min.js"></script>


  </head>
  <body style="background:#ffffff;">
    <!-- 头部 -->
    


    <!-- /头部 -->
    <!-- 主体 -->
    
<nav class="nav dark affix dock-top">
  <a href="/wap/public/login" style="width:20%;">
    <i class="icon icon-chevron-left"></i>
  </a>
  <a style="width:60%;"><span>登录</span></a>
  <a style="width:20%;" href="">
  </a>
</nav>
<div style="margin-top:50px;">
  <form class="box" action="#" method="post">
    <div class="control">
      <div style="padding:10px; text-align:center;" class="tile red-pale text-tint"><?php echo ($error); ?></div>
    </div>
    <div class="control has-label-left has-icon-right">
      <input name="password" type="text" class="input" placeholder="登录密码">
      <label for="password"><i class="icon icon-lock"></i></label>
    </div>
    <div class="control">
      <button type="submit" class="btn primary block">登录</button>
    </div>
  </form>
</div>



    <!-- /主体 -->
    <!-- 底部 -->
    


    </div>
  </body>
</html>