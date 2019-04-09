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
<script src="/Public/Tool/mzui/js/mzui.min.js"></script>
<script src="/Public/Tool/TouchSlide/TouchSlide.1.1.js"></script>
<script src="/Public/Tool/socket.io.js"></script>
<script src="/Public/Tool/mescroll/mescroll.min.js"></script>
<script src="/Public/Tool/Highstock-6.1.1/code/highstock.js"></script>
<script src="/Public/Tool/Highstock-6.1.1/code/modules/exporting.js"></script>
<script src="/Public/Tool/Highstock-6.1.1/highcharts-zh_CN.js"></script>
<script src="/Public/Tool/qrcode.min.js"></script>

  </head>
  <body style="background:#ffffff;">
    <!-- 头部 -->
    


    <!-- /头部 -->
    <!-- 主体 -->
    
<style>
.profile-haeder {position: relative; overflow: hidden; min-height: 8rem}
.profile-haeder > .back {top: -2rem; left: -2rem; right: -2rem; bottom: -2rem; background-position: center; background-size: cover}
.profile-haeder > .front {background: rgba(0,0,0,.1); padding: 1.5rem}
</style>
<div class="profile-haeder space shadow">
  <div class="red dock blur-lg back" style="background-image: url(/Public/bg22.png)"></div>
  <div class="front dock text-white" style="display: inline-block;">
    <div class="avatar avatar-xl circle space-sm">
      <img src="/Public/avatar.png" alt="">
    </div>
    <div style="display: inline-block; padding:20px;">
      <div>大赛总收益</div>
      <div style="font-size:1.2rem;">0.00%</div>
    </div>
  </div>
</div>
<div class="section" style="margin-top:10px; padding:10px;">
  <div class="row">
    <div class="cell">
      <span class="label danger circle">实盘</span>
    </div>
    <div class="cell" style="flex-direction: column;">
      <div>策略数</div>
      <div>0</div>
    </div>
    <div class="cell" style="flex-direction: column;">
      <div>胜率</div>
      <div>0.00%</div>
    </div>
  </div>
</div>
<div class="section" style="margin-top:10px; padding:10px;">
  <div class="row">
    <div class="cell">
      <span class="label warning circle">大赛</span>
    </div>
    <div class="cell" style="flex-direction: column;">
      <div>日收益率</div>
      <div>0.00%</div>
    </div>
    <div class="cell" style="flex-direction: column;">
      <div>周收益率</div>
      <div>0.00%</div>
    </div>
    <div class="cell" style="flex-direction: column;">
      <div>月收益率</div>
      <div>0.00%</div>
    </div>
  </div>
</div>


    <!-- /主体 -->
    <!-- 底部 -->
    
<nav class="nav nav-auto affix dock-bottom justified">
  <a href="/" <?php if($current == home): ?>class="text-danger"<?php endif; ?> style="display:flex; flex-direction:column; justify-content:center;">
    <span><i class="icon icon-home"></i></span>
    <span>首页</span>
  </a>
  <a href="/wap/policy/index" <?php if($current == policy): ?>class="text-danger"<?php endif; ?> style="display:flex; flex-direction:column; justify-content:center;">
    <span><i class="icon icon-expand-full"></i></span>
    <span>策略</span>
  </a>
  <a href="/wap/stock/chose" <?php if($current == stock): ?>class="text-danger"<?php endif; ?> style="display:flex; flex-direction:column; justify-content:center;">
    <span><i class="icon icon-search"></i></span>
    <span>选股</span>
  </a>
  <a href="/wap/collect/index" <?php if($current == collect): ?>class="text-danger"<?php endif; ?> style="display:flex; flex-direction:column; justify-content:center;">
    <span><i class="icon icon-check-board"></i></span>
    <span>自选</span>
  </a>
  <a href="/wap/user/index" <?php if($current == user): ?>class="text-danger"<?php endif; ?> style="display:flex; flex-direction:column; justify-content:center;">
    <span><i class="icon icon-user"></i></span>
    <span>我的</span>
  </a>
</nav>


    </div>
  </body>
</html>