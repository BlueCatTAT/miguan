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
    <script type="text/javascript" src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js"></script> 
    <script type="text/javascript" src="/Public/Tool/Hui/static/h-ui/js/H-ui.js"></script> 
    <script type="text/javascript" src="/Public/Tool/Hui/static/h-ui.admin/js/H-ui.admin.js"></script>
    <!--[if IE 7]>
      <link href="http://www.bootcss.com/p/font-awesome/assets/css/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <title>Index</title>
  </head>
  <body>
    
<div class="page-container">
  <form action="/api/ips/payment" method="post" class="form form-horizontal">
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">
        <span class="c-red">*</span>
        Attach
      </label>
      <div class="formControls col-xs-8 col-sm-9">
        <input type="text" class="input-text" value="" placeholder="商户账号" id="Attach" name="Attach">
        <p class="lh-30">商户号</p>
      </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">
        <span class="c-red">*</span>
        MerBillNo
      </label>
      <div class="formControls col-xs-8 col-sm-9">
        <input type="text" class="input-text" value="" placeholder="商户订单号" id="MerBillNo" name="MerBillNo">
        <p class="lh-30">规则：30位以下的订单号 000001000123 格式：字母及数字</p>
      </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">
        <span class="c-red">*</span>
        Amount
      </label>
      <div class="formControls col-xs-8 col-sm-9">
        <input type="text" class="input-text" value="" placeholder="订单金额" id="Amount" name="Amount">
        <p class="lh-30">保留2位小数 格式：12.00</p>
      </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">
        <span class="c-red">*</span>
        CMerchanturl
      </label>
      <div class="formControls col-xs-8 col-sm-9">
        <input type="text" class="input-text" value="" placeholder="支付结果成功返回的商户URL" id="CMerchanturl" name="CMerchanturl">
        <p class="lh-30">支付结果成功返回的商户URL</p>
      </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">
        <span class="c-red">*</span>
        CFailUrl
      </label>
      <div class="formControls col-xs-8 col-sm-9">
        <input type="text" class="input-text" value="" placeholder="支付结果失败返回的商户URL" id="CFailUrl" name="CFailUrl">
        <p class="lh-30">支付结果失败返回的商户URL</p>
      </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">
        <span class="c-red">*</span>
        CServerUrl
      </label>
      <div class="formControls col-xs-8 col-sm-9">
        <input type="text" class="input-text" value="" placeholder="异步S2S返回URL" id="CServerUrl" name="CServerUrl">
        <p class="lh-30">异步S2S返回URL</p>
      </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">
        <span class="c-red">*</span>
        GoodsName
      </label>
      <div class="formControls col-xs-8 col-sm-9">
        <input type="text" class="input-text" value="" placeholder="商品名称" id="GoodsName" name="GoodsName">
        <p class="lh-30">用户购买的商品的名称</p>
      </div>
    </div>
    <div class="row cl">
      <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
        <button type="submit" class="btn btn-success radius" id="admin-role-save"><i class="icon-ok"></i> 确定</button>
        <a class="btn btn-primary radius" href="/api/demo/res"><i class="icon-ok"></i> 返回数据</a>
      </div>
    </div>
  </form>
</div>

  </body>
</html>