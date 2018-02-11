<?php
namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller{

	protected $is_login;
	protected $admin_id;

	public function _initialize(){
		if (isset($_COOKIE['admin_id']) && isset($_SESSION['admin_id'])) {

			//已登录
			$this->is_login = true;
			$this->admin_id = $_SESSION['admin_id'];
		}else{
			$this->is_login = false;
			$this->admin_id = 0;
		}
	}
}

?>