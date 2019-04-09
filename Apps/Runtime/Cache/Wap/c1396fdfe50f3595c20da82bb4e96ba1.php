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
    
 
<style>
.pdl0{padding-left: 0px ! important;}
.pdr0{padding-right: 0px ! important;}
.w5{width: 5rem ! important;}
</style>

<div class="section">
  <div class="box">
    <div class="row">
      <div class="cell tile"><a href="<?php echo U('/wap/order/order_list', array('type' => 1));?>" class="btn <?php if($type != 1): ?>outline<?php endif; ?> warning block rounded">所有订单</a></div>
      <div class="cell tile"><a href="<?php echo U('/wap/order/order_list', array('type' => 2));?>" class="btn <?php if($type != 2): ?>outline<?php endif; ?> warning block rounded">获奖订单</a></div>
      <div class="cell tile"><a href="<?php echo U('/wap/order/order_list', array('type' => 3));?>" class="btn <?php if($type != 3): ?>outline<?php endif; ?> warning block rounded">失败订单</a></div>
      <div class="cell tile"><a href="<?php echo U('/wap/order/order_list', array('type' => 4));?>" class="btn <?php if($type != 4): ?>outline<?php endif; ?> warning block rounded">等待开奖</a></div>
    </div>
  </div>
</div>
<div class="section">
  <div class="box"> 
    <div class="list comments" id="list">
      <?php if(empty($list)): ?>没有订单数据<?php endif; ?>
      <?php if(is_array($list)): foreach($list as $key=>$order): ?><div class="divider text-gray"><p>订单号 : <?php echo ($order["tradeno"]); ?></p></div>
      <div class="item with-avatar multi-lines pdl0 pdr0">
        <a class="avatar avatar-xl w5">
          <img src="/Public/Img/<?php echo ($order["pic"]); ?>" alt="">
        </a>
        <div class="content">
          <div>
            <a class="strong"><?php echo ($order["card_name"]); ?></a>
            <div class="muted small pull-right"><?php echo (date("m-d H:i",$order["addtime"])); ?></div>
          </div>
          <div class="btn-reply state">购买数字 : <span class="avatar avatar-sm circle outline red"><?php if($order["buy_type"] == 1): ?>单<?php else: ?>双<?php endif; ?></span></div>
          <div class="btn-reply state">购买金额 : <span class="text-red">￥<?php echo ($order["price"]); ?></span></div>
          <div class="btn-reply state">开奖期号 : <span class="text-gray"><?php echo ($order["name"]); ?></span></div>
          <?php if($order["res"] != 0): ?><div class="btn-reply state">获胜数字 : 
            <span class="avatar avatar-sm circle red outline"><?php echo ($order["num_1"]); ?></span>
            <span class="avatar avatar-sm circle red outline"><?php echo ($order["num_2"]); ?></span>
            <span class="avatar avatar-sm circle red outline"><?php echo ($order["num_3"]); ?></span>
            <span class="avatar avatar-sm circle red outline"><?php echo ($order["num_4"]); ?></span>
            <span class="avatar avatar-sm circle red"><?php echo ($order["num_5"]); ?></span>
          </div><?php endif; ?>
        </div>
      </div>
      <div class="row">
        <div class="cell">
          <?php if($order["res"] == 0): ?><a class="btn brown-pale text-tint">等待开奖</a><?php endif; ?>
          <?php if($order["res"] == 1): ?><a class="btn red-pale text-tint">恭喜中奖</a><?php endif; ?>
          <?php if($order["res"] == 2): ?><a class="btn gray">再接再厉</a><?php endif; ?>
        </div>
      </div><?php endforeach; endif; ?>
    </div>
  </div>
</div>
<div class="section box" style="margin-bottom:3.4rem;">
  <a id="load_more" href="javascript:;" class="btn primary-pale text-tint block" data-page="2" data-type="<?php echo ($type); ?>">点击加载更多</a>
</div>
<script>
$(function(){
  $('#load_more').on('click', function(){
    var page = $(this).data('page');  
    var type = $(this).data('type');
    $.ajax({
      url: '/wap/order/load_more',
      type: 'post',
      dataType: 'html',
      data: {'page': page, 'type': type} ,
      success: function(res) {
        if (res) {
          $('#list').append(res);      
          $('#load_more').data('page', page + 1);
        } else {
          $('#load_more').html('没有更多');
        }
      }
    });
  });
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