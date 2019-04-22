<?php

namespace Admin\Controller;

use Think\Controller;

class ProductController extends RootController {

    function type_list()
    {
        $ProductType = M('ProductType');
        $type_list = $ProductType->select();
        $this->type_list = $type_list;
        $this->display();
    }

    function type_edit()
    {
        $ProductType = M('ProdcutType');
        if ( ! $_POST) {
            $id = I('get.id');
            $type_info = $ProductType->where(['id' => $id])->find();
            $this->type_info = $type_info;
            $this->display();
        } else {
            $id = I('post.id');
            $update_data = [
                'name' => I('post.name')
            ];
            $ProductType->where(['id' => $id])->save($update_data);
            $this->redirect('/admin/product/type_list');
        }
    }

    function product_list()
    {
        $Product = M('Product');
        $product_list = $Product->field('a.*, b.name as type')
            ->table('t_product a')
            ->join('t_product_type b ON a.type = b.id')
            ->select();
        $this->product_list = $product_list;
        $this->display();
    }

    function product_edit()
    {
        $Product = M('Prodcut');
        $ProductType = M('ProdcutType');
        if ( ! $_POST) {
            $id = I('get.id');
            $product_info = $Product->where(['id' => $id])->find();
            $type_list = $ProductType->select();
            $this->product_info = $product_info;
            $this->type_list = $type_list;
            $this->display();
        } else {
            $id = I('post.id');
            $update_data = [
                'type' => I('post.type'),
                'name' => I('post.name'),
                'desc' => I('post.desc'),
                'price' => I('post.price'),
                'updated_time' => time()
            ];
            $Product->where(['id' => $id])->save($update_data);
            $this->redirect('/admin/product/product_list');
        }
    }
}
