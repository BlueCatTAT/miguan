<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8"/>
<meta content="zh-cn" http-equiv="Content-Language"/>
<title>和富商城</title>
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
    
<style>
.profile-haeder {position: relative; overflow: hidden; min-height: 9rem}
.profile-haeder > .back {top: -2rem; left: -2rem; right: -2rem; bottom: -2rem; background-position: center; background-size: cover}
.profile-haeder > .front {background: rgba(0,0,0,.1); text-align: center; padding: 1.5rem}
</style>
<div class="profile-haeder space shadow">
  <div class="red dock blur-lg back" style="background-image: url()"></div>
  <div class="front dock text-white">
    <div class="avatar avatar-xl circle space-sm">
      <img src="<?php echo ($userinfo["headimgurl"]); ?>" alt="">
    </div>
    <h4 class="lead text-shadow-black"><?php echo ($userinfo["nickname"]); ?></h4>
    <div>总单数：<?php echo ($order_all); ?> 成功单数：<?php echo ($order_win); ?> 失败单数：<?php echo ($order_lose); ?></div>
  </div>
</div>
<div class="section">
  <div class="list with-divider">
    <a class="item with-avatar" href="<?php echo U('/wap/order/order_list');?>">
      <div class="avatar text-gray"><i class="icon-list-ul"></i></div>
      <div class="title">购买记录</div>
      <i class="icon icon-chevron-right muted"></i>
    </a>
    <a class="item with-avatar" href="<?php echo U('/wap/prize/prize_list');?>">
      <div class="avatar text-gray"><i class="icon icon-comments"></i></div>
      <div class="title">兑换记录</div>
      <i class="icon icon-chevron-right muted"></i>
    </a>
    <a class="item with-avatar" href="<?php echo U('/wap/user/address_info');?>">
      <div class="avatar text-gray"><i class="icon icon-comments"></i></div>
      <div class="title">收货地址</div>
      <i class="icon icon-chevron-right muted"></i>
    </a>
    <a class="item with-avatar" href="<?php echo U('/wap/user/bank_info');?>">
      <div class="avatar text-gray"><i class="icon icon-comments"></i></div>
      <div class="title">绑定银行卡</div>
      <i class="icon icon-chevron-right muted"></i>
    </a>
    <a class="item with-avatar" href="<?php echo U('/wap/top/index');?>">
      <div class="avatar text-gray"><i class="icon icon-lock"></i></div>
      <div class="title">总排行榜</div>
      <i class="icon icon-chevron-right muted"></i>
    </a>
    <!--
    <a class="item with-avatar" href="<?php echo U('/wap/about/intro');?>">
      <div class="avatar text-gray"><i class="icon-cog"></i></div>
      <div class="title">玩法介绍</div>
      <i class="icon icon-chevron-right muted"></i>
    </a>
    -->
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