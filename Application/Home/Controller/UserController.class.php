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
		$this->assign('reward',M('UserFunds')->where('user_id = ' . $this->user_id)->getField('funds'));
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
		$this->assign('url',$url);
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
		M('UserMessage')->where('id = ' . $id . ' and user_id = ' . $this->user_id)->setField('status',1);
		$this->assign('arc',$query);
		$this->display();
	}
}

?>