<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>mg</title>
<link rel="stylesheet" href="//cdn.bootcss.com/zui/1.9.0/css/zui.min.css">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  </head>
  <body>
    <!-- 头部 -->
    


    <!-- /头部 -->
    <!-- 主体 -->
    
<div class="container">
  <input type="hidden" name="token" id="token" value="<?php echo ($token); ?>" />
  11
  <div id="data"></div>
</div>


    <!-- /主体 -->
    <!-- 底部 -->
    
<script src="//cdn.bootcss.com/zui/1.9.0/lib/jquery/jquery.js"></script>
<script src="//cdn.bootcss.com/zui/1.9.0/js/zui.min.js"></script>


    
<script>
$(function(){
  function get_data() {
    var token = $('#token').val();
    $.ajax({
      type: "POST",
      url: "/data_platform/get_api_data",
      data: {"token": token},
      success: function(result) {
      }
    });
  }
  setInterval(get_data, 3000);
})
</script>


  </body>
</html>