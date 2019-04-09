<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8"/>
<meta content="zh-cn" http-equiv="Content-Language"/>
<title>鼎盛云商</title>
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
    
<div class="section" style="margin-top:10rem;">
  <div class="box">
    <div class="control">
      <label for="mobile">手机号</label>
      <input name="mobile" id="mobile" type="text" class="input" placeholder="请输入手机号">
    </div>
    <div class="control">
      <label for="code">验证码</label>
      <div class="inline-block">
        <input name="code" id="code" type="text" class="input" placeholder="请输入验证码">
      </div>
      <div class="inline-block">
        <button type="button" class="btn success outline rounded" id="send_code">点击获取验证码</button>
      </div>
    </div>
    <div class="control">
      <button class="btn block primary rounded" type="button" id="login_btn">提交</button>
    </div>
    <div>
      <a class="btn block warning rounded" href="<?php echo U('/wap/public/reg');?>">注册</a> 
    </div>
  </div>
</div>
<script>
$(function(){
  $('#send_code').on('click', function(){
    curCount = count;
    $("#send_code").attr("disabled", "true");
    $("#send_code").html("请在" + curCount + "秒内输入验证码");
    InterValObj = window.setInterval(SetRemainTime, 1000);

    var mobile = $('#mobile').val(); 
    $.ajax({
      url: '/wap/public/send_code',
      type: 'post',
      dataType: 'json',
      data: {'mobile': mobile},
      success: function(res) {
        console.log(res);
        if (res.status != 1) {
          alert(res.msg);
        }
      }
    }); 
  });  
  $('#login_btn').on('click', function(){
    var mobile = $('#mobile').val();
    var code = $('#code').val();
    $.ajax({
      url: '/wap/public/login',
      type: 'post',
      dataType: 'json',
      data: {'mobile': mobile, 'code': code},
      success: function(res){
        console.log(res);
        alert(res.msg); 
        location.reload();
      }
    });
  });

  var InterValObj;
  var count = 60;
  var curCount;

  function SetRemainTime() {
    if (curCount == 0) {                
      window.clearInterval(InterValObj);//停止计时器
      $("#end_code").removeAttr("disabled");//启用按钮
      $("#send_code").html("重新发送验证码");
    }
    else {
      curCount--;
      $("#send_code").html("请在" + curCount + "秒内输入验证码");
    }
  }

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