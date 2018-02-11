<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
    	if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}else{
    		//已登录
    		$this->display();
    	}
    }
}