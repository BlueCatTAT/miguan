<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>error</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/zui/1.9.0/css/zui.min.css">
  </head>
  <body>
    <div class="container">
      <div class="alert alert-danger" style="margin-top:30%;">
        <p><strong><?php echo($error); ?></strong></p>
        <p class="detail"></p>
        <p class="jump">
        页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
        </p>
      </div>
      <div style="text-align:center;">
        <a href='/' class="btn">回首页</a>
      </div>
    </div>
    <script src="//cdn.bootcss.com/zui/1.9.0/lib/jquery/jquery.js"></script>
    <script src="//cdn.bootcss.com/zui/1.9.0/js/zui.min.js"></script>
    <script type="text/javascript">
(function() {
  var wait = document.getElementById('wait'), href = document.getElementById('href').href;
  var interval = setInterval(function() {
    var time = --wait.innerHTML;
    wait.innerHTML = time;
    if (time <= 0) {
      location.href = href;
      clearInterval(interval);
    }
    ;
  }, 3000);
})();
    </script>

  </body>
</html>
