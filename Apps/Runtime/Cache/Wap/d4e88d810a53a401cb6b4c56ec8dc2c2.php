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
      <label for="packageType">省</label>
      <div class="select">
        <select name="province" id="province">
          <?php if(is_array($province_list)): foreach($province_list as $key=>$province): ?><option value="<?php echo ($province['id']); ?>" <?php if($address_info["province"] == $province.id): ?>selected<?php endif; ?>><?php echo ($province['name']); ?></option><?php endforeach; endif; ?>
        </select>
      </div>
    </div>
    <div class="control">
      <label for="packageType">市</label>
      <div class="select">
        <select name="city" id="city">
          <?php if(is_array($city_list)): foreach($city_list as $key=>$city): ?><option value="<?php echo ($city['id']); ?>" <?php if($address_info["city"] == $city.id): ?>selected<?php endif; ?>><?php echo ($city['name']); ?></option><?php endforeach; endif; ?>
        </select>
      </div>
    </div>
    <div class="control">
      <label for="packageType">县</label>
      <div class="select">
        <select name="county" id="county">
          <?php if(is_array($county_list)): foreach($county_list as $key=>$county): ?><option value="<?php echo ($county['id']); ?>" <?php if($address_info["county"] == $county.id): ?>selected<?php endif; ?>><?php echo ($county['name']); ?></option><?php endforeach; endif; ?>
        </select>
      </div>
    </div>
    <div class="control">
      <label for="address">详细地址</label>
      <input name="address" id="address" type="text" class="input" placeholder="街道、门牌号" value="<?php echo ($address_info["address"]); ?>"/>
    </div>
    <div class="control">
      <label for="name">联系人</label>
      <input name="name" id="name" type="text" class="input" placeholder="请填写收件人" value="<?php echo ($address_info["name"]); ?>"/>
    </div>
    <div class="control">
      <label for="mobile">联系电话</label>
      <input name="mobile" id="mobile" type="text" class="input" placeholder="请填写联系方式" value="<?php echo ($address_info["mobile"]); ?>"/>
    </div>
    <div class="control">
      <button type="button" class="btn primary submit-btn">提交</button>
    </div>
  </form>
</div>
<script>
$(function(){
  $('#province').on('change', function(){
    var province = $('#province').val(); 
    $.ajax({
      url: '/wap/user/get_city_list',
      type: 'post',
      dataType: 'json',
      data: {'province': province},
      success: function(res) {
        reset_county();
        var html = '<option value="0">--请选择市信息--</option>';
        $.each(res.city_list, function(idx, obj) {
          html += '<option value="' + obj.id + '">' + obj.name + '</option>';
        })
        $('#city').html(html);
      } 
    });
  });
  $('#city').on('change', function(){
    var city = $('#city').val();
    $.ajax({
      url: '/wap/user/get_county_list',
      type: 'post',
      dataType: 'json',
      data: {'city': city},
      success: function(res) {
        var html = '<option value="0">--请选择县信息--</option>';
        $.each(res.county_list, function(idx, obj) {
          html += '<option value="' + obj.id + '">' + obj.name + '</option>';
        })
        $('#county').html(html);
      }
    });
  })

  function reset_city()
  {
    var html = '<option value="0">--请选择市信息--</option>';
    $('#city').html(html);
  }

  function reset_county()
  {
    var html = '<option value="0">--请选择县信息--</option>';
    $('#county').html(html);
  }

  $('.submit-btn').on('click', function(){
    var province = $('#province').val(); 
    if (province == 0) {
      var notice = new $.Display({
        display: 'messager',
        content: '未选择省信息',
        placement: 'top-center',
        type: 'danger'
      }); 
      notice.show();
      return false;
    }
    var city = $('#city').val();
    if (city == 0) {
      var notice = new $.Display({
        display: 'messager',
        content: '未选择市信息',
        placement: 'top-center',
        type: 'danger'
      }); 
      notice.show();
      return false;
    }
    var county = $('#county').val();
    if (county == 0) {
      var notice = new $.Display({
        display: 'messager',
        content: '未选择县信息',
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
        content: '未填写详细地址',
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
        content: '未填写联系人',
        placement: 'top-center',
        type: 'danger'
      }); 
      notice.show();
      return false;
    }
    var mobile = $('#mobile').val();
    if (mobile  == '') {
      var notice = new $.Display({
        display: 'messager',
        content: '未填写联系电话',
        placement: 'top-center',
        type: 'danger'
      }); 
      notice.show();
      return false;
    }
    $.ajax({
      url: '/wap/user/address_edit',
      type: 'post',
      dataType: 'json',
      data: {'province': province, 'city': city, 'county': county, 'address': address, 'name': name, 'mobile': mobile},
      success: function(res) {
        location.href = '/wap/user/address_info';
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