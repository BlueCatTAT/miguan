<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
  <head lang="zh-cn">
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MZUI</title>
<!-- MZUI CSS 文件 -->
<link href="/Public/Tool/mzui/css/mzui.min.css" rel="stylesheet">
<link href="/Public/Tool/mescroll/mescroll.min.css" rel="stylesheet">
<!-- MZUI 的 JavaScript 插件依赖 jQuery，请使用 jQuery 最新版本 -->
<!--
<script src="/Public/Tool/mzui/js/lib/jquery/jquery.js"></script>
-->
<script src="http://easysoft.github.io/mzui/dist/lib/jquery/jquery-3.2.1.min.js"></script>
<!-- 引入 MZUI 的 JS 文件 -->
<!--
<script src="/Public/Tool/mzui/js/mzui.min.js"></script>
-->
<script src="http://easysoft.github.io/mzui/dist/js/mzui.js"></script>
<script src="/Public/Tool/TouchSlide/TouchSlide.1.1.js"></script>
<script src="/Public/Tool/socket.io.js"></script>
<script src="/Public/Tool/mescroll/mescroll.min.js"></script>
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
    
<style>

.control-group {display: flex; align-items: stretch}
.control-group > .btn {flex: none}
.control-group > .input {flex: auto}
.number-range-control {width: 7rem}
.number-range-control > .btn {border-color: #ccc!important}
.number-range-control > .btn:first-child {border-right: none}
.number-range-control > .btn:last-child {border-left: none}
.number-range-control > .btn + .input {text-align: center}

</style>
<input type="hidden" name="code" id="code" value="<?php echo ($code); ?>"/>
<input type="hidden" name="name" id="name" value="<?php echo ($stock_info['stockName']); ?>"/>
<input type="hidden" name="default_fee" id="default_fee" value="<?php echo ($default_fee); ?>"/>
<input type="hidden" name="secondboard" id="secondboard" value="<?php echo ($secondboard); ?>"/>
<div class="section" style="padding:10px; margin-bottom:0px;">
  <div class="row">
    <div class="cell-4" style="flex-direction:column;">
      <div style="font-size:1rem;"><?php echo ($stock_info['stockName']); ?></div>
      <div class="text-gray"><?php echo ($stock_info['stockCode']); ?></div>
    </div>
    <div class="cell-8" style="flex-direction:column;">
      <?php if($stock_info['netChange'] > 0): ?><div class="text-red" style="font-size:1rem;" id="close"><?php echo (round($stock_info['close'],2)); ?></div>
      <div>
        <span class="text-red" id="netChange"><?php echo (round($stock_info['netChange'],2)); ?></span>
        <span class="text-red" id="netChangeRatio"><?php echo (round($stock_info['netChangeRatio'],2)); ?></span>
      </div>
      <?php else: ?>
      <div class="text-green" style="font-size:1rem;" id="close"><?php echo (round($stock_info['close'],2)); ?></div>
      <div>
        <span class="text-green" id="netChange"><?php echo (round($stock_info['netChange'],2)); ?></span>
        <span class="text-green" id="netChangeRatio"><?php echo (round($stock_info['netChangeRatio'],2)); ?></span>
      </div><?php endif; ?>
    </div>
  </div>
</div>
<div class="section" style="padding:10px;">
  <div class="row">
    <div class="cell-3" style="flex-direction:column;">
      <?php if($stock_info['open'] > $stock_info['preClose']): ?><div class="small">今开 <span class="text-red"><?php echo (round($stock_info['open'],2)); ?></span></div>
      <?php else: ?>
      <div class="small">今开 <span class="text-green"><?php echo (round($stock_info['open'],2)); ?></span></div><?php endif; ?>
      <div class="small">昨收 <span class="text-gray"><?php echo (round($stock_info['preClose'],2)); ?></span></div>
    </div>
    <div class="cell-3" style="flex-direction:column;">
      <?php if($stock_info['high'] > $stock_info['open']): ?><div class="small">最高 <span class="text-red"><?php echo (round($stock_info['high'],2)); ?></span></div>
      <?php else: ?>
      <div class="small">最高 <span class="text-green"><?php echo (round($stock_info['high'],2)); ?></span></div><?php endif; ?>
      <?php if($stock_info['low'] > $stock_info['open']): ?><div class="small">最低 <span class="text-red"><?php echo (round($stock_info['low'],2)); ?></span></div>
      <?php else: ?>
      <div class="small">最低 <span class="text-green"><?php echo (round($stock_info['low'],2)); ?></span></div><?php endif; ?>
    </div>
    <div class="cell-3" style="flex-direction:column;">
      <div class="small">成交量 <span class="text-gray"><?php echo (round($stock_info['volume']/1000000,2)); ?></span></div>
      <div class="small">换手率 <span class="text-gray"><?php echo (round($stock_info['turnoverRatio']*100,2)); ?></span></div>
    </div>
    <div class="cell-3" style="flex-direction:column;">
      <div class="small">涨停价 <span class="text-red"><?php echo sprintf('%.2f', ($stock_info['preClose'] * 1.1));?></span></div>
      <div class="small">跌停价 <span class="text-green"><?php echo sprintf('%.2f', ($stock_info['preClose'] * 0.9));?></span></div>
    </div>
  </div>
</div>
<div id="container_1" ></div>
<div id="container_2" ></div>
<div class="section" style="padding:10px; margin-bottom:70px;">
  <div class="row" style="align-items:center;">
    <div class="cell" style="text-align:right; justify-content:flex-end;">交易模式</div>
    <div class="cell">
      <a class="btn danger">T+1</a>
      <a class="btn gray">T+N</a>
    </div>
    <div class="cell"></div>
  </div>
  <div class="row" style="align-items:center;">
    <div class="cell-3" style="justify-content: flex-end;">投入信用金</div>
    <div class="cell-9" style="align-items:center;">
      <input style="width:100px; margin-right:10px;" type="text" class="input" id="fee" value="<?php echo ($default_fee); ?>"/>
      <span class="text-gray">请输入100的整数倍</span>
    </div>
  </div>
  <div class="row" style="align-items:center;">
    <div class="cell-3" style="justify-content: flex-end;">推荐</div>
    <div class="cell-9" style="justify-content: space-between;">
      <a href="javascript:;" class="btn outline danger fee_btn" style="width:60px;" onclick="setFee(500, this);">500</a>
      <a href="javascript:;" class="btn outline danger fee_btn" style="width:60px;" onclick="setFee(1000, this);">1000</a>
      <a href="javascript:;" class="btn outline danger fee_btn" style="width:60px;" onclick="setFee(2000, this);">2000</a>
      <a href="javascript:;" class="btn outline danger fee_btn" style="width:60px;" onclick="setFee(3000, this);">3000</a>
    </div>
  </div>
  <div class="row" style="align-items:center;">
    <div class="cell-3" style="justify-content: flex-end;"></div>
    <div class="cell-9" style="justify-content: space-between;">
      <a href="javascript:;" class="btn outline danger fee_btn" style="width:60px;" onclick="setFee(5000, this);">5000</a>
      <a href="javascript:;" class="btn outline danger fee_btn" style="width:60px;" onclick="setFee(8000, this);">8000</a>
      <a href="javascript:;" class="btn outline danger fee_btn" style="width:60px;" onclick="setFee(10000, this);">10000</a>
      <a href="javascript:;" class="btn outline danger fee_btn" style="width:60px;" onclick="setFee(20000, this);">20000</a>
    </div>
  </div>
  <hr/>
  <div class="row">
    <div class="cell-3" style="justify-content: flex-end;">买入数量</div>
    <div class="cell-9" style="flex-direction:column;">
      <div style="flex-direction:row; align-items:center;"><input type="text" class="input" id="volume" name="volume" value="1" style="width:100px; display:inline;"> * 100股</div>
    </div>
    <div class="cell-3" ></div>
    <div class="cell-9" >
      <div>参考市值（<span id="buyPrice"></span>）<span id="buyNetChange"><?php echo (round($stock_info['netChange'],2)); ?></span> <span><?php echo (round($stock_info['netChangeRatio'],2)); ?>%</span></div>
    </div>
  </div>
  <hr/>
  <div class="row" style="align-items:center;">
    <div class="cell-2">
    止盈
    </div>
    <div class="cell-5 control-group number-range-control">
      <button class="btn" type="btn" id="endprofit_minus"><i class="icon-minus"></i></button>
      <input type="number" class="input" value="<?php echo ($endprofit); ?>" id="endprofit"/> 
      <button class="btn btn-plus" type="btn" id="endprofit_plus"><i class="icon-plus"></i></button>
    </div>
    <div class="cell-5">
      上涨<span class="text-red" id="endprofit_ratio">20%</span>发起平仓
    </div>
  </div>
  <div class="row" style="align-items:center;">
    <div class="cell-2">
    止损
    </div>
    <div class="cell-5 control-group number-range-control">
      <button class="btn" type="btn" id="endloss_minus"><i class="icon-minus"></i></button>
      <input type="number" class="input" value="<?php echo ($endloss); ?>" id="endloss"> 
      <button class="btn btn-plus" type="btn" id="endloss_plus"><i class="icon-plus"></i></button>
    </div>
    <div class="cell-5">
      下跌<span class="text-green" id="endloss_ratio">20%</span>发起平仓
    </div>
  </div>
  <div class="text-gray">预计可赚 <span class="text-red" id="income"><?php echo ($income); ?></span></div>
  <hr/>
  <div class="small">持仓服务费为持仓的天数来计算，系统不自动平仓</div>
</div>
<script>
var url = "<?php echo U('/api/data/index', ['code' => $code, 'type' => 1, 'init' => 1]);?>";
$.getJSON(url, function (data) {
    if(data.code !== 1) {
      alert('读取股票数据失败！');
      return false;
    }
    var html = '';
    var ask_list = data.data.ask;
    var bid_list = data.data.bid;
    $.each(ask_list, function(index, value){
      html += '<div class="row">';
      html += '<span class="cell">卖 ' + (index+1) + '</span>';
      html += '<span class="cell">' + value.pric + '</span>';
      html += '<span class="cell">' + value.volume + '</span>';
      html += '</div>';
    });
    $.each(bid_list, function(index, value){
      html += '<div class="row">';
      html += '<span class="cell">买 ' + (index+1) + '</span>';
      html += '<span class="cell">' + value.pric + '</span>';
      html += '<span class="cell">' + value.volume + '</span>';
      html += '</div>';
    });
    data = data.data.list;
    // 去掉多余的数据
    Highcharts.each(data, function(d) {
      d.length = 2;
    });
    Highcharts.stockChart('container_1', {
      chart: {
        events: {
          load: function(){
            var series = this.series[0];
            setInterval(function () {
              //var x = (new Date()).getTime(), // current time
              //y = Math.round(Math.random() * 100);
              //series.addPoint([x, y], true, true);
            }, 1000);
          }
        }
      },
      rangeSelector: {
       buttons: [
       {type: 'minute', count: 20, text: '20m'}
       ],
        buttonTheme: {
          display: 'none' // 不显示按钮
        },
        selected: 0,
        inputEnabled: false // 不显示日期输入框
      },
      plotOptions: {
        series: {
          showInLegend: true
        }
      },
      credits:{
             enabled: false // 禁用版权信息
      },
      exporting:{
        enabled: false
      },
      tooltip: {
        split: false,
        shared: true
      },
      series: [{
        // type: 'line',
        id: '000001',
        data: data
      }]
    });
});

</script>
<script>
Highcharts.setOptions({
  lang: {
    rangeSelectorZoom: ''
  }
});
var url = "<?php echo U('/api/data/index', ['code' => $code, 'type' => 3, 'init' => 1]);?>";
$.getJSON(url, function (data) {
    if(data.code !== 1) {
      alert('读取股票数据失败！');
      return false;
    }
    data = data.data;
    var ohlc = [],
    volume = [],
    dataLength = data.length,
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
var chart = Highcharts.stockChart('container_2', {
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
<script>
setInterval('refreshPrice()',1000);
function refreshPrice(){
  var code = $('#code').val();
  $.ajax({
    url: '/api/data/get_price',
    type: 'post',
    dataType: 'json',
    data: {'code': code}, 
    success: function(res) {
      $('#close').html(res.close);
      $('#netChange').html(res.netChange);
      $('#netChangeRatio').html(res.netChangeRatio);
      $('#open').html(res.open);
      $('#buyNetChange').html(res.netChange);
      $('#buyNetChangeRatio').html(res.netChangeRatio);
     
      var volume = $('#volume').val();
      var buyPrice = 0;
      buyPrice = math.chain(volume).multiply(res.close).done();
      buyPrice = math.round(buyPrice, 2);
      $('#buyPrice').html(buyPrice);

      if (res.netChange > 0) {
        $('#close').removeClass('text-green');
        $('#close').addClass('text-red');
        $('#netChange').removeClass('text-green');
        $('#netChange').addClass('text-green');
        $('#netChangeRatio').removeClass('text-green');
        $('#netChangeRatio').addClass('text-red');
        $('#buyNetChange').removeClass('text-green');
        $('#buyNetChange').addClass('text-red');
        $('#buyNetChangeRatio').removeClass('text-green');
        $('#buyNetChangeRatio').addClass('text-red');
      } else {
        $('#close').addClass('text-green');
        $('#close').removeClass('text-red');
        $('#netChange').addClass('text-green');
        $('#netChange').removeClass('text-green');
        $('#netChangeRatio').addClass('text-green');
        $('#netChangeRatio').removeClass('text-red');
        $('#buyNetChange').addClass('text-green');
        $('#buyNetChange').removeClass('text-red');
        $('#buyNetChangeRatio').addClass('text-green');
        $('#buyNetChangeRatio').removeClass('text-red');
      }
    }
  });
}
</script>


    <!-- /主体 -->
    <!-- 底部 -->
    
<nav class="nav affix dock-bottom">
    <div style="padding:5px 10px; flex-direction: column; flex-grow:2;">
      <div>总计扣款: <span class="text-red" id="fee_t"><?php echo ($default_fee); ?></span></div>
      <div>可用余额: <span class="text-red" id="balance"><?php echo ($user_info['balance']); ?></span></div>
      <div class="small"><a href="#" class="text-primary">同意《策略协议》</a></div>
    </div>
    <div style="display:flex; flex-wrap: nowrap;">
      <a style="display:flex; align-items: center; justify-content: center; padding:0px 20px;" href="javascript:;" class="warning" onclick="collect_add(<?php echo ($item["code"]); ?>);"><i class="icon icon-expand-alt"></i> 加自选</a>
    </div>
    <div style="display:flex; flex-wrap: nowrap;">
      <a style="display:flex; align-items: center; justify-content: center; padding:0px 20px;" href="javascript:;" class="danger" onclick="subOrder();">提交策略</a>
    </div>
</nav>
<script>
function collect_add(code)
{
  $.ajax({
    url: '/wap/user/collect_add',
    type: 'post',
    dataType: 'json',
    data: {'code': code},
    success: function(res) {
      alert('添加成功');
    }
  });
}
function setFee(fee, obj)
{
  var default_fee = $('#default_fee').val();
  if (fee < default_fee) {
    alert('最低' + default_fee);
    return false;
  }
  $('#fee').val(fee);
  $('#fee_t').html(fee);
  $('.fee_btn').addClass('outline');
  $(obj).removeClass('outline');
}
$(function(){
  $('#fee').on('change', function(){
    $('#fee_t').html($(this).val());
  });
  $('#fee').on('input', function(){
    $('#fee_t').html($(this).val());
  });
  $('#volume').on('blur', function(){
    var volume = $(this).val();
    volume = parseInt(volume);
    if (isNaN(volume)) {
      alert('请输入100的整数倍');
    }
    var r = /^\+?[1-9][0-9]*$/;
    if ( ! r.test(volume)) {
      alert('请输入100的整数倍');
    }
  })
  $('#endprofit_minus').on('click', function(){
    var endprofit = $('#endprofit').val();
    var price = $('#close').html(); 
    var volume = $('#volume').val();
    endprofit = math.add(endprofit, -0.01);
    endprofit = math.round(endprofit, 2);
    $('#endprofit').val(endprofit);
    
    var p = math.chain(price).multiply(-1).done();
    var o = math.add(endprofit, p);
    var ratio = math.chain(o).divide(price).multiply(100).done();
    ratio = math.round(ratio, 2) + '%';
    $('#endprofit_ratio').html(ratio);

    var income = math.chain(o).multiply(volume).done();
    income = math.round(income, 2);
    $('#income').html(income);
  });
  $('#endprofit_plus').on('click', function(){
    var endprofit = $('#endprofit').val();
    var price = $('#close').html(); 
    var volume = $('#volume').val();
    endprofit = math.add(endprofit, 0.01);
    endprofit = math.round(endprofit, 2);
    $('#endprofit').val(endprofit);
    
    var p = math.chain(price).multiply(-1).done();
    var o = math.add(endprofit, p);
    var ratio = math.chain(o).divide(price).multiply(100).done();
    ratio = math.round(ratio, 2) + '%';
    $('#endprofit_ratio').html(ratio);
    
    var income = math.chain(o).multiply(volume).done();
    income = math.round(income, 2);
    $('#income').html(income);
  });
  $('#endloss_minus').on('click', function(){
    var endloss = $('#endloss').val();
    var price = $('#close').html(); 
    var volume = $('#volume').val();
    endloss = math.add(endloss, -0.01);
    endloss = math.round(endloss, 2);
    $('#endloss').val(endloss);
    
    var p = math.chain(price).multiply(-1).done();
    var o = math.add(endloss, p);
    var ratio = math.chain(o).divide(price).multiply(100).done();
    ratio = math.round(ratio, 2) + '%';
    $('#endloss_ratio').html(ratio);
    
    var income = math.chain(o).multiply(volume).done();
    income = math.round(income, 2);
    $('#income').html(income);
  });
  $('#endloss_plus').on('click', function(){
    var endloss = $('#endloss').val();
    var price = $('#close').html(); 
    var volume = $('#volume').val();
    endloss = math.add(endloss, 0.01);
    endloss = math.round(endloss, 2);
    $('#endloss').val(endloss);
    
    var p = math.chain(price).multiply(-1).done();
    var o = math.add(endloss, p);
    var ratio = math.chain(o).divide(price).multiply(100).done();
    ratio = math.round(ratio, 2) + '%';
    $('#endloss_ratio').html(ratio);
    
    var income = math.chain(o).multiply(volume).done();
    income = math.round(income, 2);
    $('#income').html(income);
  });
});

function subOrder() {
  var code = $('#code').val(); 
  var name = $('#name').val();
  var fee = $('#fee').val();
  var volume = $('#volume').val();
  var price = $('#close').text();
  volume = parseInt(volume);
  price = parseInt(price);
  var endprofit = $('#endprofit').val();
  var endloss = $('#endloss').val(); 
  if (fee < price * volume) {
    alert('保证金少于股票总金额');
    return false;
  } 
  $.ajax({
    url: '/wap/order/add_order',
    type: 'post',
    dataType: 'json',
    data: {'code': code, 'name': name, 'fee': fee, 'volume': volume, 'endprofit': endprofit, 'endloss': endloss},
    success: function(res) {
      if (res.status == 0) {
        alert('操作成功');
        location.reload();
      } else {
        alert(res.msg);
        return false;
      }
    }
  });
}

</script>


    </div>
  </body>
</html>