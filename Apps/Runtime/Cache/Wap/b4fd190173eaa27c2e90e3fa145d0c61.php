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
    
<div class="section box">
  <div class="row text-gray">
    <div class="cell-7 justify-start">中奖号码</div>
    <div class="cell-5 justify-end">单双数</div>
  </div>
</div>
<div class="section box num_list" id="list">
  <?php if(is_array($list)): foreach($list as $key=>$item): ?><div>
    <p>第<span class="text-gray"> <?php echo ($item["name"]); ?> </span>期</p>
  </div>
  <div class="row">
    <div class="cell-7">
      <span class="avatar circle outline red"><?php echo ($item["num_1"]); ?></span> 
      <span class="avatar circle outline red"><?php echo ($item["num_2"]); ?></span> 
      <span class="avatar circle outline red"><?php echo ($item["num_3"]); ?></span> 
      <span class="avatar circle outline red"><?php echo ($item["num_4"]); ?></span> 
      <span class="avatar circle red"><?php echo ($item["num_5"]); ?></span> 
    </div>
    <div class="cell-5 justify-end">
      <span class="avatar circle red <?php if($item['num_5']%2 == 0): ?>outline<?php endif; ?>">单</span>
      <span class="avatar circle red <?php if($item['num_5']%2 != 0): ?>outline<?php endif; ?>">双</span>
    </div>
  </div>
  <hr/><?php endforeach; endif; ?>
</div>
<div class="section box" style="margin-bottom:3.4rem;">
  <a id="load_more" href="javascript:;" class="btn primary-pale text-tint block" data-page="2">点击加载更多</a>
</div>
<script>
$(function(){
  $('#load_more').on('click', function(){
    var page = $(this).data('page');  
    $.ajax({
      url: '/wap/chart/load_more',
      type: 'post',
      dataType: 'html',
      data: {'page': page} ,
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
})
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