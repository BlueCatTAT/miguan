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
    
<div style="margin-top:50px;">
  <?php if($error): ?><div class="control">
    <div style="padding:10px; text-align:center;" class="tile red-pale text-tint"><?php echo ($error); ?></div>
  </div><?php endif; ?>
  <form class="box" action="#" method="post">
    <div class="control flex">
      <input name="mobile" id="mobile" type="text" class="input" placeholder="手机号" value="<?php echo ($mobile); ?>">
    </div>
    <div class="control flex">
      <input name="username" type="text" class="input" placeholder="姓名">
    </div>
    <div class="control flex">
      <input name="vcode" type="text" class="input" placeholder="验证短信" style="width:50%;">
      <button type="button" id="btnSendCode" class="btn primary" onclick="sendMessage()">发送短信</button>
    </div>
    <div class="control flex">
      <input name="password" type="password" class="input" placeholder="登录密码">
    </div>
    <div class="control flex">
      <input name="repassword" type="password" class="input" placeholder="确认密码">
    </div>
    <div class="control flex">
      <input name="staff_code" type="text" class="input" placeholder="邀请推荐">
    </div>
    <div class="control">
      <button type="submit" class="btn primary block">立即申请</button>
    </div>
  </form>
</div>
<script>
var InterValObj; //timer变量，控制时间 
var count = 30; //间隔函数，1秒执行 
var curCount;//当前剩余秒数 

function sendMessage() { 
  curCount = count; 
  //设置button效果，开始计时 
  $("#btnSendCode").attr("disabled", "true"); 
  $("#btnSendCode").html(curCount + "秒后可重新发送"); 
  InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次 
  //请求后台发送验证码 TODO 
  var mobile = $('#mobile').val();
  $.ajax({
    url: '/wap/public/send_vcode',
    type: 'post',
    dataType: 'json',
    data: {'mobile': mobile},
    success: function(res) {
      console.log(res);
    }
  });
} 

//timer处理函数 
function SetRemainTime() { 
  if (curCount == 0) {         
    window.clearInterval(InterValObj);//停止计时器 
    $("#btnSendCode").removeAttr("disabled");//启用按钮 
    $("#btnSendCode").html("重新发送验证码"); 
  } 
  else { 
    curCount--; 
    $("#btnSendCode").html(curCount + "秒后可重新发送"); 
  } 
} 
</script>


    <!-- /主体 -->
    <!-- 底部 -->
    


    </div>
  </body>
</html>