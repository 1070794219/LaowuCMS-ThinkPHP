<?php
namespace Home\Controller;
use Think\Controller;

class UserController extends CommonController{
	public function index(){
		if (!$this->is_login) {
			$this->error("请登录",U('Login/index'));
		}
		$this->display();
	}

	public function myInfo(){
		if (!$this->is_login) {
			$this->error("请登录",U('Login/index'));
		}
		$user = M('User')->where('id = ' . $this->user_id)->find();
		if (!$user) {
			$this->error("非法请求");
		}
		$this->assign('user',$user);
		$this->assign('reward',M('UserFunds')->where('user_id = ' . $this->user_id)->getField('all_funds'));
		$this->display();
	}

	//推广系统
	public function popularize(){
		if (!$this->is_login) {
			$this->error("请登录",U('Login/index'));
		}
		//http https
		$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
		$url = $http_type . $_SERVER['HTTP_HOST'] . U('Login/register');
		$url .= "?f=" . $this->user_id;
		// $apiurl = "http://www.suo.im/api.php?format=json&url=" . urlencode($url);
		// $ch = curl_init();
	 //    curl_setopt($ch, CURLOPT_URL, $apiurl);
	 //    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	 //    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FASLE);
	 //    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	 //    $output = curl_exec($ch);
	 //    $error = curl_error($ch);
	 //    curl_close($ch);
	 //    $resultArr = json_decode($output, true);//将json转为数组格式数据

		$this->assign('url',$url);
		// $this->assign('murl',$resultArr["url"]);
		$this->display();
	}

	//提现
	public function deposit(){
		if (!$this->is_login) {
			$this->error("请登录",U('Login/index'));
		}
		$this->assign('user',M('User')->where('id = ' . $this->user_id)->find());
		$this->assign('reward',M('UserFunds')->where('user_id = ' . $this->user_id)->getField('funds'));
		$this->display();
	}

	//保存用户信息
	public function saveInfo(){
		if (!$this->is_login) {
			$this->error("请登录",U('Login/index'));
		}
		$post = I('post.');
		if ($post['type'] == 'info') {
			$query = M('User')->where('id = ' . $this->user_id)->save($post);
		}else{
			$query = M('User')->where('id = ' . $this->user_id)->setField('password',md5($post['password']));
		}
		if ($query) {
			$this->success("保存成功");
		}else{
			$this->error("保存失败");
		}
	}

	//提现
	public function withdraw(){
		if (!$this->is_login) {
			$this->error("请登录",U('Login/index'));
		}
		$post = I('post.');
		//首先验证验证码是否有效
		$verify = (int)$post['verify'];
		$send_verify = M('Verify')->where("phone = {$this->username} and type = 2")->order('time desc')->find();
		if (!$send_verify || $verify != (int)$send_verify['verify'] || time() - (int)$send_verify['time'] > 300) {
			$this->error("验证码无效");
		}
		$money = (float)I('post.money');
		if (empty($money)) {
			$this->error("请不要随意提交");
		}else if($money < 500){
			$this->error("提现金额最低为500元");
		}else{
			$funds = (float)(M('UserFunds')->where('user_id = ' . $this->user_id)->getField('funds'));
			if ($money > $funds) {
				$this->error("余额不足");
			}
			$funds -= $money;
			$query = M('UserFunds')->where('user_id = ' . $this->user_id)->setField('funds',$funds);
			if ($query) {
				$detail = array(
						'user_id' => $this->user_id,
						'money' => $money,
						'status' => 0,
						'time' => time()
					);

				M('UserFundsDetail')->add($detail);
				$this->success("申请成功,审核后将提现到您的账户上");
			}else{
				$this->error("申请失败");
			}

		}
	}

	//系统消息
	public function messages(){
		if (!$this->is_login) {
			$this->error("请登录",U('Login/index'));
		}
		$this->display();
	}

	public function getMessages(){
		if (!$this->is_login) {
			$this->error("请登录",U('Login/index'));
		}
		$page = (int)I('get.page');
		$limit = (int)I('get.limit');
		$query['code'] = 0;
		$query['msg'] = "";
		$query['count'] = (int)(M('UserMessage')->where('user_id = ' . $this->user_id)->count());
		$query['data'] = M('UserMessage')->where('user_id = ' . $this->user_id)->order('id desc')->limit(($page-1)*$limit,$page*$limit)->select();
		foreach($query['data'] as &$one){
			$one['status'] = ($one['status'] == 0 ? '<span class="layui-badge">未读</span>' : '<span class="layui-badge layui-bg-gray">已读</span>');
			$db = M('Message')->where('id = ' . $one['message_id'])->find();
			$one['title'] = $db['title'];
			$one['time'] = date("Y-m-d",$db['time']);
		}
		echo json_encode($query);
	}

	public function messageDetail(){
		$id = (int)I('get.id');
		$query = M('Message')->where('id = ' . $id)->find();
		//设置已读
		M('UserMessage')->where('message_id = ' . $id . ' and user_id = ' . $this->user_id)->setField('status',1);
		$this->assign('arc',$query);
		$this->display();
	}

	//反馈总公司
	public function sendCompany(){
		$this->display();
	}

	public function sendFunc(){
		if (!$this->is_login) {
			$this->error("请登录",U('Login/index'));
		}

		$post = I('post.');
		$title = $post['title'];
		$body = $post['body'];
		$user = M('User')->where('id = ' . $this->user_id)->find();

		$message = "用户[{$user['nickname']}]({$user['username']})-向您反馈了一条信息";
		$body = "标题:" . $title . "<br/>正文:" . $body;
		sendEmail($message,$body);
		$this->success("反馈成功");
	}

	//提现验证码
	public function sendMessage(){
		$post = I('post.');
		$phone = $this->username;
		$type = 2;
		//随机生成验证码
		$code = rand(1000,10000);

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

	//宣传海报
	public function post(){
		$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
		$url = $http_type . $_SERVER['HTTP_HOST'] . U('Login/register');
		$url .= "?f=" . $this->user_id;
		$this->assign('url',$url);
		$this->display();
	}
}

?>