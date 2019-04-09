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
    
<div class="section" style="padding:10px;">
  <div class="lead">我的资产<a href="" class="pull-right btn danger btn-sm">马上充值</a></div>
  <hr/>
  <div class="row">
    <div class="cell-6" style="flex-direction:column;">
      <h3 >总资产</h3>
      <p><?php echo ($user_info['balance'] + $total_fee); ?></p>
    </div>
    <div class="cell-6" style="flex-direction:column;">
      <h3>昨日收益</h3>
      <p>0</p>
    </div>
  </div>
  <div class="row">
    <div class="cell-6">
      <span class='info' style='padding:0 10px;'>持仓市值</span>
      <span class='text-red' style="padding:0 10px;"><?php echo ($total_price); ?></span>
    </div>
    <div class="cell-6">
      <span class='warning' style='padding:0 10px;'>持仓盈亏</span>
      <span class='text-red' style="padding:0 10px;">0</span>
    </div>
    <div class="cell-6">
      <span class='primary' style='padding:0 10px;'>可用资金</span>
      <span class='text-red' style="padding:0 10px;"><?php echo ($user_info['balance']); ?></span>
    </div>
    <div class="cell-6">
      <span class='success' style='padding:0 10px;'>冻结资产</span>
      <span class='text-red' style="padding:0 10px;"><?php echo ($total_fee); ?></span>
    </div>
  </div>
</div>
<div class="section" style="padding:10px;">
  <div class="lead">策略持仓</div>
  <hr/>
  <a href="/wap/stock/his" class="btn danger outline block">创建策略</a>
  <hr/>
  <?php if(is_array($order_list)): foreach($order_list as $key=>$order): ?><div class="row">
    <div class="cell-6"><?php echo ($order['name']); ?> <span class="text-gray"><?php echo ($order['code']); ?></span></div>
    <div class="cell-6">5.41 -32% <a style="position: absolute; right:10px;" data-display data-target="#box-<?php echo ($order['id']); ?>" data-trigger-method="toggle"><i class="icon icon-plus-sign text-red icon-2x"></i></a></div>
    <div class="cell-6">买入价 : <?php echo ($order['buy_price']); ?></div>
    <div class="cell-6">成本价 : <?php echo ($order['buy_price']); ?></div>
    <div class="cell-6">浮盈 : 5.3</div>
    <div class="cell-6">盈亏 : 5.3</div>
    <div class="cell-6">已持仓3天</div>
    <div class="cell-6">买入时间 : <?php echo (date("m-d H:i", $order['created_time'])); ?></div>
  </div>
  <div class="row container inverse has-padding small hidden" id="box-<?php echo ($order['id']); ?>">
    <div class="cell-4">信用金 <span class="has-padding-h text-warning"><?php echo ($order['fee']); ?></span></div>
    <div class="cell-4">止盈价 <span class="has-padding-h text-red"><?php echo ($order['endprofit']); ?></span></div>
    <div class="cell-4">上涨 <span class="has-padding-h text-red"><?php echo ($order['endprofit_ratio'] * 100); ?>%</span> 止盈</div>
    <div class="cell-4">股票数 <span class="has-padding-h text-warning"><?php echo ($order['volume']); ?><span></div>
    <div class="cell-4">止损价 <span class="has-padding-h text-green"><?php echo ($order['endloss']); ?><span></div>
    <div class="cell-4">下跌 <span class="has-padding-h text-green"><?php echo ($order['endloss_ratio'] * 100); ?>%</span> 止损</div>
    <div class="cell-4">手续费 <span class="has-padding-h text-warning"><?php echo ($order['servicecharge']); ?></span></div>
    <div class="cell-4">管理费 <span class="has-padding-h text-warning"><?php echo ($order['managecharge']); ?></span></div>
    <div class="cell-4">强平价 <span class="has-padding-h text-warning"><?php echo ($order['f_price']); ?></span></div>
    <div class="cell-12" style="justify-content:flex-end;">
      <button class="btn danger">卖出</button>
      <button class="btn warning" data-display data-backdrop="true" data-target="#endloss_<?php echo ($order['id']); ?>" data-placement="bottom">修改止损</button>
      <button class="btn warning" data-display data-backdrop="true" data-target="#endprofit_<?php echo ($order['id']); ?>" data-placement="bottom">修改止盈</button>
    </div>
  </div>
  <div id="endloss_<?php echo ($order['id']); ?>" class="affix dock-bottom modal hidden">
    <div class="heading">
      <div class="title"><strong>修改止损</strong></div>
      <nav class="nav"><a data-dismiss="display"><i class="icon-remove muted"></i></a></nav>
    </div>
    <div class="content article box">
      <div class="control">
        <label>当前止损价</label>
        <input type="text" value="<?php echo ($order['endloss']); ?>" class="input disabled"/>
      </div>
      <div class="control">
        <label>修改止损价</label>
        <input type="text" value="<?php echo ($order['endloss']); ?>" class="input endloss"/>
      </div>
      <div class="control">
        <button type="button" class="btn block warning endloss_btn" onclick="setEndloss(<?php echo ($order['id']); ?>)">提交</button>
      </div>
    </div>
  </div>
  <div id="endprofit_<?php echo ($order['id']); ?>" class="affix dock-bottom modal hidden">
    <div class="heading">
      <div class="title"><strong>修改止盈</strong></div>
      <nav class="nav"><a data-dismiss="display"><i class="icon-remove muted"></i></a></nav>
    </div>
    <div class="content article box">
      <div class="control">
        <label>当前止盈价</label>
        <input type="text" value="<?php echo ($order['endloss']); ?>" class="input disabled"/>
      </div>
      <div class="control">
        <label>修改止盈价</label>
        <input type="number" value="<?php echo ($order['endloss']); ?>" class="input endprofit"/>
      </div>
      <div class="control">
        <button type="button" class="btn block warning" onclick="setEndprofit(<?php echo ($order['id']); ?>)">提交</button>
      </div>
    </div>
  </div><?php endforeach; endif; ?>
</div>
<script>
function setEndloss(order_id) {
  var p = $('#endloss_'+order_id).find('.endloss').val();
  $.ajax({
    url: '/wap/policy/set_endloss',
    type: 'post',
    dataType: 'json',
    data:{'price': p, 'order_id': order_id},
    success: function(res) {
      location.reload();
    } 
  });
} 
function setEndprofit(order_id) {
  var p = $('#endprofit_'+order_id).find('.endprofit').val();
  $.ajax({
    url: '/wap/policy/set_endprofit',
    type: 'post',
    dataType: 'json',
    data:{'price': p, 'order_id': order_id},
    success: function(res) {
      location.reload();
    } 
  });
} 
</script>


    <!-- /主体 -->
    <!-- 底部 -->
    
<nav class="nav nav-auto affix dock-bottom justified">
  <a href="/" <?php if($current == home): ?>class="text-danger"<?php endif; ?> style="display:flex; flex-direction:column; justify-content:center;">
    <span><i class="icon icon-home"></i></span>
    <span>首页</span>
  </a>
  <a href="/wap/policy/index" <?php if($current == policy): ?>class="text-danger"<?php endif; ?> style="display:flex; flex-direction:column; justify-content:center;">
    <span><i class="icon icon-expand-full"></i></span>
    <span>策略</span>
  </a>
  <a href="/wap/stock/chose" <?php if($current == stock): ?>class="text-danger"<?php endif; ?> style="display:flex; flex-direction:column; justify-content:center;">
    <span><i class="icon icon-search"></i></span>
    <span>选股</span>
  </a>
  <a href="/wap/collect/index" <?php if($current == collect): ?>class="text-danger"<?php endif; ?> style="display:flex; flex-direction:column; justify-content:center;">
    <span><i class="icon icon-check-board"></i></span>
    <span>自选</span>
  </a>
  <a href="/wap/user/index" <?php if($current == user): ?>class="text-danger"<?php endif; ?> style="display:flex; flex-direction:column; justify-content:center;">
    <span><i class="icon icon-user"></i></span>
    <span>我的</span>
  </a>
</nav>


    </div>
  </body>
</html>