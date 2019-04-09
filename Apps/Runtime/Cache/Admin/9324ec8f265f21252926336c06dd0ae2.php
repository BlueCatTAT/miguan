<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>标题</title>
    
    <link href="/Public/Tool/hui/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/Public/Tool/hui/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Tool/hui/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/Public/Tool/hui/static/h-ui.admin/css/style.css" />
    <link href="/Public/Tool/hui/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Tool/hui/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Tool/hui/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
    
    
    <script type="text/javascript" src="/Public/Tool/hui/lib/jquery/1.9.1/jquery.min.js"></script> 
    <script type="text/javascript" src="/Public/Tool/hui/static/h-ui/js/H-ui.min.js"></script>
    <script type="text/javascript" src="/Public/Tool/hui/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="/Public/Tool/hui/static/h-ui.admin/js/H-ui.admin.js"></script>
    
  </head>
  <body>
    <!-- 头部 -->
    
    <header class="navbar-wrapper">
      <div class="navbar navbar-fixed-top">
        <div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="/">后台管理</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/">H-ui</a> 
          <span class="logo navbar-slogan f-l mr-10 hidden-xs">v1.0 beta</span> 
          <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
          <nav class="nav navbar-nav">
            <ul class="cl">
              <li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
                <ul class="dropDown-menu menu radius box-shadow">
                  <li><a href="javascript:;" onclick="article_add('添加资讯','article-add.html')"><i class="Hui-iconfont">&#xe616;</i> 资讯</a></li>
                </ul>
              </li>
            </ul>
          </nav>
          <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
            <ul class="cl">
              <li><?php echo ($admin_info['username']); ?></li>
              <li class="dropDown dropDown_hover">
                <a href="#" class="dropDown_A">菜单<i class="Hui-iconfont">&#xe6d5;</i></a>
                <ul class="dropDown-menu menu radius box-shadow">
                  <li><a href="javascript:;" onClick="myselfinfo()">个人信息</a></li>
                  <li><a data-href="<?php echo U('/admin/public/set_pwd');?>" data-title="重置密码" href="javascript:void(0)" onclick="Hui_admin_tab(this)">重置密码</a></li>
                  <li><a href="<?php echo U('/admin/public/logout');?>">退出</a></li>
                </ul>
              </li>
              <li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
              <li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
                <ul class="dropDown-menu menu radius box-shadow">
                  <li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
                  <li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
                  <li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
                  <li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
                  <li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
                  <li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </header>
    
    <!-- /头部 -->
    <!-- 主体 -->
    
    <aside class="Hui-aside">
    <div class="menu_dropdown bk_2">
      <?php $__base_menu__ = $__controller__->getMenus(); ?>
      <?php if(is_array($__base_menu__)): $i = 0; $__LIST__ = $__base_menu__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><dl id="menu-1">
        <dt><i class="Hui-iconfont">&#xe616;</i> <?php echo ($menu['name']); ?><i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
        <dd>
        <ul>
          <?php if(is_array($menu["sub_menu"])): foreach($menu["sub_menu"] as $key=>$sub_menu): ?><li><a data-href="<?php echo ($sub_menu['url']); ?>" data-title="<?php echo ($sub_menu['title']); ?>" href="javascript:void(0)"><?php echo ($sub_menu['title']); ?></a></li><?php endforeach; endif; ?>
        </ul>
        </dd>
      </dl><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    </aside>
    
    <div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
    <section class="Hui-article-box">
      <div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
        <div class="Hui-tabNav-wp">
          <ul id="min_title_list" class="acrossTab cl">
            <li class="active">
              <span title="我的桌面" data-href="welcome.html">我的桌面</span>
              <em></em></li>
          </ul>
        </div>
        <div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
      </div>
      <div id="iframe_box" class="Hui-article">
        <div class="show_iframe">
          <div style="display:none" class="loading"></div>
          <iframe scrolling="yes" frameborder="0" src="<?php echo U('index/info');?>"></iframe>
        </div>
      </div>
    </section>
    <div class="contextMenu" id="Huiadminmenu">
      <ul>
        <li id="closethis">关闭当前 </li>
        <li id="closeall">关闭全部 </li>
      </ul>
    </div>
    <!-- /主体 -->
    <!-- 底部 -->
    
    
    <!-- /底部 -->
  </body>
</html>