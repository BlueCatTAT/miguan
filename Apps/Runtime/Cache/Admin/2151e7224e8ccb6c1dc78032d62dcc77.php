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
    <script type="text/javascript" src="/Public/Tool/Hui/lib/layer/2.4/layer.js"></script>
    <title>Index</title>
  </head>
  <body>
    
<div class="page-container">
  <table class="table table-border table-bordered table-bg">
    <thead>
      <tr><th>ID</th><th>订单号</th><th>股票</th><th>买入价</th><th>止损</th><th>止盈</th><th>操作</th></tr>
    </thead>
    <tbody>
    <?php if(is_array($order_list)): foreach($order_list as $key=>$item): ?><tr>
      <td><?php echo ($item['id']); ?></td>
      <td><?php echo ($item['order_sn']); ?></td>
      <td><?php echo ($item['name']); ?></td>
      <td><?php echo ($item['buy_price']); ?></td>
      <td><?php echo ($item['endloss']); ?></td>
      <td><?php echo ($item['endprofit']); ?></td>
      <td>
        <a href="<?php echo U('/admin/order/order_info', array('id' => $item['id']));?>">详情</a>
      </td>
    </tr><?php endforeach; endif; ?>
    </tbody>
  </table>
  <div class="pager"><?php echo ($page); ?></div>
</div>

  </body>
</html>