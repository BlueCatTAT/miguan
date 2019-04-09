<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8"/>
<meta content="zh-cn" http-equiv="Content-Language"/>
<title>和富商城</title>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, maximum-scale=1.0, user-scalable=1">
<meta content="application/xhtml+xml; charset=utf-8" http-equiv="Content-Type"/>

<link rel="stylesheet" href="/Public/Tool/mzui/css/mzui.css">
<link rel="stylesheet" href="/Public/Tool/Swiper/swiper-3.4.2.min.css">


<script src="/Public/Tool/mzui/js/mzui.min.js"></script>
<script src="/Public/Tool/Swiper/swiper-3.4.2.jquery.min.js"></script>
<script src="/Public/Js/timecount.js"></script>
<script src="/Public/Js/textSlider.js"></script>


  </head>
  <body>
    <!-- 头部 -->
    


    <!-- /头部 -->
    <!-- 主体 -->
    
<div class="section box">
  <div class="btn-group">
    <button class="btn">按钮组</button>
    <button class="btn">第二个</button>
    <button class="btn">第三个</button>
  </div>
  <div class="text-center box">
    <a class="btn warning rounded <?php if($type != 1): ?>outline<?php endif; ?>" href="<?php echo U('/wap/top/index', array('type' => 1));?>">日榜</a>
    <a class="btn warning rounded <?php if($type != 2): ?>outline<?php endif; ?>" href="<?php echo U('/wap/top/index', array('type' => 2));?>">周榜</a>
    <a class="btn warning rounded <?php if($type != 3): ?>outline<?php endif; ?>" href="<?php echo U('/wap/top/index', array('type' => 3));?>">月榜</a>
  </div>
</div>
<div class="section box">
  <div class="list section">
    <?php if(is_array($list)): foreach($list as $key=>$top): ?><a class="item multi-lines with-avatar">
      <div class="avatar circle outline <?php if($key == 0): ?>red<?php endif; if($key == 1): ?>purple<?php endif; if($key == 2): ?>blue<?php endif; ?>"><?php echo ($key+1); ?></div>
      <div class="avatar "><img src="<?php echo ($top["headimgurl"]); ?>" alt=""></div>
      <div class="content">
        <span class="title"><?php echo ($top["nickname"]); ?></span>
        <div>
          <small class="muted">已获胜</small>
          <small class="text-red"><?php echo ($top["count"]); ?> 单</small>
          <?php if($key == 0): ?><div class="pull-right label red-pale text-tint">第一名</div><?php endif; ?>
          <?php if($key == 1): ?><div class="pull-right label purple-pale text-tint">第二名</div><?php endif; ?>
          <?php if($key == 2): ?><div class="pull-right label blue-pale text-tint">第三名</div><?php endif; ?>
        </div>
      </div>
    </a><?php endforeach; endif; ?>
  </div>
</div>


    
<nav class="nav nav-auto affix dock-bottom justified">
  <a class="flex-column <?php if($action == 'home'): ?>warning<?php endif; ?>" href="<?php echo U('/index');?>">
    <i class="icon icon-home"></i>
    首页
  </a>
  <a class="flex-column <?php if($action == 'top'): ?>warning<?php endif; ?>" href="<?php echo U('/wap/top/index');?>">
    <i class="icon icon-th-list"></i>
    排行
  </a>
  <a class="flex-column <?php if($action == 'chart'): ?>warning<?php endif; ?>" href="<?php echo U('/wap/chart/index');?>">
    <i class="icon icon-star"></i>
    记录
  </a>
  <a class="flex-column <?php if($action == 'user'): ?>warning<?php endif; ?>" href="<?php echo U('/wap/user/index');?>">
    <i class="icon icon-smile"></i>
    我的
  </a>
</nav>


    <!-- /主体 -->
    <!-- 底部 -->
    
<footer>
</footer>


    <!-- /底部 -->
    
  </body>
</html>