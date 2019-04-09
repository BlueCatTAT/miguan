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
    
<div class="section" >
  <nav class="nav" data-display data-selector="a" data-show-single="true" data-active-class="active">
    <a class="btn primary active" data-target="#tab1">要闻</a>
    <a class="btn primary" data-target="#tab2">股市评述</a>
    <a class="btn primary" data-target="#tab3">行业动态</a>
  </nav>
  <div>
    <div class="box in" id="tab1">
      <div class="list section">
        <?php if(is_array($list_1)): foreach($list_1 as $key=>$item): ?><a href="<?php echo U('/wap/article/detail', ['id' => $item['id']]);?>" class="item multi-lines with-avatar">
          <div class="content">
            <span class="title"><?php echo ($item['title']); ?></span>
            <div>
              <small class="text-green"><?php echo (mb_substr($item['content'],0,10,'utf-8')); ?></small>&nbsp;
              <small class="muted"><?php echo (date("m-d H:i", $item['created_time'])); ?></small>
              <div class="pull-right label red-pale text-tint"><?php echo ($item['type_name']); ?></div>
            </div>
          </div>
        </a><?php endforeach; endif; ?>
      </div>
    </div>
    <div class="box hidden" id="tab2">
      <div class="list section">
        <?php if(is_array($list_2)): foreach($list_2 as $key=>$item): ?><a href="<?php echo U('/wap/article/detail', ['id' => $item['id']]);?>" class="item multi-lines with-avatar">
          <div class="content">
            <span class="title"><?php echo ($item['title']); ?></span>
            <div>
              <small class="text-green"><?php echo (mb_substr($item['content'],0,10,'utf-8')); ?></small>&nbsp;
              <small class="muted"><?php echo (date("m-d H:i", $item['created_time'])); ?></small>
              <div class="pull-right label red-pale text-tint"><?php echo ($item['type_name']); ?></div>
            </div>
          </div>
        </a><?php endforeach; endif; ?>
      </div>
    </div>
    <div class="box hidden" id="tab3">
      <div class="list section">
        <?php if(is_array($list_3)): foreach($list_3 as $key=>$item): ?><a href="<?php echo U('/wap/article/detail', ['id' => $item['id']]);?>" class="item multi-lines with-avatar">
          <div class="content">
            <span class="title"><?php echo ($item['title']); ?></span>
            <div>
              <small class="text-green"><?php echo (mb_substr($item['content'],0,10,'utf-8')); ?></small>&nbsp;
              <small class="muted"><?php echo (date("m-d H:i", $item['created_time'])); ?></small>
              <div class="pull-right label red-pale text-tint"><?php echo ($item['type_name']); ?></div>
            </div>
          </div>
        </a><?php endforeach; endif; ?>
      </div>
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