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
  <div class="cl pd-5 bg-1 bk-gray mt-20">
    <a href="<?php echo U('/admin/ebp/account_add');?>" class="btn btn-success"><i class="Hui-iconfont Hui-iconfont-add"></i> 开户</a>
  </div>
  <table class="table table-border table-bordered table-bg mt-20">
    <thead>
      <tr>
        <th>ID</th>
        <th>商户号</th>
        <th>今日入金</th>
        <th>昨日入金</th>
        <th>账户余额</th>
        <th>身份证</th>
        <th>用户名</th>
        <th>电话</th>
        <th>费率</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
    <?php if(is_array($list)): foreach($list as $key=>$item): ?><tr>
      <td><?php echo ($item['id']); ?></td>
      <td><a class="c-primary" href="<?php echo U('/admin/ebp/account_info', array('id' => $item['id']));?>"><?php echo ($item['customerCode']); ?></a></td>
      <td><?php echo ($item['today_amout']); ?></td>
      <td><?php echo ($item['yesterday_amout']); ?></td>
      <td><?php echo ($item['balance']); ?></td>
      <td><?php echo ($item['identityNo']); ?></td>
      <td><?php echo ($item['userName']); ?></td>
      <td><?php echo ($item['mobiePhoneNo']); ?></td>
      <td><?php echo ($item['rate']); ?></td>
      <td>
        <a class="c-primary" href="<?php echo U('/admin/ebp/account_view', array('id' => $item['id']));?>">开户结果查询</a> 
        <a class="c-error account-btn" href="javascript:;" data-id="<?php echo ($item['id']); ?>">删除</a> 
      </td>
    </tr><?php endforeach; endif; ?>
    </tbody>
  </table>
</div>
<script>
$('.account-btn').on('click', function(){
  var id = $(this).data('id');
  layer.confirm('确认要删除吗？',function(index){
    $.ajax({
      type: 'POST',
      url: "<?php echo U('/admin/ebp/account_del');?>",
      dataType: 'json',
      data: {'id': id},
      success: function(data){
        window.location.reload()
      },
      error:function(data) {
        console.log(data.msg);
      },
    });
  });
});
</script>

  </body>
</html>