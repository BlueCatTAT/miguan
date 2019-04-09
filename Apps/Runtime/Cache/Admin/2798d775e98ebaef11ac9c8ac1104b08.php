<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link href="/Public/Tool/Hui/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/Public/Tool/Hui/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
<link href="/Public/Tool/Hui/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Public/Tool/Hui/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<script type="text/javascript" src="/Public/Tool/Hui/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/Tool/Hui/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/Public/Tool/canvas-particle.js"></script>
<title>后台登录 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"><span style="color:#ffffff; font-size:20px; line-height:60px; padding-left:20px;">商户后台登陆V1.0 beta</span></div>
 <div id="mydiv" class="loginWraper" style="background:linear-gradient(45deg,#DEF1FF 0,#51C332 100%)">
  <div id="loginform" class="loginBox">
    <form class="form form-horizontal" action="#" method="post">
      <div style="font-size:40px; padding-left:20px; color:#ffffff;">总商户后台登陆</div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input id="" name="username" type="text" placeholder="账户" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input id="" name="password" type="password" placeholder="密码" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <label for="online">
            <input type="checkbox" name="online" id="online" value="">
            使我保持登录状态</label>
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright © 2012-2018</div>
<script>
window.onload = function() {
  //配置
  var config = {
    vx: 4,//小球x轴速度,正  为右，负为左
    vy: 4,//小球y轴速度
    height  : 2,//小球高宽，其实为正方形，所以不宜太大
    width: 2,
    count: 200,//点个数
    //color: "121, 16   2, 185",  //点颜色
    stroke: "255,255,255",    //线条颜色
    dist: 6000,   //点吸附距离
    e_dist: 20000,  //鼠标吸附加速距离
    max_conn: 10  //点到点最大连接数
  }
  //调用
  CanvasParticle(config);
}

</script>
</body>
</html>