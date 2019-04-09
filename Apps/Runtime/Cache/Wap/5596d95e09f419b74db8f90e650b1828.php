<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>mg</title>
<link rel="stylesheet" href="//cdn.bootcss.com/zui/1.9.0/css/zui.min.css">

  </head>
  <body>
    <!-- 头部 -->
    


    <!-- /头部 -->
    <!-- 主体 -->
    
<div class="container">
  <h2>基本信息</h2> 
  <table class="table table-bordered table-striped">
    <tr>
      <td>姓名</td>
      <td><?php echo ($data["user_basic"]["user_name"]); ?></td>
    </tr>
    <tr>
      <td>身份证号码</td>
      <td><?php echo ($data["user_basic"]["user_idcard"]); ?></td>
    </tr>
    <tr>
      <td>年龄</td>
      <td><?php echo ($data["user_basic"]["user_age"]); ?></td>
    </tr>
    <tr>
      <td>身份证所在地</td>
      <td>
        <?php echo ($data["user_basic"]["user_province"]); ?>
        <?php echo ($data["user_basic"]["user_city"]); ?>
        <?php echo ($data["user_basic"]["user_region"]); ?>
      </td>
    </tr>
    <tr>
      <td>性别</td>
      <td><?php echo ($data["user_basic"]["user_gender"]); ?></td>
    </tr>
    <tr>
      <td>手机所属运营商</td>
      <td><?php echo ($data["user_basic"]["user_phone_operator"]); ?></td>
    </tr>
    <tr>
      <td>手机号码</td>
      <td><?php echo ($data["user_basic"]["user_phone"]); ?></td>
    </tr>
    <tr>
      <td>符合身份证号码编码规范</td>
      <td><?php echo ($data["user_basic"]["user_idcard_valid"]); ?></td>
    </tr>
  </table>
  <h2>借条信息</h2> 
  <table class="table table-bordered table-striped">
    <tr>
      <td>借条借贷总次数</td>
      <td><?php echo ($data["iou_statistic"]["total_loan_times"]); ?></td>
    </tr>
    <tr>
      <td>借条借贷总金额</td>
      <td><?php echo ($data["iou_statistic"]["total_loan_amount"]); ?></td>
    </tr>
    <tr>
      <td>借条最近状态</td>
      <td><?php echo ($data["iou_statistic"]["recent_iou_status"]); ?></td>
    </tr>
    <tr>
      <td>最近一次借入日期</td>
      <td><?php echo ($data["iou_statistic"]["recent_loan_time"]); ?></td>
    </tr>
    <tr>
      <td>最近一次应还款日期</td>
      <td><?php echo ($data["iou_statistic"]["recent_pay_back_time"]); ?></td>
    </tr>
    <tr>
      <td>还款中借款笔数</td>
      <td><?php echo ($data["iou_statistic"]["in_repayment_times"]); ?></td>
    </tr>
    <tr>
      <td>还款中本金总额</td>
      <td><?php echo ($data["iou_statistic"]["in_repayment_amount"]); ?></td>
    </tr>
    <tr>
      <td>还款中利息总额</td>
      <td><?php echo ($data["iou_statistic"]["in_repayment_interest"]); ?></td>
    </tr>
    <tr>
      <td>逾期已还借款笔数</td>
      <td><?php echo ($data["iou_statistic"]["overdue_payment_times"]); ?></td>
    </tr>
    <tr>
      <td>逾期已还本金总额</td>
      <td><?php echo ($data["iou_statistic"]["overdue_payment_amount"]); ?></td>
    </tr>
    <tr>
      <td>逾期已还利息总额</td>
      <td><?php echo ($data["iou_statistic"]["overdue_payment_interest"]); ?></td>
    </tr>
    <tr>
      <td>逾期借款笔数</td>
      <td><?php echo ($data["iou_statistic"]["overdue_times"]); ?></td>
    </tr>
    <tr>
      <td>逾期本金总额</td>
      <td><?php echo ($data["iou_statistic"]["overdue_amount"]); ?></td>
    </tr>
    <tr>
      <td>逾期利息总额</td>
      <td><?php echo ($data["iou_statistic"]["overdue_interest"]); ?></td>
    </tr>
    <tr>
      <td>借条平台数_360天</td>
      <td><?php echo ($data["iou_statistic"]["d360_iou_platform_cnt"]); ?></td>
    </tr>
    <tr>
      <td>借条平台数_90天</td>
      <td><?php echo ($data["iou_statistic"]["d90_iou_platform_cnt"]); ?></td>
    </tr>
    <tr>
      <td>借条平台数_30天</td>
      <td><?php echo ($data["iou_statistic"]["d30_iou_platform_cnt"]); ?></td>
    </tr>
    <tr>
      <td>借条查询次数_360天</td>
      <td><?php echo ($data["iou_statistic"]["d360_iou_query_times"]); ?></td>
    </tr>
    <tr>
      <td>借条查询次数_90天</td>
      <td><?php echo ($data["iou_statistic"]["d90_iou_query_times"]); ?></td>
    </tr>
    <tr>
      <td>借条查询次数_30天</td>
      <td><?php echo ($data["iou_statistic"]["d30_iou_query_times"]); ?></td>
    </tr>
  </table>
  <h2>社交特征模块</h2>
  <div class="panel">
    <div class="panel-heading">基本社交特征</div>
    <div class="panel-body">
      <table class="table table-bordered table-striped">
        <tr>
          <td>灰度分</td>
          <td><?php echo ($data["user_gray"]["phone_gray_score"]); ?> (分数区间为0~100,10分以下为高危人群) </td>
        </tr>
        <tr>
          <td>社交活跃度</td>
          <td><?php echo ($data["user_gray"]["social_liveness"]); ?></td>
        </tr>
        <tr>
          <td>社交影响力</td>
          <td><?php echo ($data["user_gray"]["social_influence"]); ?></td>
        </tr>
        <tr>
          <td>是否种子号</td>
          <td><?php echo ($data["user_gray"]["has_report"]); ?> (是否成功产生过蜜蜂报告)</td>
        </tr>
        <tr>
          <td>最近活跃时间</td>
          <td><?php echo ($data["user_gray"]["recent_active_time"]); ?> (以下联系人信息的统计窗口在最近活跃时间的前半年内)</td>
        </tr>
        <tr>
          <td>被标记的黑名单分类</td>
          <td><?php echo ($data["user_blacklist"]["blacklist_category"]); ?></td>
        </tr>
        <tr>
          <td>姓名和手机是否在黑名单</td>
          <td><?php echo ($data["user_blacklist"]["blacklist_name_with_phone"]); ?></td>
        </tr>
        <tr>
          <td>姓名和手机黑名单信息更新时间</td>
          <td><?php echo ($data["user_blacklist"]["blacklist_update_time_name_phone"]); ?></td>
        </tr>
        <tr>
          <td>身份证和姓名是否在黑名单</td>
          <td><?php echo ($data["user_blacklist"]["blacklist_name_with_idcard"]); ?></td>
        </tr>
        <tr>
          <td>身份证和姓名黑名单信息更新时间</td>
          <td><?php echo ($data["user_blacklist"]["blacklist_update_time_name_idcard"]); ?></td>
        </tr>
      </table>
      <h2>黑名单详细信息</h2>
      <table class="table table-bordered table-striped">
        <tr>
          <td>名称</td>
          <td>内容</td>
        </tr>
        <?php if(is_array($data["user_blacklist"]["blacklist_details"])): foreach($data["user_blacklist"]["blacklist_details"] as $key=>$item): ?><tr>
          <td><?php echo ($item["details_key"]); ?></td>
          <td><?php echo ($item["details_value"]); ?></td>
        </tr><?php endforeach; endif; ?>
      </table>
    </div>
  </div>
  <div class="panel">
    <div class="panel-heading">联系人数相关字段</div>
    <div class="panel-body">
      <table class="table table-bordered table-striped">
        <tr>
          <td>主动联系人数</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["cnt_to_all"]); ?></td>
        </tr>
        <tr>
          <td>主动联系人数在群体中的百分位</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["pct_cnt_to_all"]); ?></td>
        </tr>
        <tr>
          <td>主动联系的黑号数</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["cnt_to_black"]); ?></td>
        </tr>
        <tr>
          <td>主动联系的黑号数在群体中的百分位</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["pct_cnt_to_black"]); ?></td>
        </tr>
        <tr>
          <td>主动联系人中曾为申请人的人数</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["cnt_to_applied"]); ?></td>
        </tr>
        <tr>
          <td>主动联系人曾为申请人的人数在群体中的百分位</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["pct_cnt_to_applied"]); ?></td>
        </tr>
        <tr>
          <td>被动联系人数</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["cnt_be_all"]); ?></td>
        </tr>
        <tr>
          <td>被动联系人数在群体中的百分位</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["pct_cnt_be_all"]); ?></td>
        </tr>
        <tr>
          <td>被动联系的黑号数</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["cnt_be_black"]); ?></td>
        </tr>
        <tr>
          <td>被动联系的黑号数在群体中的百分位</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["pct_cnt_be_black"]); ?></td>
        </tr>
        <tr>
          <td>被动联系人中曾为申请人的人数</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["cnt_be_applied"]); ?></td>
        </tr>
        <tr>
          <td>被动联系人中曾为申请人的人数在群体中百分位</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["pct_cnt_be_applied"]); ?></td>
        </tr>
        <tr>
          <td>一阶联系人总数(主动、被动联系人数合并去重)</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["cnt_all"]); ?></td>
        </tr>
        <tr>
          <td>一阶联系人数在群体中的百分位</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["pct_cnt_all"]); ?></td>
        </tr>
        <tr>
          <td>一阶联系(直接联系)黑号总数</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["cnt_black"]); ?></td>
        </tr>
        <tr>
          <td>一阶联系黑号数在群体中的百分位</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["pct_cnt_black"]); ?></td>
        </tr>
        <tr>
          <td>二阶联系(间接联系)黑号总数</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["cnt_black2"]); ?></td>
        </tr>
        <tr>
          <td>二阶联系黑号总数在群体中的百分位</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["pct_cnt_black2"]); ?></td>
        </tr>
        <tr>
          <td>联系人曾为申请人的人数</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["cnt_applied"]); ?></td>
        </tr>
        <tr>
          <td>联系人曾为申请人的人数在群体中的百分位</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["pct_cnt_applied"]); ?></td>
        </tr>
        <tr>
          <td>一阶联系人黑号数占比</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["black_ratio"]); ?></td>
        </tr>
        <tr>
          <td>一阶联系人黑号数占比在群体中的百分位</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["pct_black_ratio"]); ?></td>
        </tr>
        <tr>
          <td>引起黑名单的一阶联系人数</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["cnt_router"]); ?></td>
        </tr>
        <tr>
          <td>引起黑名单的一阶联系人数在群体中的百分位</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["pct_cnt_router"]); ?></td>
        </tr>
        <tr>
          <td>引起黑名单的一阶联系人数占比</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["router_ratio"]); ?></td>
        </tr>
        <tr>
          <td>引起黑名单的一阶联系人数占比在群体中百分位</td>
          <td><?php echo ($data["user_gray"]["contacts_number_statistic"]["pct_router_ratio"]); ?></td>
        </tr>
      </table>
    </div>
  </div>
</div>


    <!-- /主体 -->
    <!-- 底部 -->
    
<script src="//cdn.bootcss.com/zui/1.9.0/lib/jquery/jquery.js"></script>
<script src="//cdn.bootcss.com/zui/1.9.0/js/zui.min.js"></script>


    
<script>
</script>


  </body>
</html>