<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($title); ?></title>
    
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
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>用户名</th>
        <th>电话</th>
        <th>银行名</th>
        <th>卡号</th>
        <th>持卡人姓名</th>
        <th>开户行地址</th>
        <th>开户行</th>
        <th>省</th>
        <th>市</th>
        <th>县</th>
        <th>详细地址</th>
        <th>联系电话</th>
      </tr>
    </thead>
    <tr>
      <td><?php echo ($member_info['id']); ?></td>
      <td><?php echo ($member_info['nickname']); ?></td>
      <td><?php echo ($member_info['mobile']); ?></td>
      <td><?php echo ($bank_card_info['bank_name']); ?></td>
      <td><?php echo ($bank_card_info['card_no']); ?></td>
      <td><?php echo ($bank_card_info['name']); ?></td>
      <td><?php echo ($bank_card_info['address']); ?></td>
      <td><?php echo ($bank_card_info['branch_name']); ?></td>
      <td><?php echo ($location['province']); ?></td>
      <td><?php echo ($location['city']); ?></td>
      <td><?php echo ($location['county']); ?></td>
      <td><?php echo ($location['address']); ?></td>
      <td><?php echo ($location['mobile']); ?></td>
    </tr>
  </table>
</div>

    
    
  </body>
</html>