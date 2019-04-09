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
  <form action="" method="post" class="form form-horizontal">
    <input type="hidden" name="id" value="<?php echo ($conf_info["id"]); ?>"/>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>开奖设置：</label>
      <div class="formControls col-xs-8 col-sm-9">
        <div class="radio-box">
            <input type="radio" name="type" value="1" <?php if($conf_info["type"] == 1): ?>checked<?php endif; ?>/> 随机
            <input type="radio" name="type" value="2" <?php if($conf_info["type"] == 2): ?>checked<?php endif; ?>/> 吃大
            <input type="radio" name="type" value="3" <?php if($conf_info["type"] == 3): ?>checked<?php endif; ?>/> 开单号
            <input type="radio" name="type" value="4" <?php if($conf_info["type"] == 4): ?>checked<?php endif; ?>/> 开双号
        </div>
      </div>
    </div>
    <div class="row cl">
      <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
        <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont"></i> 提交</button>
        <button class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
      </div>
    </div>
  </form>
</div>

    
    
  </body>
</html>