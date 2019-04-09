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
  <table class="table table-hover table-responsive" id="datalist">
    <thead>
      <tr>
        <th>用户编号ID</th>
        <th>用户名</th>
        <th>电话</th>
        <th>注册时间</th>
        <!--
        <th>操作</th>
        -->
      </tr>
    </thead>
    <?php if(is_array($list)): foreach($list as $key=>$item): ?><tr>
      <td>DB_<?php echo ($item['id']); ?></td>
      <td><?php echo ($item['nickname']); ?></td>
      <td><?php echo ($item['mobile']); ?></td>
      <td><?php echo (date("Y-m-d H:i:s",$item['addtime'])); ?></td>
      <!--
      <td>
        <a href="<?php echo U('/admin/member/member_del', array('id' => $item['id']));?>" class="btn btn-danger btn-xs">删除</a>
      </td>
      -->
    </tr><?php endforeach; endif; ?>
  </table>
</div>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
  $('#datalist').dataTable({
    "iDisplayLength":20,
    "aLengthMenu":[20, 50, 100, 200],
    "bStateSave": true,
    "sPaginationType" : "full_numbers",
    "ordering": false,
    "oLanguage" : {
      "sLengthMenu": "每页显示 _MENU_ 条记录",
      "sZeroRecords": "抱歉， 没有找到",
      "sInfo": "从 _START_ 到 _END_ /共 _TOTAL_ 条数据",
      "sInfoEmpty": "没有数据",
      "sInfoFiltered": "(从 _MAX_ 条数据中检索)",
      "sZeroRecords": "没有检索到数据",
      "sSearch": "搜索:",
      "oPaginate": {
        "sFirst": "首页",
        "sPrevious": "前一页",
        "sNext": "后一页",
        "sLast": "尾页"
      }
    }
  });
} );
</script>

    
    
  </body>
</html>