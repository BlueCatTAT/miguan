<?php

namespace Wap\Controller;

use Think\Controller;

class SearchController extends Controller {

    protected $_account = 'shaoyang';
    protected $_app_id  = '780bbf7c7d094461b9d2982e66f803d7';
    protected $_app_key = '74b0a11a86a044a5b30bdade08218a50';
    protected $_miguan_token_url = 'https://mi.juxinli.com/api/access_token';
    protected $_miguan_search_url = 'https://mi.juxinli.com/api/search';

    function report() {
        if ($_POST) {
            $token = $this->_get_token();
            $get_data = [
                'name'          => I('post.name'),
                'id_card'       => I('post.id_card'),
                'phone'         => I('post.phone'),
                'client_secret' => $this->_app_key,
                'access_token'  => $token,
                'version'       => 'v3'
            ];
            $url = $this->_miguan_search_url . '?' . http_build_query($get_data);
            $data = curl_get($url);
            //$data = '{"data":{"auth_org":"shaoyang","consumer_label":{"cst_score_finally":62,"if_fin_buy_pre6":1,"if_own_car":0,"if_own_cc":0,"if_own_wg_cc":0,"if_pay_ins":0},"iou_statistic":{"d30_iou_platform_cnt":0,"d30_iou_query_times":0,"d360_iou_platform_cnt":0,"d360_iou_query_times":0,"d90_iou_platform_cnt":0,"d90_iou_query_times":0,"in_repayment_amount":0.0,"in_repayment_interest":0.0,"in_repayment_times":0,"overdue_amount":0.0,"overdue_interest":0.0,"overdue_payment_amount":0.0,"overdue_payment_interest":0.0,"overdue_payment_times":0,"overdue_times":0,"recent_iou_status":null,"recent_loan_time":null,"recent_pay_back_time":null,"total_loan_amount":0.0,"total_loan_times":0},"update_time":1554794621726,"user_basic":{"user_age":29,"user_city":"郑州市","user_gender":"男","user_idcard":"410181198905104557","user_idcard_valid":true,"user_name":"晋京","user_phone":"13683582516","user_phone_city":"北京","user_phone_operator":"中国移动","user_phone_province":"北京","user_province":"河南省","user_region":"巩义市"},"user_batch_searched_history_by_orgs":[],"user_blacklist":{"blacklist_category":[],"blacklist_details":[],"blacklist_name_with_idcard":false,"blacklist_name_with_phone":false,"blacklist_update_time_name_idcard":"","blacklist_update_time_name_phone":""},"user_gray":{"contacts_closest":{"weight_all":72.51,"weight_applied":72.51,"weight_be_all":25.7,"weight_be_applied":25.7,"weight_be_black":null,"weight_black":null,"weight_to_all":50.63,"weight_to_applied":50.63,"weight_to_black":null},"contacts_gray_score":{"be_max":36.97,"be_mean":36.13,"be_min":35.29,"max":39.56,"mean":37.27,"min":35.29,"most_familiar_all":35.29,"most_familiar_applied":35.29,"most_familiar_be_all":36.97,"most_familiar_be_applied":36.97,"most_familiar_to_all":35.29,"most_familiar_to_applied":35.29,"to_max":39.56,"to_mean":37.43,"to_min":35.29},"contacts_number_statistic":{"black_ratio":0.0,"cnt_all":3,"cnt_applied":3,"cnt_be_all":2,"cnt_be_applied":2,"cnt_be_black":0,"cnt_black":0,"cnt_black2":3,"cnt_router":1,"cnt_to_all":2,"cnt_to_applied":2,"cnt_to_black":0,"pct_black_ratio":0.92056143,"pct_cnt_all":0.6438177,"pct_cnt_applied":0.64439553,"pct_cnt_be_all":0.615683,"pct_cnt_be_applied":0.6163008,"pct_cnt_be_black":0.9393841,"pct_cnt_black":0.9205507,"pct_cnt_black2":0.5666154,"pct_cnt_router":0.5312053,"pct_cnt_to_all":0.6902618,"pct_cnt_to_applied":0.6907821,"pct_cnt_to_black":0.95052785,"pct_router_ratio":0.31671473,"router_ratio":0.3333333333333333},"contacts_query":{"be_org_cnt_05":1,"be_org_cnt_1":4,"be_org_cnt_12":23,"be_org_cnt_2":11,"be_org_cnt_3":11,"be_org_cnt_6":19,"be_org_cnt_9":22,"be_query_cnt_05":2,"be_query_cnt_1":5,"be_query_cnt_12":86,"be_query_cnt_2":17,"be_query_cnt_3":20,"be_query_cnt_6":60,"be_query_cnt_9":78,"be_recent_query_time":1553382808528,"org_cnt_05":2,"org_cnt_1":5,"org_cnt_12":25,"org_cnt_2":12,"org_cnt_3":12,"org_cnt_6":20,"org_cnt_9":24,"query_cnt_05":3,"query_cnt_1":6,"query_cnt_12":94,"query_cnt_2":18,"query_cnt_3":21,"query_cnt_6":62,"query_cnt_9":86,"to_org_cnt_05":1,"to_org_cnt_1":2,"to_org_cnt_12":10,"to_org_cnt_2":4,"to_org_cnt_3":4,"to_org_cnt_6":5,"to_org_cnt_9":10,"to_query_cnt_05":1,"to_query_cnt_1":2,"to_query_cnt_12":24,"to_query_cnt_2":5,"to_query_cnt_3":9,"to_query_cnt_6":15,"to_query_cnt_9":23,"to_recent_query_time":1552127535749},"contacts_relation_distribution":{"be_is_familiar":0,"be_median_familiar":0,"be_not_familiar":2,"is_familiar":0,"median_familiar":1,"not_familiar":2,"to_is_familiar":0,"to_median_familiar":2,"to_not_familiar":0},"contacts_rfm":{"call_cnt_be_all":2,"call_cnt_be_applied":2,"call_cnt_be_black":null,"call_cnt_to_all":2,"call_cnt_to_applied":2,"call_cnt_to_black":null,"recent_time_be_all":1532143055000,"recent_time_be_applied":1532143055000,"recent_time_be_black":null,"recent_time_to_all":1532140545000,"recent_time_to_applied":1532140545000,"recent_time_to_black":null,"time_spent_be_all":89,"time_spent_be_applied":89,"time_spent_be_black":null,"time_spent_to_all":182,"time_spent_to_applied":182,"time_spent_to_black":null},"has_report":false,"phone_gray_score":67.24,"recent_active_time":1532143055000,"social_influence":32.41,"social_liveness":50.02,"user_phone":"13683582516"},"user_grid_id":"66c59dbc-5a98-11e9-a5dd-525400147314-6962","user_idcard_suspicion":{"idcard_applied_in_orgs":[],"idcard_with_other_names":[],"idcard_with_other_phones":[]},"user_phone_suspicion":{"phone_applied_in_orgs":[],"phone_with_other_idcards":[],"phone_with_other_names":[]},"user_register_orgs":{"phone_num":"13683582516","register_cnt":null,"register_orgs_statistics":[]},"user_searched_history_by_day":{"d_15":{"cnt":0,"cnt_cash":0,"cnt_cc":0,"cnt_cf":0,"cnt_org":0,"cnt_org_cash":0,"cnt_org_cc":0,"cnt_org_cf":0,"pct_cnt_all":0.0,"pct_cnt_cash":0.0,"pct_cnt_cc":0.0,"pct_cnt_cf":0.0,"pct_cnt_org_all":0.0,"pct_cnt_org_cash":0.0,"pct_cnt_org_cc":0.0,"pct_cnt_org_cf":0.0},"d_30":{"cnt":0,"cnt_cash":0,"cnt_cc":0,"cnt_cf":0,"cnt_org":0,"cnt_org_cash":0,"cnt_org_cc":0,"cnt_org_cf":0,"pct_cnt_all":0.0,"pct_cnt_cash":0.0,"pct_cnt_cc":0.0,"pct_cnt_cf":0.0,"pct_cnt_org_all":0.0,"pct_cnt_org_cash":0.0,"pct_cnt_org_cc":0.0,"pct_cnt_org_cf":0.0},"d_60":{"cnt":0,"cnt_cash":0,"cnt_cc":0,"cnt_cf":0,"cnt_org":0,"cnt_org_cash":0,"cnt_org_cc":0,"cnt_org_cf":0,"pct_cnt_all":0.0,"pct_cnt_cash":0.0,"pct_cnt_cc":0.0,"pct_cnt_cf":0.0,"pct_cnt_org_all":0.0,"pct_cnt_org_cash":0.0,"pct_cnt_org_cc":0.0,"pct_cnt_org_cf":0.0},"d_7":{"cnt":0,"cnt_cash":0,"cnt_cc":0,"cnt_cf":0,"cnt_org":0,"cnt_org_cash":0,"cnt_org_cc":0,"cnt_org_cf":0,"pct_cnt_all":0.0,"pct_cnt_cash":0.0,"pct_cnt_cc":0.0,"pct_cnt_cf":0.0,"pct_cnt_org_all":0.0,"pct_cnt_org_cash":0.0,"pct_cnt_org_cc":0.0,"pct_cnt_org_cf":0.0},"d_90":{"cnt":0,"cnt_cash":0,"cnt_cc":0,"cnt_cf":0,"cnt_org":0,"cnt_org_cash":0,"cnt_org_cc":0,"cnt_org_cf":0,"pct_cnt_all":0.0,"pct_cnt_cash":0.0,"pct_cnt_cc":0.0,"pct_cnt_cf":0.0,"pct_cnt_org_all":0.0,"pct_cnt_org_cash":0.0,"pct_cnt_org_cc":0.0,"pct_cnt_org_cf":0.0},"m_12":{"cnt":0,"cnt_cash":0,"cnt_cc":0,"cnt_cf":0,"cnt_org":0,"cnt_org_cash":0,"cnt_org_cc":0,"cnt_org_cf":0,"pct_cnt_all":0.0,"pct_cnt_cash":0.0,"pct_cnt_cc":0.0,"pct_cnt_cf":0.0,"pct_cnt_org_all":0.0,"pct_cnt_org_cash":0.0,"pct_cnt_org_cc":0.0,"pct_cnt_org_cf":0.0},"m_18":{"cnt":0,"cnt_cash":0,"cnt_cc":0,"cnt_cf":0,"cnt_org":0,"cnt_org_cash":0,"cnt_org_cc":0,"cnt_org_cf":0,"pct_cnt_all":0.0,"pct_cnt_cash":0.0,"pct_cnt_cc":0.0,"pct_cnt_cf":0.0,"pct_cnt_org_all":0.0,"pct_cnt_org_cash":0.0,"pct_cnt_org_cc":0.0,"pct_cnt_org_cf":0.0},"m_24":{"cnt":0,"cnt_cash":0,"cnt_cc":0,"cnt_cf":0,"cnt_org":0,"cnt_org_cash":0,"cnt_org_cc":0,"cnt_org_cf":0,"pct_cnt_all":0.0,"pct_cnt_cash":0.0,"pct_cnt_cc":0.0,"pct_cnt_cf":0.0,"pct_cnt_org_all":0.0,"pct_cnt_org_cash":0.0,"pct_cnt_org_cc":0.0,"pct_cnt_org_cf":0.0},"m_4":{"cnt":0,"cnt_cash":0,"cnt_cc":0,"cnt_cf":0,"cnt_org":0,"cnt_org_cash":0,"cnt_org_cc":0,"cnt_org_cf":0,"pct_cnt_all":0.0,"pct_cnt_cash":0.0,"pct_cnt_cc":0.0,"pct_cnt_cf":0.0,"pct_cnt_org_all":0.0,"pct_cnt_org_cash":0.0,"pct_cnt_org_cc":0.0,"pct_cnt_org_cf":0.0},"m_5":{"cnt":0,"cnt_cash":0,"cnt_cc":0,"cnt_cf":0,"cnt_org":0,"cnt_org_cash":0,"cnt_org_cc":0,"cnt_org_cf":0,"pct_cnt_all":0.0,"pct_cnt_cash":0.0,"pct_cnt_cc":0.0,"pct_cnt_cf":0.0,"pct_cnt_org_all":0.0,"pct_cnt_org_cash":0.0,"pct_cnt_org_cc":0.0,"pct_cnt_org_cf":0.0},"m_6":{"cnt":0,"cnt_cash":0,"cnt_cc":0,"cnt_cf":0,"cnt_org":0,"cnt_org_cash":0,"cnt_org_cc":0,"cnt_org_cf":0,"pct_cnt_all":0.0,"pct_cnt_cash":0.0,"pct_cnt_cc":0.0,"pct_cnt_cf":0.0,"pct_cnt_org_all":0.0,"pct_cnt_org_cash":0.0,"pct_cnt_org_cc":0.0,"pct_cnt_org_cf":0.0},"m_9":{"cnt":0,"cnt_cash":0,"cnt_cc":0,"cnt_cf":0,"cnt_org":0,"cnt_org_cash":0,"cnt_org_cc":0,"cnt_org_cf":0,"pct_cnt_all":0.0,"pct_cnt_cash":0.0,"pct_cnt_cc":0.0,"pct_cnt_cf":0.0,"pct_cnt_org_all":0.0,"pct_cnt_org_cash":0.0,"pct_cnt_org_cc":0.0,"pct_cnt_org_cf":0.0}},"user_searched_history_by_orgs":[{"org_self":true,"searched_date":"2019-04-09","searched_org":"线下抵押贷款"}],"user_searched_statistic":{"searched_org_cnt":1}},"message":"获取蜜罐查询成功","spend_time":196,"code":"MIGUAN_SEARCH_SUCCESS"}';
            $data = json_decode($data, true);
            if ($data['code'] != 'MIGUAN_SEARCH_SUCCESS') {
                $this->error($data['message']);
            }
            $this->data = $data['data'];
            $this->display();
        } else {
            $this->display('search');
        }
    }

    function _get_token()
    {
        $url = $this->_miguan_token_url . '?client_secret=' . $this->_app_key . '&account=' . $this->_account;
        $token_res = curl_get($url);
        $token_res = json_decode($token_res, true);
        if ($token_res['code'] != 'MIGUAN_ACCESS_SUCCESS') {
            $this->error($token_res['message']);
        }
        return $token_res['data']['access_token'];
    }
}
