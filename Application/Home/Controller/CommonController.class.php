<?php
namespace Home\Controller;
use Think\Controller;

class CommonController extends Controller{

	protected $is_login;
	protected $user_id;
	protected $username;
	protected $nickname;
	public function _initialize(){
		if (isset($_SESSION['id'])) {

			//已登录
			$this->is_login = true;
			$this->user_id = $_SESSION['id'];
			$this->username = $_SESSION['username'];
			$this->nickname = $_SESSION['nickname'];

			$this->assign("isLogin",$this->is_login);
			$this->assign("id",$this->id);
			$this->assign("username",$this->username);
			$this->assign("nickname",M('User')->where('id = ' . $this->user_id)->getField('nickname'));
		}else{
			$this->is_login = false;
			$this->id = 0;
			$this->username = "";
		}
	}
}

?>