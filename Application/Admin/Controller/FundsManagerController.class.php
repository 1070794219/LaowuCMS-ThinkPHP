<?php
namespace Admin\Controller;
use Think\Controller;

class FundsManagerController extends CommonController{
	public function index(){
		$this->display();
	}

	public function funds(){
		if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}
		$page = (int)I('get.page');
		$limit = (int)I('get.limit');
		$query['code'] = 0;
		$query['msg'] = "";
		$query['count'] = (int)(M('UserFundsDetail')->count());
		$query['data'] = M('UserFundsDetail')->order('time desc')->limit(($page-1)*$limit,$page*$limit)->select();
		foreach($query['data'] as &$one){
			$one['time'] = date("Y-m-d",$one['time']);
			$one['status'] = ((int)$one['status'] == 0 ? '<button class="layui-btn layui-btn-xs layui-btn-disabled">未处理</button>' : '<button class="layui-btn layui-btn-xs layui-btn-normal">已处理</button>');
			$one['nickname'] = M('User')->where("id = {$one['user_id']}")->getField('nickname');
		}
		echo json_encode($query);
	}

	public function userInfo(){
		if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}
    	$id = (int)$_GET['user_id'];
    	$this->assign('user',M('User')->where("id = {$id}")->find());
    	$this->display();
	}

	public function affirm(){
		if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}
    	$id = (int)$_GET['id'];

    	$query = M('UserFundsDetail')->where("id = {$id}")->setField('status',1);
    	if ($query) {
    		$this->success("处理成功");
    	}else{
    		$this->error("处理失败");
    	}
	}

		public function delete(){
		if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}
    	$id = (int)$_GET['id'];

    	$query = M('UserFundsDetail')->where("id = {$id}")->delete();
    	if ($query) {
    		$this->success("处理成功");
    	}else{
    		$this->error("处理失败");
    	}
	}
}
?>