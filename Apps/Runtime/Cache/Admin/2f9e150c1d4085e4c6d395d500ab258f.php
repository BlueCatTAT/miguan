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
  <form action="https://ebp.ips.com.cn/fpms-access/action/user/open" method="post" class="form form-horizontal">
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">
        <span class="c-red">*</span>
        ipsRequest 加密数据
      </label>
      <div class="formControls col-xs-8 col-sm-9">
        <textarea name="ipsRequest" class="textarea"><?php echo ($ipsRequest); ?></textarea>
        <!--
        <textarea name="ipsRequest"><ipsRequest><argMerCode>208971</argMerCode><arg3DesXmlPara>n7FIovQPw+GNKpTdOTvLa0/3tu5Be0IJ5hAf++gkBoo7o6Cu25YGkfZnN1F7GOIg6jjZlxohZA6j7+jOIJqj2rbXRfmQx43X8ad+LEsJ4qM/fpt1wBq1o1wrDqnr9mfSRP1beuCAo55uOu1buPIKo7lciviCrwf8f96iBzdXPuQASXZ9YepSR/OLizPk9vgMzK1cxRIEZulvxtaWRr8fajg4YUjWQlqJJEUZekhEL5pgB3qjJvMJFwVnEYkrlMBJlL5s2Flok3aKIJrGS8K5+cXfyyGxK1b/ZJvvy2Sqxd3pnVbtK8dUEFMUUupbHQ8tl21mFl4/ZRHwmib8nRIZh0aGKSOxZWgJu9xKHOra0db4xn8td0DQVZsBmkUXfFoiov+NXCuV0nd2xXZOetk/Zg4f225eQQdXW7olWZ8U11dENcqLmJJU4nl+ET8haoYLrFoEqPiGOfp9N0FMasLmdEfmzVMSjjA8mXi5YTYoT/fYhIHJunlPiE+9qHe+YeAN2vo+p0zYp1N7Dm6+IQC2RBAqoJCnhagW3tURscU6T4N4/w/4YUj1ow3GqQ9HT1cm3M/53gQqthut9umG02A+AMunytf/C9v6DeUkHS+ussAcKWlHKnBOrEsZeTMVy0D60Jm6Q1Vkpn3x+Koi3C5TNhbhT9Bvv09osUV2c3ptPX+bPH1gPU9ti5SIm1yvgKJ+DZhNtcn8vhL2AikbmqoHOOGBzCOWTG5uVpuDzfzd2Hlo9DvOWtxwFlPdm+/ifNoeZs20LSfY85VfB3Bqk+aTmG1IeV2DJ9UEuQh5VQwVePZYyu0WJq5q/bjooWhJiuInSjb4rKZLkPyUDYJRRoytf0euPJbTSSgYM4h+c9QHlDGlGkK6dn1FtNjksA021LD7Le7k6j09g9JZewq/jKA/bLOYOhh+rHap4KhNdkHJ4JkO0543ixBKahXMG0IpF/XIXL4LjkQt53XTran9vkdQmryfO91q92bJaxo+pxfZAwI7RT3CMDLfaRiPO7iuNZbwordyUlkC0ORBc54XKCY5aE5oxqfIllpJJsZNLwiaUPvt3non0e9pVK2uD5J/dh0BYxFgp9jH2r8ZeSKHy7EM6A==</arg3DesXmlPara></ipsRequest></textarea>
        -->
      </div>
    </div>
    <div class="row cl">
      <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
        <button type="submit" class="btn btn-success radius" id="admin-role-save"><i class="icon-ok"></i> 发送请求</button>
      </div>
    </div>
  </form>
</div>

    <script type="text/javascript" src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js"></script> 
    <script type="text/javascript" src="/Public/Tool/Hui/static/h-ui/js/H-ui.js"></script> 
    <script type="text/javascript" src="/Public/Tool/Hui/static/h-ui.admin/js/H-ui.admin.js"></script>
  </body>
</html>