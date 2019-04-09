<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
  <head lang="zh-cn">
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MZUI</title>
<!-- MZUI CSS 文件 -->
<link href="/Public/tool/mzui/css/mzui.min.css" rel="stylesheet">
<!-- MZUI 的 JavaScript 插件依赖 jQuery，请使用 jQuery 最新版本 -->
<script src="/Public/tool/mzui/js/lib/jquery/jquery.js"></script>
<!-- 引入 MZUI 的 JS 文件 -->
<script src="/Public/tool/mzui/js/mzui.min.js"></script>
<script src="/Public/tool/TouchSlide/TouchSlide.1.1.js"></script>
<script src="/Public/tool/socket.io.js"></script>

  </head>
  <body style="background:#ffffff;">
    <!-- 头部 -->
    


    <!-- /头部 -->
    <!-- 主体 -->
    
<div style="padding:10px;">
  <div class="row">
    <div class="cell-4" style="flex-direction:column;">
      <div class="large text-center">亚普股份</div>
      <div class="gray text-center">12323</div>
    </div>
    <div class="cell-8" style="flex-direction:column;">
      <div class="large">
        2222
      </div>
      <div>
        <span>1.11</span>
        <span>9.33%</span>
      </div>
    </div>
  </div>
</div>
<hr/>
<div style="padding:10px;">
  <div class="row small">
    <div class="cell-3">今开:2222</div>
    <div class="cell-3">最高</div>
    <div class="cell-3">成交量</div>
    <div class="cell-3">涨停价</div>
    <div class="cell-3">昨收</div>
    <div class="cell-3">最低</div>
    <div class="cell-3">成交额</div>
    <div class="cell-3">跌停价</div>
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


  </body>
</html>