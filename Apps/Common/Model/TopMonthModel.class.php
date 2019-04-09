<?php

namespace Common\Model;

use Think\Model;

class TopMonthModel extends Model {

    function addTop($bid, $type, $num) {
        $month = date('Y-m',time());
        if ($this->where('bid = ' . $bid.' and month = "'.$month.'"')->find()) {

            $this->where('bid = ' . $bid.' and month = "'.$month.'"')->setInc($type, $num);
        } else {
            $data['bid'] = $bid;
            $data['month'] = $month;
            $data[$type] = $num;

            $this->add($data);
        }
    }

}

?>
