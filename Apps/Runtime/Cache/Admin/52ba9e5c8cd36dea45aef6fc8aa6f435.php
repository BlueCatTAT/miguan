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
      <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont"></i> 搜索</button>
    </div>
  </form>
  <div class="mt-20">
    <table class="table table-border table-bordered table-bg">
      <thead>
        <tr>
          <th>统计时间</th>
          <th>100元单数</th>
          <th>50元单数</th>
          <th>总单数</th>
          <th>收入总和</th>
          <th>中奖金额</th>
          <th>已兑换金额</th>
          <th>总收益</th>
          <th>手续费</th>
          <th>佣金</th>
        </tr>
      </thead>
      <?php if(is_array($list)): foreach($list as $key=>$item): ?><tr>
        <td><?php echo ($item["time_str"]); ?></td> 
        <td><?php echo ($item["num_1"]); ?></td> 
        <td><?php echo ($item["num_2"]); ?></td> 
        <td><?php echo ($item["num_3"]); ?></td> 
        <td><?php echo (sprintf('%.2f', $item["num_4"])); ?></td> 
        <td><?php echo ($item["num_5"]); ?></td> 
        <td><?php echo ($item["num_6"]); ?></td> 
        <td><?php echo (sprintf('%.2f', $item["num_7"])); ?></td> 
        <td><?php echo (sprintf('%.2f', $item["num_8"])); ?></td> 
        <td><?php echo (sprintf('%.2f', $item["num_9"])); ?></td> 
      </tr><?php endforeach; endif; ?>
      <tr>
        <td>总计</td>
        <td><?php echo ($t_num_1); ?></td>
        <td><?php echo ($t_num_2); ?></td>
        <td><?php echo ($t_num_3); ?></td>
        <td><?php echo (sprintf("%.2f", $t_num_4)); ?></td>
        <td><?php echo ($t_num_5); ?></td>
        <td><?php echo ($t_num_6); ?></td>
        <td><?php echo (sprintf("%.2f", $t_num_7)); ?></td>
        <td><?php echo (sprintf("%.2f", $t_num_8)); ?></td>
        <td><?php echo (sprintf("%.2f", $t_num_9)); ?></td>
      </tr>
    </table>
  </div>
</div>

    
    
  </body>
</html>