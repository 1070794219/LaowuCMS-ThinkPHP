<?php
namespace Admin\Controller;
use Think\Controller;

class LoginController extends CommonController{
	public function index(){
		$this->display();
	}

	public function login(){
		$post = I('post.');
		$username = trim($post['username']);
		$pwd = trim($post['password']);
		$admin = M('Admin')->where("username = '{$username}'")->find();
		if ($admin && md5($pwd) == $admin['password']) {
			//登录成功
			session('admin_id',$admin['id']);
			cookie('admin_id',$admin['id']);
			redirect(U('Admin/Index/index'));
		}else{
			$this->error('登录失败，账号或密码不正确');
		}
	}

	public function logout(){
		session('admin_id',null);
		cookie('admin_id',null);
		redirect(U('Admin/Login/index'));
	}
}
?>