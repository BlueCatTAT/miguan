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
<script src="/Public/Tool/mzui/js/mzui.min.js"></script>
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
    
<form action="/wap/stock/search" method="post" class="box">
  <div class="control flex">
    <input name="query" type="text" class="input" placeholder="输入搜索股票" value="<?php echo ($query); ?>"/>
    <button type="submit" class="btn primary" style="min-width:auto;"><i class="icon-location-arrow"></i> 搜索 </button>
  </div>
</form>
<div class="section" style="padding:10px;">
  <div class="row">
  <?php if(is_array($hot_list)): foreach($hot_list as $key=>$item): ?><div class="cell-4">
    <a href="<?php echo U('/wap/stock/detail', ['code' => ($item['exchange'].$item['stockCode'])]);?>" style="width:100%;">
    <div style="flex-direction:column; border:1px solid #cccccc; border-radius:5px; width:100%; text-align:center; padding:10px;">
      <div><?php echo ($item['stockName']); ?></div> 
      <div class="text-gray small"><?php echo ($item['stockCode']); ?></div> 
      <?php if($item['netChange'] > 0): ?><div class="text-red"><?php echo (round($item['close'],2)); ?></div> 
      <div class="text-red">
        <span><?php echo (round($item['netChange'],2)); ?></span>
        <span><?php echo (round($item['netChangeRatio'],2)); ?>%</span>
      </div> 
      <?php else: ?>
      <div class="text-green"><?php echo (round($item['close'],2)); ?></div> 
      <div class="text-green">
        <span><?php echo (round($item['netChange'],2)); ?></span>
        <span><?php echo (round($item['netChangeRatio'],2)); ?>%</span>
      </div><?php endif; ?>
    </div>
    </a>
  </div><?php endforeach; endif; ?>
  </div>
</div>
<div class="section" style="padding:10px; margin-bottom:2rem;">
  <table class="table">
    <?php if(is_array($search_res)): foreach($search_res as $key=>$item): ?><tr>
      <td>
        <a href="<?php echo U('/wap/stock/detail', ['code' => ($item['exchange'].$item['stockCode'])]);?>">
        <div><?php echo ($item['stockName']); ?></div>
        <div><?php echo ($item['stockCode']); ?></div>
        </a>
      </td>
      <td><?php echo (round($item['close'],2)); ?></td>
      <?php if($item['netChange'] > 0): ?><td class="text-red"><?php echo (round($item['netChange'],2)); ?></td>
      <?php else: ?>
      <td class="text-green"><?php echo (round($item['netChange'],2)); ?></td><?php endif; ?>
      <?php if($item['netChange'] > 0): ?><td class="text-red"><?php echo (round($item['netChangeRatio'],2)); ?>%</td>
      <?php else: ?>
      <td class="text-green"><?php echo (round($item['netChangeRatio'],2)); ?>%</td><?php endif; ?>
      <td><a href="javascript:;" onclick="collect_add(<?php echo ($item['exchange']); echo ($item['stockCode']); ?>)"><i class="icon icon-expand-alt text-red"></i></a></td>
    </tr><?php endforeach; endif; ?>
  </table>
</div>
<script>
function collect_add(code)
{
  $.ajax({
    url: '/wap/user/collect_add',
    type: 'post',
    dataType: 'json',
    data: {'code': code},
    success: function(res) {
      alert('添加成功');
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
  <a href="/wap/stock/search" <?php if($current == policy): ?>class="text-danger"<?php endif; ?> style="display:flex; flex-direction:column; justify-content:center;">
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