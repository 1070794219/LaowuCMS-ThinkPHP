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
		//首先验证验证码是否有效
		$verify = (int)$post['verify'];
		$send_verify = M('Verify')->where("phone = {$post['username']} and type = 0")->order('time desc')->find();
		if (!$send_verify || $verify != (int)$send_verify['verify'] || time() - (int)$send_verify['time'] > 300) {
			$this->error("验证码无效");
		}
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
				//登录成功
				session('id',$id);
				session('username',$user['username']);
				$this->success("注册成功",U('Index/index'));
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
		if (!$user) {
			$this->error("账号不存在");	
		}else if($user['password'] != md5($post['password'])){
			$wrong = (int)$user['wrong'];
			//如果超过三次
			if ($wrong >= 3) {
				//跳转
				$this->loginWithCode($post['username'],$post['password']);
			}else{
				$wrong++;
				M('User')->where('username = ' . $post['username'])->setField('wrong',$wrong);
				//否则提示错误
				$this->error("账号或密码错误");
			}
			
		}else{

			//密码正确也要验证
			$wrong = (int)$user['wrong'];
			//如果超过三次
			if ($wrong >= 3) {
				//跳转
				$this->loginWithCode($post['username'],$post['password']);
			}else{
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
		}
	}

	public function loginWithCode($username,$password){
		//发送验证码
		//找到最近一条登录验证码
		$verify = M('Verify')->where("phone = '{$username}' and type = 1")->order('time desc')->find();
		if (!$verify || time() - (int)($verify['time']) > 300) {
			//不存在或者验证码失效
			$code = rand(1000,10000);
			sendMessage($username,$code,1);
		}

		//传输账号密码
		$this->assign('username',$username);
		$this->assign('password',$password);
		$this->display('loginWithCode');
	}

	public function loginWithCodeFunc(){
		$post = I('post.');

		if (!IS_POST) {
			$this->error("非法请求");
		}
		$db = M('User');
		$user = $db->where('username = ' . $post['username'])->find();
		if (!$user) {
			$this->error("账号不存在");	
		}else if($user['password'] != md5($post['password'])){
			$wrong = (int)$user['wrong'];
			$wrong++;
			M('User')->where('username = ' . $post['username'])->setField('wrong',$wrong);
			//否则提示错误
			$this->error("账号或密码错误",U('Login/index'));
		}
		$code = $post['verify'];
		$verify = M('Verify')->where("phone = '{$post['username']}' and type = 1")->order('time desc')->find();
		if ($code != $verify['verify'] || time() - (int)$verify['time'] > 300) {
			$this->error("验证码无效",U('Login/index'));
		}
		if ((int)$user['forbid'] == 1) {
			$this->error("账号已被加入黑名单",U('Login/index'));
		}
		//登录成功
		M('User')->where('username = ' . $post['username'])->setField('wrong',0);
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

	//验证码
	public function sendMessage(){
		$post = I('post.');
		$phone = trim($post['phone']);
		$type = (int)$post['type'];
		//随机生成验证码
		$code = rand(1000,10000);

		//判断是否注册
		if (M('User')->where("username = {$phone}")->find()) {
			ajaxReturn("该手机号已被注册");
		}
		//判断是否已经发送验证码
		$time = time();
		$send_time = (int)(M('Verify')->where("phone = {$phone} and type = {$type}")->order('time desc')->getField('time'));
		if (!empty($send_time)) {
			if ($time - $send_time < 60) {
				ajaxReturn("请一分钟之后再重新发送");
			}
		}

		$res = sendMessage($phone,$code,$type);
		ajaxReturn($res);
	}


	//忘记密码
	public function forget(){
		$this->display();
	}

	public function forgetFunc(){
		$post = I('post.');
		//首先验证验证码是否有效
		$verify = (int)$post['verify'];
		$send_verify = M('Verify')->where("phone = {$post['username']} and type = 4")->order('time desc')->find();
		if (!$send_verify || $verify != (int)$send_verify['verify'] || time() - (int)$send_verify['time'] > 300) {
			$this->error("验证码无效");
		}

		//登录成功
		$user = M('User')->where('username = ' . $post['username'])->find();
		if ($user) {
			session('id',$user['id']);
			session('username',$user['username']);
			$this->success("登录成功,请尽快修改密码",U('User/index'));
		}else{
			$this->error("账号不存在");
		}
	} 

	//忘记密码验证码
	public function sendForgetMessage(){
		$post = I('post.');
		$phone = trim($post['phone']);
		$type = (int)$post['type'];
		//随机生成验证码
		$code = rand(1000,10000);

		//判断是否注册
		if (M('User')->where("username = {$phone}")->find()) {
					//判断是否已经发送验证码
			$time = time();
			$send_time = (int)(M('Verify')->where("phone = {$phone} and type = {$type}")->order('time desc')->getField('time'));
			if (!empty($send_time)) {
				if ($time - $send_time < 60) {
					ajaxReturn("请一分钟之后再重新发送");
				}
			}
			$res = sendMessage($phone,$code,$type);
			ajaxReturn($res);
		}else{
			ajaxReturn("账号不存在");
		}
	}
}
?>