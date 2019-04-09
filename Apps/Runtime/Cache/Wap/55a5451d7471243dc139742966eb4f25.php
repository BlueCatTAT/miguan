<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8"/>
<meta content="zh-cn" http-equiv="Content-Language"/>
<title>PK</title>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, maximum-scale=1.0, user-scalable=1">
<meta content="application/xhtml+xml; charset=utf-8" http-equiv="Content-Type"/>

<link rel="stylesheet" href="/Public/Tool/mzui/css/mzui.min.css">
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
    
<div class="row box">
  <div class="tile cell">
    <a class="btn block" href="<?php echo U('/wap/top/index');?>">中奖排行榜</a>
  </div>
  <div class="tile cell">
    <a class="btn block yellow-pale text-tint" href="<?php echo U('/wap/top/his');?>">最近参与记录</a>
  </div>
</div>
<div class="list section">
  <?php if(is_array($list)): foreach($list as $key=>$order): ?><a class="item multi-lines with-avatar">
    <div class="avatar "><img src="<?php echo ($order["headimgurl"]); ?>" alt=""></div>
    <div class="content">
      <span class="title"><?php echo ($order["nickname"]); ?></span>
      <div>
        <small class="muted"><?php echo ($order["card_name"]); ?></small>
        <small class="text-red"><?php echo ($order["num"]); ?> 单</small>
      </div>
    </div>
  </a><?php endforeach; endif; ?>
</div>
<div class="section box">
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