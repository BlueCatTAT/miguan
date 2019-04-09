<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
  <head lang="zh-cn">
    <meta charset="UTF-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Index</title>
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="/favicon.ico">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
<link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
<link rel="stylesheet" href="/Public/Tool/css3-shine-progressbar/css/ProgressBarWars.css">


<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
<script type='text/javascript' src='/Public/Tool/TouchSlide1.1-00/TouchSlide.1.1.js' charset='utf-8'></script>


  </head>
  <body>
    <div class="page-group">
      <div class="page page-current">
        <!-- 头部 -->
        


        <!-- /头部 -->
        <!-- 主体 -->
        
<style>
.focus{ height:140px;  margin:0 auto; position:relative; overflow:hidden;   }
.focus .hd{ width:100%; height:11px;  position:absolute; z-index:1; bottom:5px; text-align:center;  }
.focus .hd ul{ display:inline-block; height:5px; padding:3px 5px; background-color:rgba(255,255,255,0.7); 
  -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; font-size:0; vertical-align:top;
}
      .focus .hd ul li{ display:inline-block; width:5px; height:5px; -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; background:#8C8C8C; margin:0 5px;  vertical-align:top; overflow:hidden;   }
      .focus .hd ul .on{ background:#FE6C9C;  }

      .focus .bd{ position:relative; z-index:0; }
      .focus .bd li img{ width:100%;  height:140px; background:url(images/loading.gif) center center no-repeat;  }
      .focus .bd li a{ -webkit-tap-highlight-color:rgba(0, 0, 0, 0); /* 取消链接高亮 */  }

.progress{
    height: 7px;
        background: #cccccc;
            border-radius: 0;
                box-shadow: none;
                        overflow: visible;
                            position: relative;
}
.progress-bar {
    float: left;
        width: 0%;
            height: 100%;
                font-size: @font-size-small;
                    line-height: @line-height-computed;
                        color: @progress-bar-color;
                            text-align: center;
                                background-color: @progress-bar-bg;
                                    .box-shadow(inset 0 -1px 0 rgba(0,0,0,.15));
                                      .transition(width .6s ease);
}
.progress .progress-bar{
    box-shadow: none;
        border-radius: 0;
            position: relative;
                -webkit-animation: animate-positive 2s;
                    animation: animate-positive 2s;
}
@-webkit-keyframes animate-positive{
    0% { width: 0; }
}
@keyframes animate-positive{
    0% { width: 0; }
}
.buttons-tab2 {
    -webkit-align-self: center;
        align-self: center;
            display: -webkit-box;
                display: -webkit-flex;
                    display: flex;
                        -webkit-box-lines: single;
                            -moz-box-lines: single;
                                -webkit-flex-wrap: nowrap;
                                    flex-wrap: nowrap;
}

.buttons-tab2 {
    background: white;
        position: relative;
}
.buttons-tab2:after {
    content: '';
        position: absolute;
            left: 0;
                bottom: 0;
                    right: auto;
                        top: auto;
                            height: 1px;
                                width: 100%;
                                    background-color: #d0d0d0;
                                        display: block;
                                            z-index: 15;
                                                -webkit-transform-origin: 50% 100%;
                                                            transform-origin: 50% 100%;
}
@media only screen and (-webkit-min-device-pixel-ratio: 2) {
    .buttons-tab2:after {
          -webkit-transform: scaleY(0.5);
                        transform: scaleY(0.5);
                            }
}
@media only screen and (-webkit-min-device-pixel-ratio: 3) {
    .buttons-tab2:after {
          -webkit-transform: scaleY(0.33);
                        transform: scaleY(0.33);
                            }
}
.buttons-tab2 .button {
    color: #5f646e;
        font-size: 0.8rem;
            width: 100%;
                height: 2rem;
                    line-height: 2rem;
                        -webkit-box-flex: 1;
                            -ms-flex: 1;
                                border: 0;
                                    border-bottom: 2px solid transparent;
                                        border-radius: 0;
}
.buttons-tab2 .button.active {
    color: #0894ec;
        border-color: #0894ec;
            z-index: 100;
}
</style>
<div class="content">
  <!--幻灯-->
  <div id="focus" class="focus">
    <div class="hd">
      <ul></ul>
    </div>
    <div class="bd">
      <ul>
        <li><a href="#"><img _src="http://www.superslide2.com/TouchSlide/demo/images/m2.jpg" src="/Public/Tool/TouchSlide1.1-00/images/blank.png" /></a></li>
        <li><a href="#"><img _src="http://www.superslide2.com/TouchSlide/demo/images/m2.jpg" src="/Public/Tool/TouchSlide1.1-00/images/blank.png"/></a></li>
        <li><a href="#"><img _src="http://www.superslide2.com/TouchSlide/demo/images/m2.jpg" src="/Public/Tool/TouchSlide1.1-00/images/blank.png"/></a></li>
      </ul>
    </div>
  </div>
  <!--幻灯-->
  <!--导航-->
  <div class="buttons-tab2">
    <a href="<?php echo U('/index/index', array('cid' => 0));?>" class="<?php if($cid == 0): ?>active<?php endif; ?> button">全部</a>
    <?php if(is_array($category_list)): foreach($category_list as $key=>$item): ?><a href="<?php echo U('/index/index', array('cid' => $item['id']));?>" class="<?php if($cid == $item[id]): ?>active<?php endif; ?> button"><?php echo ($item["name"]); ?></a><?php endforeach; endif; ?>
  </div>
  <!--导航-->
  <!--列表-->
  <?php if(is_array($product_list)): foreach($product_list as $key=>$item): ?><a href="<?php echo U('/product/info', array('id' => $item['id']));?>">
    <div class="card demo-card-header-pic">
      <div valign="bottom" class="card-header color-white no-border no-padding">
        <img class='card-cover' src="<?php echo ($item["pic"]); ?>" alt="">
      </div>
      <div class="card-content">
        <div class="card-content-inner">
          <p style="color:#333333;"><?php echo ($item["title"]); ?></p>
          <p class="color-gray">目标 <span style="color:#FF2E2E;">￥<?php echo ($item["total_fee"]); ?></span><span style="float:right; color:#FF2E2E;">￥<?php echo ($item["current_fee"]); ?></span></p>
          <?php $je = ceil($item['current_fee']/$item['total_fee']*100);?>
          <?php $je_2 = $je > 100 ? 100 : $je;?>
          <div class="progress pink">
            <div class="progress-bar" style="width:<?php echo ($je_2); ?>%; background:#00E4E5;">
            </div>
          </div>
          <p><span>当前进度：<?php echo ($je); ?>%</span><span style="float:right; color:#777777;"><?php echo (date("Y-m-d",$item["online_time"])); ?></span></p>
        </div>
      </div>
    </div>
  </a><?php endforeach; endif; ?>
  <!--列表-->
</div>

<script type="text/javascript">
$(function(){
  TouchSlide({ 
    slideCell:"#focus",
    titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
    mainCell:".bd ul", 
    effect:"left", 
    autoPlay:true,//自动播放
    autoPage:true, //自动分页
    switchLoad:"_src" //切换加载，真实图片路径为"_src" 
  });
})
</script>



        <!-- /主体 -->
        <!-- 底部 -->
        
<nav class="bar bar-tab">
  <a class="tab-item external <?php if($action == 'home'): ?>active<?php endif; ?>" href="<?php echo U('/');?>">
    <span class="icon icon-home"></span>
    <span class="tab-label">首页</span>
  </a>
  <a class="tab-item external <?php if($action == 'product'): ?>active<?php endif; ?>" href="<?php echo U('/product/category');?>">
    <span class="icon icon-me"></span>
    <span class="tab-label">项目</span>
  </a>
  <a class="yq tab-item external <?php if($action == 'yq'): ?>active<?php endif; ?>" href="<?php echo U('/user/yq');?>">
    <span class="icon icon-star"></span>
    <span class="tab-label">邀请</span>
  </a>
  <a class="tab-item external <?php if($action == 'user'): ?>active<?php endif; ?>" href="<?php echo ('/user/index');?>">
    <span class="icon icon-cart"></span>
    <span class="tab-label">我的</span>
  </a>
</nav>


        <!-- /底部 -->
        
      </div>
    </div>
  </body>
</html>