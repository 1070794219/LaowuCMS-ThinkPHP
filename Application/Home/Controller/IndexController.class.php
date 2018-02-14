<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
    	$this->assign('arclist',M('Article')->where('type = 0')->limit(9)->select());
    	$this->display();
    }
}