<?php

namespace Common\Model;

use Think\Model;

class TopAllModel extends Model {

     function addTop($bid, $type, $num) {
        if ($this->where('bid = ' . $bid)->find()) {

            $this->where('bid = ' . $bid)->setInc($type, $num);
        } else {
            $data['bid'] = $bid;
            $data[$type] = $num;

            $this->add($data);
        }
    }

}

?>
