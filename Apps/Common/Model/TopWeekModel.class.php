<?php

namespace Common\Model;

use Think\Model;

class TopWeekModel extends Model {

    function addTop($bid, $type, $num) {
        $week = date('Y-W', time());
        if ($this->where('bid = ' . $bid . ' and week = "' . $week . '"')->find()) {

            $this->where('bid = ' . $bid . ' and week = "' . $week . '"')->setInc($type, $num);
        } else {
            $data['bid'] = $bid;
            $data['week'] = $week;
            $data[$type] = $num;

            $this->add($data);
        }
    }

}

?>
