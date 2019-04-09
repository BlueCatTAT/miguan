<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
      <script type="text/javascript" src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
      <script type="text/javascript" src="http://libs.useso.com/js/respond.js/1.4.2/respond.min.js"></script>
      <script type="text/javascript" src="http://cdn.bootcss.com/css3pie/2.0beta1/PIE_IE678.js"></script>
    <![endif]-->
    <link type="text/css" rel="stylesheet" href="/Public/Tool/Hui/static/h-ui/css/H-ui.css"/>
    <link type="text/css" rel="stylesheet" href="/Public/Tool/Hui/static/h-ui.admin/css/H-ui.admin.css"/>
    <link type="text/css" rel="stylesheet" href="/Public/Tool/Hui/lib/Hui-iconfont/1.0.8/iconfont.css"/>
    <!--[if IE 7]>
      <link href="http://www.bootcss.com/p/font-awesome/assets/css/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <script type="text/javascript" src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js"></script> 
    <script type="text/javascript" src="/Public/Tool/Hui/static/h-ui/js/H-ui.js"></script> 
    <script type="text/javascript" src="/Public/Tool/Hui/static/h-ui.admin/js/H-ui.admin.js"></script>
    <script type="text/javascript" src="/Public/Tool/Hui/lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="/Public/Tool/Hui/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/Public/Tool/Hui/lib/laypage/1.2/laypage.js"></script>
    <title>Index</title>
  </head>
  <body>
    
<div class="page-container">
  <table class="table table-border table-bordered table-bg table-sort">
    <thead>
      <tr>
        <th>客户订单号</th>
        <th>系统订单号</th>
        <th>商户号</th>
        <th>订单金额</th>
        <th>费率</th>
        <th>手续费</th>
        <th>状态</th>
        <th>订单创建时间</th>
        <th>订单支付时间</th>
      </tr>
    </thead>
    <tbody>
      <?php if(is_array($list)): foreach($list as $key=>$item): ?><tr>
        <td><?php echo ($item['MerBillNo']); ?></td>
        <td><?php echo ($item['MainMerbillNo']); ?></td>
        <td><?php echo ($item['Attach']); ?></td>
        <td><?php echo ($item['Amount']); ?></td>
        <td><?php echo ($item['Rate']); ?></td>
        <td><?php echo ($item['Cost']); ?></td>
        <td>
        <?php if($item['status'] == 0): ?>未支付
        <?php elseif($item['status'] == 1): ?>
        已支付<?php endif; ?>
        </td>
        <td><?php echo (date("Y-m-d H:i:s", $item['create_time'])); ?></td>
        <td><?php echo (date("Y-m-d H:i:s", $item['pay_time'])); ?></td>
      </tr><?php endforeach; endif; ?>
    </tbody>
  </table>
  <div>
    <div id="pager"></div>
  </div>
</div>
<script>
$('.table-sort').dataTable({
  "bStateSave": true,//状态保存
  'ordering':false,
});
</script>

  </body>
</html>