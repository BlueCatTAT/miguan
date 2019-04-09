<?php

namespace Common\Model;

use Think\Model;

class TopDailyModel extends Model {

    function addTop($bid, $type, $num) {
        $date = date('Y-m-d', time());
        if ($this->where('bid = ' . $bid . ' and date = "' . $date . '"')->find()) {

            $this->where('bid = ' . $bid . ' and date = "' . $date . '"')->setInc($type, $num);
        } else {
            $data['bid'] = $bid;
            $data['date'] = $date;
            $data[$type] = $num;

            $this->add($data);
        }
    }

}
