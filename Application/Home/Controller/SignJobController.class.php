<?php
namespace Home\Controller;
use Think\Controller;

class SignJobController extends CommonController{
	public function index(){
		if (!$this->is_login) {
			$this->error("抱歉，该模块需要登录",U('Login/index'));
		}
		//判断是否已经登记过
		if (M('SignJob')->where('user_id = ' . $this->user_id)->find()) {
			redirect(U('Search/result',array('phone' => $this->username)));
		}
		//国家信息
		$this->assign('country',M('Country')->select());
		$this->display();
	}

	public function addRecord(){
		$post = I('post.');
		$record = array(
				'user_id' => $this->user_id,
				'name' => trim($post['name']),
				'phone' => $this->username,
				'country_id' => (int)$post['country'],
				'sex' => (int)$post['sex'],
				'wechat' => trim($post['wechat']),
				'status1' => 0,
				'status2' => 0,
				'time' => time()
			);
		$query = M('SignJob')->add($record);
		if ($query) {
			//发送邮件到管理员
			$title = "[ " . $record['name'] . " ] - 登记了工作";
			$message = "姓名:{$record['name']}\n电话:{$record['phone']}\n微信:{$record['wechat']}";
			sendEmail($title,$message);
			$this->success("登记成功",U('Search/result',array('phone' => $this->username)));
		}else{
			$this->error("登记失败,请联系管理员");
		}
	}
}
?>