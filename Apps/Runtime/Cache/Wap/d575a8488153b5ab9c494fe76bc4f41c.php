<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8"/>
<meta content="zh-cn" http-equiv="Content-Language"/>
<title>众汇双人联盟</title>
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
    
<div class="section box" style="margin-bottom:3.4rem;">
  <img src="/Public/Img/<?php echo ($card_info["pic"]); ?>"/>
  <div class="well">
    <h3><?php echo ($card_info["card_name"]); ?></h3> 
    <div class="large text-red">¥<?php echo ($card_info["price"]); ?></div>
  </div>
  <div class="heading">
    <div class="title">
      <i class="icon icon-time muted"></i>
      <strong>最新动态</strong>
    </div>
  </div>
  <div class="list with-divider">
    <?php if(is_array($order_list)): foreach($order_list as $key=>$order): ?><div class="item with-avatar multi-lines">
      <a class="avatar circle"><img src="<?php echo ($order['headimgurl']); ?>" alt=""></a>
      <div class="content">
        <div>
          <a class="text-link strong"><?php echo ($order['nickname']); ?></a>
          <div class="muted small pull-right"><?php echo (date("H:i", $order['addtime'])); ?></div>
        </div>
        <div class="btn-reply state">
          <span class="tile text-warning"><?php echo ($order['card_name']); ?></span> 
          <span class="tile text-red">x <?php echo ($order['num']); ?> 单</span>
        </div>
      </div>
    </div><?php endforeach; endif; ?>
  </div>
</div>
<script type="text/javascript">
$(function(){
  $('.buy_card').on('click', function(){
    $.ajax({
      url: '/wap/public/check_buy_time',
      type: 'post',
      dataType: 'json',
      success: function(res) {
        if (res.status == -1) {
          alert('开奖前1分钟不能下单');
          return false;
        } 
      }
    });
    var card_id = $(this).data('id');
    var buy_box = new $.Display({
      backdrop: true,
      placement: 'bottom',
      remote: '/wap/card/buy_info?id=' + card_id,
      display: 'modal'
    }); 
    buy_box.show();
  });
})
$(".fnTimeCountDown").fnTimeCountDown("<?php echo ($start_time); ?>");
</script>


    
<div class="nav nav-auto affix dock-bottom justified">
  <div>
    <a class="flex-column btn btn-lg warning pull-right buy_card" href="javascript:;" style="padding-left: 3rem; padding-right:3rem;" data-id="<?php echo ($card_info["id"]); ?>">购买</a>
  </div>
</div>


    <!-- /主体 -->
    <!-- 底部 -->
    
<footer>
</footer>


    <!-- /底部 -->
    
  </body>
</html>