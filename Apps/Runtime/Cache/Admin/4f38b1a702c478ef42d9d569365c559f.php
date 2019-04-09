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
    <title>Index</title>
  </head>
  <body>
    
<div class="page-container">
  <form action="/admin/ebp/withdrawal" method="post" class="form form-horizontal">
    <input type="hidden" name="id" value="<?php echo ($id); ?>">
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">
        <span class="c-red">*</span>
        银行卡号
      </label>
      <div class="formControls col-xs-8 col-sm-9">
        <input type="text" class="input-text" value="" placeholder="" name="bankCard">
      </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">
        <span class="c-red">*</span>
        银行
      </label>
      <div class="formControls col-xs-8 col-sm-9">
        <span class="select-box">
          <select class="select" size="1" name="bankCode">
            <option value="" selected="">请选择银行</option>
            <?php if(is_array($bank_list)): foreach($bank_list as $key=>$item): ?><option value="<?php echo ($item["code"]); ?>"><?php echo ($item["name"]); ?></option><?php endforeach; endif; ?>
          </select>
        </span>
      </div>
    </div>
    <div class="row cl">
      <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
        <button type="submit" class="btn btn-success radius" id="admin-role-save"><i class="icon-ok"></i> 确定</button>
      </div>
    </div>
  </form>
</div>

    <script type="text/javascript" src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js"></script> 
    <script type="text/javascript" src="/Public/Tool/Hui/static/h-ui/js/H-ui.js"></script> 
    <script type="text/javascript" src="/Public/Tool/Hui/static/h-ui.admin/js/H-ui.admin.js"></script>
  </body>
</html>