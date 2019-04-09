<?php if (!defined('THINK_PATH')) exit();?><div class="">
  <div class="box">
    <h1>用户注册</h1>
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
      <button class="btn block primary rounded" type="button" id="bind_btn">提交</button>
    </div>
  </div>
</div>
<script>
$(function(){
  $('#send_code').on('click', function(){
    var isMobile = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(17[0-9]{1})|(14[0-9]{1}))+\d{8})$/;
    var mobile = $('#mobile').val(); 
    if (mobile.lenght == 0) {
      alert('请输入手机号');
      return false;
    }
    if (!isMobile.exec(mobile) && mobile.length != 11) {  
      alert('请输入正确的手机号');
      return false;
    }  
    curCount = count;
    $("#send_code").attr("disabled", "true");
    $("#send_code").html("请在" + curCount + "秒内输入验证码");
    InterValObj = window.setInterval(SetRemainTime, 1000);
    
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
  $('#bind_btn').on('click', function(){
    var mobile = $('#mobile').val();
    var code = $('#code').val();
    var isMobile = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(17[0-9]{1})|(14[0-9]{1}))+\d{8})$/;
    var mobile = $('#mobile').val(); 
    if (mobile.lenght == 0) {
      alert('请输入手机号');
      return false;
    }
    if (!isMobile.exec(mobile) && mobile.length != 11) {  
      alert('请输入正确的手机号');
      return false;
    }  
    if (code.lenght == 0) {
      alert('请输入短信验证码');
      return false;
    }
    $.ajax({
      url: '/wap/public/bind_mobile',
      type: 'post',
      dataType: 'json',
      data: {'mobile': mobile, 'code': code},
      success: function(res) {
        if (res.status == -1) {
          alert(res.msg);
        } else {
          alert(res.msg);
          location.reload();
        }
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
})
</script>