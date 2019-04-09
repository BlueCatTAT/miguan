<?php

//根据book表里面cid获取章节标题
function getChaptTitle($id){
    return M("Chapter")->where(array('id'=>$id))->getField('title');
}

//根据book表里面wid获取作者名称
function getWname($id){
    return M("Writer")->where(array('id'=>$id))->getField('wname');
}