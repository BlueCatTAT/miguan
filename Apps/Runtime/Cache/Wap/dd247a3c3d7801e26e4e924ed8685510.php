<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8"/>
<meta content="zh-cn" http-equiv="Content-Language"/>
<title>惠卡联盟</title>
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
    
<div class="section">
  <form class="box" method="post" action="<?php echo ($pay_url); ?>">
    <input type="hidden" name="interfaceName" class="form-control" value="anonymousPayOrder">
    <input type="hidden" name="version" class="form-control" value="B2C1.0">
    <input type="hidden" name="tranData" class="form-control" value="<?php echo ($tranData); ?>">
    <input type="hidden" name="merSignMsg" class="form-control" value="<?php echo ($merSignMsg); ?>">
    <input type="hidden" name="merchantId" class="form-control" value="<?php echo ($merchantId); ?>">
    <div class="control">
      <label for="user_name">订单号</label>
      <?php echo ($tradeno); ?>
    </div>
    <div class="control">
      <label for="user_name">金额</label>
      <?php echo ($total_price/100); ?>
    </div>
    <div class="control">
      <button type="submit" class="btn block primary submit-btn">提交</button>
    </div>
  </form>
</div>
<script>
$(function(){
});
</script>


    
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