<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>订单管理</title>
    
    <link href="/Public/Tool/hui/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/Public/Tool/hui/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Tool/hui/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/Public/Tool/hui/static/h-ui.admin/css/style.css" />
    <link href="/Public/Tool/hui/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Tool/hui/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Tool/hui/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Tool/dataTables/css/jquery.dataTables_themeroller.css" rel="stylesheet" type="text/css" />
    
    
    <script type="text/javascript" src="/Public/Tool/hui/lib/jquery/1.9.1/jquery.min.js"></script> 
    <script type="text/javascript" src="/Public/Tool/hui/static/h-ui/js/H-ui.min.js"></script>
    <script type="text/javascript" src="/Public/Tool/hui/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="/Public/Tool/hui/static/h-ui.admin/js/H-ui.admin.js"></script>
    <script type="text/javascript" src="/Public/Tool/dataTables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/Public/Tool/qrcode.min.js"></script>
    <script type="text/javascript" src="/Public/Tool/My97DatePicker/WdatePicker.js"></script>
    
  <yhead>
  <body>
    
<nav class="breadcrumb">
  <i class="Hui-iconfont">&#xe67f;</i> <?php echo ($bread["s1"]); ?> 
  <span class="c-gray en">&gt;</span> <?php echo ($bread["s2"]); ?> 
  <span class="c-gray en">&gt;</span> <?php echo ($bread["s3"]); ?> 
  <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" >
    <i class="Hui-iconfont">&#xe68f;</i>
  </a>
</nav>

<div class="page-container">
  <p class="f-20 text-success">欢迎使用 admin v1.0(bate) 后台</p>
  <table class="table table-border table-bordered table-bg">
    <tr>
      <td>我的分享邀请码</td>
      <td>
        <div id="qrcode"></div>
      </td>
    </tr>
    <tr>
      <td>邀请码短链接</td>
      <td><?php echo ($short_link); ?></td>
    </tr>
  </table>
  <table class="table table-border table-bordered table-bg mt-20">
    <thead>
      <tr><th colspan="2">注册用户统计</th></tr>
    </thead>
    <tbody>
      <tr>
        <td>总注册用户</td>
        <td><?php echo ($count_1); ?></td>
      </tr>
      <tr>
        <td>今日新增注册用户</td>
        <td><?php echo ($count_2); ?></td>
      </tr>
      <tr>
        <td>昨日新增注册用户</td>
        <td><?php echo ($count_3); ?></td>
      </tr>
      <tr>
        <td>本周新增注册用户</td>
        <td><?php echo ($count_4); ?></td>
      </tr>
      <tr>
        <td>本月新增注册用户</td>
        <td><?php echo ($count_5); ?></td>
      </tr>
    </tbody>
  </table>
</div>
<script type="text/javascript">
new QRCode(document.getElementById("qrcode"), "<?php echo ($agent_link); ?>");
</script>

    
    
  </body>
</html>