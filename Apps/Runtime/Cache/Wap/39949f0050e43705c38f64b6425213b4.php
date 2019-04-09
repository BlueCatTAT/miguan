<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
  <head lang="zh-cn">
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MZUI</title>
<!-- MZUI CSS 文件 -->
<!--
<link href="/Public/Tool/mzui/css/mzui.min.css" rel="stylesheet">
<link href="/Public/Tool/mescroll/mescroll.min.css" rel="stylesheet">
-->
<!-- MZUI 的 JavaScript 插件依赖 jQuery，请使用 jQuery 最新版本 -->
<!--
<script src="/Public/Tool/mzui/js/lib/jquery/jquery.js"></script>
-->
<script src="http://easysoft.github.io/mzui/dist/lib/jquery/jquery-3.2.1.min.js"></script>
<!-- 引入 MZUI 的 JS 文件 -->
<!--
<script src="/Public/Tool/mzui/js/mzui.min.js"></script>
<script src="/Public/Tool/TouchSlide/TouchSlide.1.1.js"></script>
<script src="/Public/Tool/socket.io.js"></script>
<script src="/Public/Tool/mescroll/mescroll.min.js"></script>
-->
<script src="/Public/Tool/Highstock-6.1.1/code/highstock.js"></script>
<script src="/Public/Tool/Highstock-6.1.1/code/modules/exporting.js"></script>
<script src="/Public/Tool/Highstock-6.1.1/highcharts-zh_CN.js"></script>
<script src="/Public/Tool/qrcode.min.js"></script>
<script src="/Public/Tool/math.min.js"></script>


  </head>
  <body style="background:#ffffff;">
    <!-- 头部 -->
    


    <!-- /头部 -->
    <!-- 主体 -->
    
<div id="container" style="min-width:400px;height:400px">图表加载中...</div>
<script>
Highcharts.setOptions({
  lang: {
    rangeSelectorZoom: ''
  }
});
var url = 'https://data.jianshukeji.com/stock/history/000001';
var url = 'http://www.zjcf.com/api/data/index/code/sz300111/type/3/init/1.html';
$.getJSON(url, function (data) {
    if(data.code !== 1) {
      alert('读取股票数据失败！');
      return false;
    }
    data = data.data;
    var ohlc = [],
    volume = [],
    dataLength = data.length,
    // set the allowed units for data grouping
    groupingUnits = [[
    'week',                         // unit name
    [1]                             // allowed multiples
    ], [
    'month',
    [1, 2, 3, 4, 6]
    ]],
    i = 0;
    for (i; i < dataLength; i += 1) {
      ohlc.push([
          data[i][0], // the date
          data[i][1], // open
          data[i][2], // high
          data[i][3], // low
          data[i][4] // close
      ]);
      volume.push([
          data[i][0], // the date
          data[i][5] // the volume
      ]);
    }
// create the chart
var chart = Highcharts.stockChart('container', {
  rangeSelector: {
    selected: 1,
    inputDateFormat: '%Y-%m-%d'
  },
  xAxis: {
    dateTimeLabelFormats: {
      millisecond: '%H:%M:%S.%L',
      second: '%H:%M:%S',
      minute: '%H:%M',
      hour: '%H:%M',
      day: '%m-%d',
      week: '%m-%d',
      month: '%y-%m',
      year: '%Y'
    }
  },
  tooltip: {
    split: false,
    shared: true,
  },
  yAxis: [{
    labels: {
      align: 'right',
      x: -3
    },
    title: {
      text: '股价'
    },
    height: '65%',
    resize: {
      enabled: true
    },
    lineWidth: 2
  }, {
    labels: {
      align: 'right',
      x: -3
    },
    title: {
      text: '成交量'
    },
    top: '65%',
    height: '35%',
    offset: 0,
    lineWidth: 2
  }],
    series: [{
      type: 'candlestick',
      name: '平安银行',
      color: 'green',
      lineColor: 'green',
      upColor: 'red',
      upLineColor: 'red',
      tooltip: {
      },
      navigatorOptions: {
        color: Highcharts.getOptions().colors[0]
      },
      data: ohlc,
      dataGrouping: {
        units: groupingUnits
      },
      id: 'sz'
    },{
      type: 'column',
      data: volume,
      yAxis: 1,
      dataGrouping: {
        units: groupingUnits
      }
    }]
});
});
</script>


    <!-- /主体 -->
    <!-- 底部 -->
    
<nav class="nav nav-auto affix dock-bottom justified">
  <a href="/" <?php if($current == home): ?>class="text-danger"<?php endif; ?> style="display:flex; flex-direction:column; justify-content:center;">
    <span><i class="icon icon-home"></i></span>
    <span>首页</span>
  </a>
  <a href="/wap/stock/search" <?php if($current == policy): ?>class="text-danger"<?php endif; ?> style="display:flex; flex-direction:column; justify-content:center;">
    <span><i class="icon icon-expand-full"></i></span>
    <span>策略</span>
  </a>
  <a href="/wap/stock/chose" <?php if($current == stock): ?>class="text-danger"<?php endif; ?> style="display:flex; flex-direction:column; justify-content:center;">
    <span><i class="icon icon-search"></i></span>
    <span>选股</span>
  </a>
  <a href="/wap/collect/index" <?php if($current == collect): ?>class="text-danger"<?php endif; ?> style="display:flex; flex-direction:column; justify-content:center;">
    <span><i class="icon icon-check-board"></i></span>
    <span>自选</span>
  </a>
  <a href="/wap/user/index" <?php if($current == user): ?>class="text-danger"<?php endif; ?> style="display:flex; flex-direction:column; justify-content:center;">
    <span><i class="icon icon-user"></i></span>
    <span>我的</span>
  </a>
</nav>


    </div>
  </body>
</html>