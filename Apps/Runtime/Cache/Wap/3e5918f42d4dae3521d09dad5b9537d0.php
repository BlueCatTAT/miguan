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
    
<style>
.profile-haeder {position: relative; overflow: hidden; min-height: 8rem}
.profile-haeder > .back {top: -2rem; left: -2rem; right: -2rem; bottom: -2rem; background-position: center; background-size: cover}
.profile-haeder > .front {background: rgba(0,0,0,.1); text-align: center; padding: 1.5rem}
</style>
<div class="profile-haeder space shadow">
  <div class="red dock blur-lg back" style="background-image: url(/Public/img2.jpg)"></div>
  <div class="front dock text-white">
    <div class="avatar avatar-xl circle space-sm">
      <img src="/Public/avatar.png" alt="">
    </div>
    <h4 class="lead text-shadow-black"><?php echo ($user_info['username']); ?></h4>
  </div>
</div>
<div class="section">
  <div class="list with-divider">
    <a class="item with-avatar" href="/wap/user/share">
      <div class="avatar text-gray circle green"><i class="icon-list-ul"></i></div>
      <div class="title">我的推广</div>
      <i class="icon icon-chevron-right muted"></i>
    </a>
  </div>
</div>
<div class="section">
  <div class="list with-divider">
    <a class="item with-avatar" href="/wap/user/income">
      <div class="avatar text-gray circle warning"><i class="icon-list-ul"></i></div>
      <div class="title">我的战绩</div>
      <i class="icon icon-chevron-right muted"></i>
    </a>
    <a class="item with-avatar" href="/wap/user/follow">
      <div class="avatar text-gray circle green"><i class="icon icon-comments"></i></div>
      <div class="title">我的订阅</div>
      <i class="icon icon-chevron-right muted"></i>
    </a>
    <a class="item with-avatar" href="/wap/user/qa">
      <div class="avatar text-gray circle danger"><i class="icon icon-lock"></i></div>
      <div class="title">问题反馈</div>
      <i class="icon icon-chevron-right muted"></i>
    </a>
    <a class="item with-avatar" href="/wap/user/paper">
      <div class="avatar text-gray circle primary"><i class="icon-cog"></i></div>
      <div class="title">相关协议</div>
      <i class="icon icon-chevron-right muted"></i>
    </a>
    <a class="item with-avatar" href="/wap/user/about">
      <div class="avatar text-gray circle info"><i class="icon-qrcode"></i></div>
      <div class="title">关于我们</div>
      <i class="icon icon-chevron-right muted"></i>
    </a>
    <a class="item with-avatar" href="/wap/user/staff">
      <div class="avatar text-gray circle warning"><i class="icon-qrcode"></i></div>
      <div class="title">客服热线</div>
      <i class="icon icon-chevron-right muted"></i>
    </a>
    <a class="item with-avatar" href="/wap/user/help">
      <div class="avatar text-gray circle danger"><i class="icon-qrcode"></i></div>
      <div class="title">常见问题</div>
      <i class="icon icon-chevron-right muted"></i>
    </a>
  </div>
</div>
<div class="section" style="margin-bottom:70px;">
  <div class="list with-divider">
    <a class="item with-avatar" href="/wap/user/logout">
      <div class="avatar text-gray circle black"><i class="icon-list-ul"></i></div>
      <div class="title">退出登录</div>
      <i class="icon icon-chevron-right muted"></i>
    </a>
  </div>
</div>
<div class="section" style="margin-bottom:70px;"></div>
<script >
</script>


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