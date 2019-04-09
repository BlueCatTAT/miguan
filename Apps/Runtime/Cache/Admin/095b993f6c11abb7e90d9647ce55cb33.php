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
  <form action="#" method="post" class="f-20 text-success">
    <div class="text-c"> 日期范围：
      <input type="text" name="s_stime" onClick="WdatePicker({dateFmt:'yyyy-MM-dd'})" class="input-text Wdate" style="width:120px;" value="<?php echo ($s_stime); ?>">
      -
      <input type="text" name="s_etime" onClick="WdatePicker({dateFmt:'yyyy-MM-dd'})" class="input-text Wdate" style="width:120px;" value="<?php echo ($s_etime); ?>">
      微信名：
      <input type="text" name="s_nickname" class="input-text" style="width:120px;" value="<?php echo ($s_nickname); ?>">
      <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont"></i> 搜索</button>
    </div>
  </form>
  <div class="mt-20">
    <table class="table table-border table-bordered table-bg">
      <tr>
        <td>总单数：<?php echo ($total_count_1 + $total_count_2); ?></td> 
        <td>成功单数：<?php echo ($total_count_3_1 + $total_count_3_2); ?></td> 
        <td>失败单数：<?php echo ($total_count_4_1 + $total_count_4_2); ?></td> 
        <td>待开奖单数：<?php echo ($total_count_5_1 + $total_count_5_2); ?></td> 
      </tr>
      <tr>
        <td>总交易额：<?php echo (sprintf('%.2f', $total_fee/100)); ?></td> 
        <td>总中奖金额：<?php echo (sprintf('%.2f', $total_count_3_1 * 98 + $total_count_3_2 * 98)); ?></td> 
        <td>总兑换金额：<?php echo (sprintf('%.2f', $t_sale)); ?></td> 
        <td>总收益：<?php echo (sprintf('%.2f', $total_fee/100 - $t_sale )); ?></td> 
      </tr>
    </table>
  </div>
  <div class="mt-20">
    <table class="table table-hover table-responsive" id="datalist">
      <thead>
        <tr>
          <th>订单号</th>
          <th>商品名</th>
          <th>商品价格</th>
          <th>用户名</th>
          <th>电话</th>
          <th>购买类型</th>
          <th>购买数量</th>
          <th>购买总额</th>
          <th>兑奖金额</th>
          <th>付款状态</th>
          <th>开奖结果</th>
          <th>时间</th>
          <th>寄售状态</th>
        </tr>
      </thead>
      <?php if(is_array($list)): foreach($list as $key=>$item): ?><tr>
        <td><?php echo ($item['tradeno']); ?></td>
        <td><?php echo ($item['card_name']); ?></td>
        <td><?php echo (sprintf('%.2f', $item['price'])); ?></td>
        <td><a class="maincolor" href="<?php echo U('/admin/order/order_list', array('uid' => $item['uid']));?>"><?php echo ($item['nickname']); ?></a></td>
        <td><?php echo ($item['mobile']); ?></td>
        <td>
          <?php if($item['buy_type'] == 1): ?>单<?php endif; ?>
          <?php if($item['buy_type'] == 2): ?>双<?php endif; ?>
        </td>
        <td><?php echo ($item['num']); ?></td>
        <td><?php echo (sprintf('%.2f', $item['total_price']/100)); ?></td>
        <td>
          <?php if($item['res'] == 1): if($item['price'] == 28): ?>50<?php endif; ?>
          <?php if($item['price'] == 55): ?>100<?php endif; ?>
          <?php else: ?>
          0<?php endif; ?> 
        </td>
        <td>
          <?php if($item['status'] == 1): ?>已付款
          <?php else: ?>
          未付款<?php endif; ?>
        </td>
        <td>
          <?php if($item['res'] == 0): ?>等待开奖<?php endif; ?>
          <?php if($item['res'] == 1): ?>获胜<?php endif; ?>
          <?php if($item['res'] == 2): ?>失败<?php endif; ?>
        </td>
        <td><?php echo (date("m-d H:i:s",$item['addtime'])); ?></td>
        <?php if($item['res'] == 1): ?><td>
          <?php if($item['sale'] == 0): ?>未处理<?php endif; ?>
          <?php if($item['sale'] == 1): ?>申请寄售<?php endif; ?>
          <?php if($item['sale'] == 2): ?>申请邮寄<?php endif; ?>
          <?php if($item['sale'] == 100): ?>已寄售<?php endif; ?>
          <?php if($item['sale'] == 200): ?>已邮寄<?php endif; ?>
        </td>
        <?php else: ?>
        <td>
        </td><?php endif; ?>
      </tr><?php endforeach; endif; ?>
    </table>
  </div>
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