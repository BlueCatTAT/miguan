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
#qrcode  img{
  display:inline !important;
}
</style>
<div class="section" style="margin-top:10px; padding:10px; text-align:center;">
  <h4>邀请小伙伴来赚钱啦</h4>
  <div id="qrcode" style="display:inline-block;">
  </div>
</div>
<div class="section" style="padding:10px;">
  <div class="lead">推广列表</div>
  <hr/>
  <div class="row">
    <div class="cell" style="flex-direction:column;">
      <div>昨日提成:0</div>
      <div>提成总计:0</div>
    </div>
    <div class="cell" style="flex-direction:column;">
      <div>昨日策略:0</div>
      <div>策略总计:0</div>
    </div>
  </div>
</div>
<script>
$(function(){
  var qrcode = new QRCode('qrcode', { 
    text: "<?php echo U('/wap/public/reg', ['id' => $user_info['id']]);?>", 
    width: 256, 
    height: 256, 
    colorDark : '#000000', 
    colorLight : '#ffffff', 
  }); 
})
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