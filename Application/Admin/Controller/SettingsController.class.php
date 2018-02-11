<?php
namespace Admin\Controller;
use Think\Controller;

class SettingsController extends CommonController{
	public function index(){
		if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}
    	//标题
    	$this->assign('webname',C('webname'));
    	//短信
    	$this->assign('sms_name',C('sms_name'));
    	$this->assign('sms_key',C('sms_key'));
    	//邮箱
    	$this->assign('email_name',C('email_name'));
    	$this->assign('email_pwd',C('email_pwd'));
    	$this->assign('email',C('email'));
		$this->display();
	}

	public function save(){
		$post = I('post.');

		C('webname',trim($post['webname']));

		C('sms_name',trim($post['sms_name']));
		C('sms_key',trim($post['sms_key']));

		C('email_name',trim($post['email_name']));
		C('email_pwd',trim($post['email_pwd']));

		C('email',trim($post['email']));

		$this->success("保存成功");
	}
}
?>