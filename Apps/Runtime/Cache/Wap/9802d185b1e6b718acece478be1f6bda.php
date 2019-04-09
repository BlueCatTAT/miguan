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
  <form class="box" method="post">
    <div class="control">
      <label for="name">持卡人</label>
      <input name="name" id="name" type="text" class="input" placeholder="请填写开户人" value="<?php echo ($bank_card_info["name"]); ?>">
    </div>
    <div class="control">
      <label for="bank_name">银行</label>
      <input name="bank_name" id="bank_name" type="text" class="input" placeholder="请输入银行名" value="<?php echo ($bank_card_info["bank_name"]); ?>">
    </div>
    <div class="control">
      <label for="card_no">银行卡号</label>
      <input name="card_no" id="card_no" type="text" class="input" placeholder="请填写银行卡号" value="<?php echo ($bank_card_info["card_no"]); ?>">
    </div>
    <div class="control">
      <label for="address">开户地址</label>
      <input name="address" id="address" type="text" class="input" placeholder="请填写开户地址省\市\县信息" value="<?php echo ($bank_card_info["address"]); ?>">
    </div>
    <div class="control">
      <label for="branch_name">开户行</label>
      <input name="branch_name" id="branch_name" type="text" class="input" placeholder="如：朝阳区支行" value="<?php echo ($bank_card_info["branch_name"]); ?>">
    </div>
    <div class="control">
      <button type="button" class="btn primary submit-btn">提交</button>
    </div>
  </form>
</div>
<script>
$(function(){
  $('.submit-btn').on('click', function(){
    var bank_name = $('#bank_name').val(); 
    if (bank_name  == '') {
      var notice = new $.Display({
        display: 'messager',
        content: '未填写银行名',
        placement: 'top-center',
        type: 'danger'
      }); 
      notice.show();
      return false;
    }
    var card_no = $('#card_no').val(); 
    if (card_no  == '') {
      var notice = new $.Display({
        display: 'messager',
        content: '未填写银行卡号',
        placement: 'top-center',
        type: 'danger'
      }); 
      notice.show();
      return false;
    }
    var name = $('#name').val(); 
    if (name  == '') {
      var notice = new $.Display({
        display: 'messager',
        content: '未填写持卡人姓名',
        placement: 'top-center',
        type: 'danger'
      }); 
      notice.show();
      return false;
    }
    var address = $('#address').val(); 
    if (address  == '') {
      var notice = new $.Display({
        display: 'messager',
        content: '未填写开户地址',
        placement: 'top-center',
        type: 'danger'
      }); 
      notice.show();
      return false;
    }
    var branch_name = $('#branch_name').val(); 
    if (branch_name  == '') {
      var notice = new $.Display({
        display: 'messager',
        content: '未填写开户行',
        placement: 'top-center',
        type: 'danger'
      }); 
      notice.show();
      return false;
    }
    $.ajax({
      url: '/wap/user/bank_info_edit',
      type: 'post',
      dataType: 'json',
      data: {'bank_name': bank_name, 'card_no': card_no, 'name': name, 'address': address, 'branch_name': branch_name},
      success: function(res) {
        if (res.status == 1) {
          var notice = new $.Display({
            display: 'messager',
            content: '设置成功',
            placement: 'top-center',
            type: 'success'
          }); 
          notice.show();
        } else {
          var notice = new $.Display({
            display: 'messager',
            content: '设置失败',
            placement: 'top-center',
            type: 'danger'
          }); 
          notice.show();
        }
        location.href="/wap/user/bank_info";
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