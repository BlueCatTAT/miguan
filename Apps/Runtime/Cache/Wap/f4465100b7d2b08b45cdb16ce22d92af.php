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
    
<div><img style="height:140px; width:100%;" src="http://m.cnzjcf.com/upload/20180122141901.jpg"/></div>
<div class="section" style="padding:10px; width:100%; overflow-x:scroll; overflow-y:hidden; white-space:nowrap">
  <?php if(is_array($user_list)): foreach($user_list as $key=>$item): ?><div style="text-align:center; display:inline-block; box-sizing:border-box; width:33%;">
    <div class="avatar avatar-xl circle space-sm">
      <img src="/Public/avatar.png" alt="">
    </div>
    <div><?php echo ($item['username']); ?></div>
    <div>总收益率：<?php echo ($item['t_r']); ?>%</div>
    <div>月收益率：<?php echo ($item['m_r']); ?>%</div>
    <div><a href="btn danger outline">取消订阅</a></div>
  </div><?php endforeach; endif; ?>
</div>
<div class="section" style="padding:10px;">
  <nav class="nav" data-display data-selector="a" data-show-single="true" data-active-class="active">
    <a class="active" data-target="#tab1">总收益</a>
    <a data-target="#tab2">日收益</a>
    <a data-target="#tab3">周收益</a>
    <a data-target="#tab4">月收益</a>
  </nav>
  <div>
    <div class="box primary in" id="tab1">
      <table class="table">
        <tbody>
          <?php if(is_array($user_list1)): foreach($user_list1 as $key=>$item): ?><tr>
            <td><?php echo ($key + 1); ?></td>
            <td>
              <div class="avatar circle space-sm">
                <img src="/Public/avatar.png" alt="">
              </div>
            </td>
            <td><?php echo ($item['username']); ?></td>
            <td>收益率：<?php echo ($item['t_r']); ?>%</td>
            <td><a href="">></a></td>
          </tr><?php endforeach; endif; ?>
        </tbody> 
      </table>
    </div>
    <div class="box red hidden" id="tab2">
      <table class="table">
        <tbody>
          <?php if(is_array($user_list2)): foreach($user_list2 as $key=>$item): ?><tr>
            <td><?php echo ($key + 1); ?></td>
            <td>
              <div class="avatar circle space-sm">
                <img src="/Public/avatar.png" alt="">
              </div>
            </td>
            <td><?php echo ($item['username']); ?></td>
            <td>收益率：<?php echo ($item['t_r']); ?>%</td>
            <td><a href="">></a></td>
          </tr><?php endforeach; endif; ?>
        </tbody> 
      </table>
    </div>
    <div class="box green hidden" id="tab3">
      <table class="table">
        <tbody>
          <?php if(is_array($user_list3)): foreach($user_list3 as $key=>$item): ?><tr>
            <td><?php echo ($key + 1); ?></td>
            <td>
              <div class="avatar circle space-sm">
                <img src="/Public/avatar.png" alt="">
              </div>
            </td>
            <td><?php echo ($item['username']); ?></td>
            <td>收益率：<?php echo ($item['t_r']); ?>%</td>
            <td><a href="">></a></td>
          </tr><?php endforeach; endif; ?>
        </tbody> 
      </table>
    </div>
    <div class="box hidden" id="tab4">
      <table class="table">
        <tbody>
          <?php if(is_array($user_list4)): foreach($user_list4 as $key=>$item): ?><tr>
            <td><?php echo ($key + 1); ?></td>
            <td>
              <div class="avatar circle space-sm">
                <img src="/Public/avatar.png" alt="">
              </div>
            </td>
            <td><?php echo ($item['username']); ?></td>
            <td>收益率：<?php echo ($item['t_r']); ?>%</td>
            <td><a href="">></a></td>
          </tr><?php endforeach; endif; ?>
        </tbody> 
      </table>
    </div>
  </div>
</div>


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