<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends CommonController{
	public function index(){
		$this->display('login');
	}

	//注册
	public function register(){
		$this->display();
	}

	//增加账号
	public function addUser(){
		$post = I('post.');
		$from_id = (int)$post['f'];
		$user = array(
				'username' => $post['username'],
				'password' => md5($post['password']),
				'nickname' => "用户" . $post['username'],
				'fans' => 0,
				'status' => 0
			);
		$query = M('User')->add($user);
		if ($query) {
			//设置金额
			$id = M('User')->where('username = ' . $user['username'])->getField('id');
			$funds = array(
					'user_id' => $id,
					'funds' => 0
				);
			$query = M('UserFunds')->add($funds);
			if ($query) {
				//推广用户系统
				if (!empty($from_id)) {
					$this->addFans($from_id);
				}
				$this->success("注册成功");
			}else{
				$this->error("注册失败");
			}
		}else{
			$this->error("注册失败");
		}
	}

	//登录
	public function login(){
		$post = I('post.');

		if (!IS_POST) {
			$this->error("非法请求");
		}
		$db = M('User');
		$user = $db->where('username = ' . $post['username'])->find();
		if (!$user || $user['password'] != md5($post['password'])) {
			$this->error("账号或密码错误");	
		}
		if ((int)$user['forbid'] == 1) {
			$this->error("账号已被加入黑名单");
		}
		//登录成功
		session('id',$user['id']);
		session('username',$user['username']);

		//判断是否有未读消息
		$not_read = M('UserMessage')->where('user_id = ' . $user['id'] . ' and status = 0')->count();
		if ($not_read) {
			//有未读消息
			redirect(U('User/index',array('type' => 'nr')));
		}else{
			redirect(U('Index/index'));
		}
	}

	//退出
	public function logout(){
		if (!isset($_SESSION['id'])) {
			$this->error("非法请求");
		}

		session('id',null);
		session('username',null);
		redirect(U('Index/index'));
	}

	//增加推广人员
	public function addFans($from_id){
		$fans = (int)(M('User')->where('id = ' . $from_id)->getField('fans'));
		$fans++;
		$funds = (float)(M('UserFunds')->where('user_id = ' . $from_id)->getField('funds'));
		$funds += C('reward');
		M('User')->where('id = ' . $from_id)->setField('fans',$fans);
		M('UserFunds')->where('user_id = ' . $from_id)->setField('funds',$funds);
	}
}
?>