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
    
<style type="text/css">

.cell_main_price{
  display:flex; flex-direction:column; justify-content:center; text-align:center; padding:5px;
  background:#ffffff;
  margin:5px;
}
        .nav_icon{display:flex; flex-direction:column; justify-content:center; text-align:center; width:100%;}
        .nav_icon_c{display: flex; justify-content:center; margin:0 auto; color:#ffffff;}
        .avatar-lg{
          width:2.3rem;
          height:2.3rem;
        }
</style>
<div class="section" style="margin-top:10px;">
  <div class="row">
    <div class="cell" style="text-align:center; justify-content:center;">
      <a href="/wap/stock/chose_1">
        <div class="nav_icon">
          <div class="circle avatar avatar-lg nav_icon_c" style="background: linear-gradient(#FFE3DF, #FA4E3A); border:2px solid #FFBEB4;">
            <i class="icon icon-server"></i>
          </div>
          <div style="margin-top:5px;"><p>掌经热股</p></div>
        </div>
      </a>
    </div>
    <div class="cell" style="text-align:center; justify-content:center;">
      <a href="/wap/stock/chose_2">
        <div class="nav_icon">
          <div class="circle avatar avatar-lg nav_icon_c" style="background: linear-gradient(#FFF1D4, #FFAC00); border:2px solid #FFE2A8;">
            <i class="icon icon-window"></i>
          </div>
          <div style="margin-top:5px;"><p>事件驱动</p></div>
        </div>
      </a>
    </div>
    <div class="cell" style="text-align:center; justify-content:center;">
      <a href="/wap/stock/chose_3">
        <div class="nav_icon">
          <div class="circle avatar avatar-lg nav_icon_c" style="background: linear-gradient(#DEF6FF, #00BDD2); border:2px solid #B1EAFF;">
            <i class="icon icon-newspaper-o"></i>
          </div>
          <div style="margin-top:5px;"><p>条件选股</p></div>
        </div>
      </a>
    </div>
    <div class="cell" style="text-align:center; justify-content:center;">
      <a href="/wap/stock/chose_4">
        <div class="nav_icon">
          <div class="circle avatar avatar-lg nav_icon_c" style="background: linear-gradient(#F7ECFF, #8F57BA); border:2px solid #E5BDFF;">
            <i class="icon icon-calendar"></i>
          </div>
          <div style="margin-top:5px;"><p>策略热榜</p></div>
        </div>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="cell" style="text-align:center; justify-content:center;">
      <a href="/wap/stock/chose_5">
        <div class="nav_icon">
          <div class="circle avatar avatar-lg nav_icon_c" style="background: linear-gradient(#B1F0C2, #009A34); color:#ffffff; border:2px solid #B1F0C2;">
            <i class="icon icon-group"></i>
          </div>
          <div style="margin-top:5px;"><p>涨停预测</p></div>
        </div>
      </a>
    </div>
    <div class="cell" style="text-align:center; justify-content:center;">
      <a href="/wap/stock/chose_6">
        <div class="nav_icon">
          <div class="circle avatar avatar-lg nav_icon_c" style="background: linear-gradient(#F9EBE0, #C6763C); color:#ffffff; border:2px solid #F2D6BF;">
            <i class="icon icon-certificate"></i>
          </div>
          <div style="margin-top:5px;"><p>量化选股</p></div>
        </div>
      </a>
    </div>
    <div class="cell" style="text-align:center; justify-content:center;">
      <a href="/wap/stock/chose_7">
        <div class="nav_icon">
          <div class="circle avatar avatar-lg nav_icon_c" style="background: linear-gradient(#DEF6FF, #3672FF); color:#ffffff; border:2px solid #B1EAFF;">
            <i class="icon icon-trophy"></i>
          </div>
          <div style="margin-top:5px;"><p>价值挖掘</p></div>
        </div>
      </a>
    </div>
    <div class="cell" style="text-align:center; justify-content:center;">
      <a href="/wap/stock/chose_8">
        <div class="nav_icon">
          <div class="circle avatar avatar-lg nav_icon_c" style="background: linear-gradient(#B1F0C2, #009A34); color:#ffffff; border:2px solid #B1F0C2;">
            <i class="icon icon-flag-alt"></i>
          </div>
          <div style="margin-top:5px;"><p>长线牛股</p></div>
        </div>
      </a>
    </div>
  </div>
</div>
<div class="section" style="margin-top:10px; padding:10px;">
  <div class="lead">今日精选</div>
  <hr/>
  <div style="color:#e53d1c; background:#ffe5e0; padding:10px 30px; font-size:0.5rem;">
    <span>提示！</span>推荐股票为第三方机构模型结果，仅供参考，不作为入市依据，据此入市，风险自担
  </div>
  <div class="row" style="margin-top:10px;">
    <div class="cell-3">
      <div class="avatar circle red outline avatar-xl">
        <div style="font-size:0.8rem;">62.19%</div>
        <div style="font-size:0.5rem;">胜率</div>
      </div>
    </div>
    <div class="cell-9" style="flex-direction:column;">
      <div style="font-size:0.9rem;">掌经金股</div>
      <div class="small text-gray">1天持股平均涨幅 <span style="font-size:0.8rem;">1.10%</span></div>
      <div class="small text-gray">1.00万人订阅|掌经策略 2018-08-02</div>
    </div>
  </div>
  <hr/>
  <div class="row small" style="text-align:center;">
    <?php if(is_array($list)): foreach($list as $key=>$item): ?><div class="cell-4" style="flex-direction:column;">
      <a href="<?php echo U('/wap/stock/detail', ['code' => $item['code']]);?>">
      <div><?php echo ($item['name']); ?></div>
      <?php if($item['netChangeRatio'] > 0): ?><div class="text-red"><?php echo (round($item['netChangeRatio'],2)); ?>%</div>
      <?php else: ?>
      <div class="text-green"><?php echo (round($item['netChangeRatio'],2)); ?>%</div><?php endif; ?>
      </a>
    </div><?php endforeach; endif; ?>
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