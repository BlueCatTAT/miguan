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
    
<style>
.control-group {display: flex; align-items: stretch}
.control-group > .btn {flex: none}
.control-group > .input {flex: auto}
.number-range-control {}
.number-range-control > .btn {border-color: #ccc!important}
.number-range-control > .btn:first-child {border-right: none}
.number-range-control > .btn:last-child {border-left: none}
.number-range-control > .btn + .input {text-align: center}
</style>
<input type="hidden" id="card_id" value="<?php echo ($card_info["id"]); ?>"/>
<input type="hidden" id="pre_price" value="<?php echo ($card_info["price"]); ?>"/>
<div class="list comments well">
  <div class="item with-avatar multi-lines">
    <a class="avatar avatar-xl"><img src="/Public/Img/<?php echo ($card_info["pic"]); ?>" alt=""></a>
    <div class="content">
      <div>
        <span class="strong large"><?php echo ($card_info["card_name"]); ?></span>
      </div>
      <div class="btn-reply state text-red">￥<?php echo ($card_info["price"]); ?></div>
    </div>
  </div>
</div>
<div class="box">
  <div class=""> 
    <div class="tile text-center"><p>选择开奖数</p></div>
    <div class="tile text-center">
      <a href="javascript:;" class="outline avatar avatar-xl circle buy_odd_btn">单</a>
      <span style="padding:0px 1rem">vs</span>
      <a href="javascript:;" class="outline avatar avatar-xl circle buy_even_btn">双</a>
    </div>
  </div>
  <div class="text-center"><p>选择购买数量</p></div>
  <div class="row">
    <div class="cell-3"><a data-num="1" class="buy_num_btn btn outline rounded block red">1</a></div>
    <div class="cell-3"><a data-num="3" class="buy_num_btn btn outline rounded block">3</a></div>
    <div class="cell-3"><a data-num="5" class="buy_num_btn btn outline rounded block">5</a></div>
    <div class="cell-3"><a data-num="10" class="buy_num_btn btn outline rounded block">10</a></div>
    <div class="cell-3"><a data-num="15" class="buy_num_btn btn outline rounded block">15</a></div>
    <div class="cell-3"><a data-num="30" class="buy_num_btn btn outline rounded block">30</a></div>
    <div class="cell-3"><a data-num="50" class="buy_num_btn btn outline rounded block">50</a></div>
    <div class="cell-3"><a data-num="100" class="buy_num_btn btn outline rounded block">100</a></div>
  </div>
  <div class="control-group number-range-control">
    <button class="btn buy_num_minus" type="btn"><i class="icon-minus"></i></button>
    <input type="number" class="input" value="1" id="buy_num"/> 
    <button class="btn buy_num_plus" type="btn"><i class="icon-plus"></i></button>
  </div>
  <div class="text-center"><p>本次交易将支付：<span class="text-red buy_price">￥<?php echo ($card_info["price"]); ?></span></p></div>
  <div class="text-center"><p>我的账户余额：<span class="text-red">￥0</span></p></div>
  <div class="text-center">
    <p>您将购买第 <span class="text-red buy_issue"><?php echo ($issue); ?></span> 期, 本期购买剩余时间 
    <div class="inline fnTimeCountDown text-red" data-end="<?php echo ($end_time); ?>">
      <span class="mini">00</span>分
      <span class="sec">00</span>秒
      <span class="hm">000</span>
    </div>
    </p>
  </div>
  <div>
    <button type="button" class="btn red block buy_submit_btn btn-lg" data-type="1">微信支付</button>
    <button type="button" class="btn red block buy_submit_btn btn-lg" data-type="2">支付宝支付</button>
  </div>
</div>
<script>
$(function(){
  $(".fnTimeCountDown").fnTimeCountDown("<?php echo ($start_time); ?>");
  
  var pre_price = $('#pre_price').val();
  var price = $('#price').val();
  $('.buy_num_minus').on('click', function(){
    var buy_num = $('#buy_num').val();    
    buy_num = Number(buy_num) - 1;
    if (buy_num <= 0) {
      buy_num = 1;
    }
    $('#buy_num').val(buy_num);
    price = pre_price * buy_num;
    $('.buy_price').html('￥' + price);
  });
  $('.buy_num_plus').on('click', function(){
    var buy_num = $('#buy_num').val();    
    buy_num = Number(buy_num) + 1;
    if (buy_num <= 0) {
      buy_num = 1;
    }
    set_buy_num(buy_num);
  });
  $('.buy_odd_btn').on('click', function(){
    $('.buy_even_btn').removeClass('red');
    $(this).addClass('red'); 
  });
  $('.buy_even_btn').on('click', function(){
    $('.buy_odd_btn').removeClass('red');
    $(this).addClass('red'); 
  });
  $('.buy_num_btn').on('click', function(){
    $('.buy_num_btn').removeClass('red'); 
    $(this).addClass('red');
    var buy_num = $(this).data('num');
    set_buy_num(buy_num);
  });
  function set_buy_num(num) {
    $('#buy_num').val(num);
    price = pre_price * num;
    $('.buy_price').html('￥' + price);
  }
  //银行卡支付
  $('.buy_submit_btn').on('click', function(){
    if ( ! $('.buy_odd_btn').hasClass('red') && ! $('.buy_even_btn').hasClass('red')) {
      alert('请选择单双数');
      return false;
    }
    var card_id = $('#card_id').val();
    var buy_type = 0;
    if ($('.buy_odd_btn').hasClass('red')) {
      buy_type = 1; 
    } else {
      buy_type = 2;
    }
    var buy_num = $('#buy_num').val();    
    var buy_issue = $('.buy_issue').html();
    var pay_type = $(this).data('type');
    
    $.ajax({
      url: '/wap/buy/ajax_create_order',
      type: 'post',
      dataType: 'json',
      data: {'card_id': card_id, 'buy_type': buy_type, 'buy_num': buy_num, 'buy_issue': buy_issue, 'pay_type': pay_type},
      success: function(res) {
        $.Display.dismiss()
        if (res.status == 1) {
          if (pay_type == 1) {
            window.location.href = res.pay_url;
            //var html = '<h1 class="text-center">长按识别二维码支付</h1>';
            //html += '<img src="http://qr.liantu.com/api.php?text='+res.pay_url+'"/>';
            //var notice = new $.Display({
            //  display: 'modal',
            //  content: html,
            //  placement: 'bottom-center',
            //}); 
            //notice.show();
          } else {
            window.location.href="/wap/buy/pay_set?tradeno="+res.tradeno;
          }
        } else {
          var notice = new $.Display({
            display: 'messager',
            content: res.msg,
            placement: 'top-center',
            type: 'danger'
          }); 
          notice.show();
        }
      } 
    }); 
  });
})
</script>


    


    <!-- /主体 -->
    <!-- 底部 -->
    
<footer>
</footer>


    <!-- /底部 -->
    
  </body>
</html>