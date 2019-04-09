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
  <form action="#" method="post" class="form form-horizontal">
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">
        <span class="c-red">*</span>
        客户号
      </label>
      <div class="formControls col-xs-8 col-sm-9">
        <input type="text" class="input-text" value="<?php echo ($customerCode); ?>" placeholder="" name="customerCode">
      </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">
        <span class="c-red">*</span>
        姓名
      </label>
      <div class="formControls col-xs-8 col-sm-9">
        <input type="text" class="input-text" value="" placeholder="" name="userName">
      </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">
        <span class="c-red">*</span>
        手机
      </label>
      <div class="formControls col-xs-8 col-sm-9">
        <input type="text" class="input-text" value="" placeholder="" name="mobiePhoneNo">
      </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">
        <span class="c-red">*</span>
        身份证号
      </label>
      <div class="formControls col-xs-8 col-sm-9">
        <input type="text" class="input-text" value="" placeholder="" name="identityNo">
      </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">
        <span class="c-red">*</span>
        公司名
      </label>
      <div class="formControls col-xs-8 col-sm-9">
        <input type="text" class="input-text" value="" placeholder="" name="company">
      </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">
        <span class="c-red">*</span>
        费率(千分)
      </label>
      <div class="formControls col-xs-8 col-sm-9">
        <input type="text" class="input-text" value="6" placeholder="" name="rate">
      </div>
    </div>
    <div class="row cl">
      <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
        <button type="submit" class="btn btn-success radius" id="admin-role-save"><i class="icon-ok"></i> 确定</button>
      </div>
    </div>
  </form>
</div>

  </body>
</html>