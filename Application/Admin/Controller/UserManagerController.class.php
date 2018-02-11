<?php
namespace Admin\Controller;
use Think\Controller;

class UserManagerController extends CommonController{
	    //登记用户管理
    public function userManager(){
    	if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}
    	$this->display();
    }
    public function getUserManager(){
    	if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}

    	$page = (int)I('get.page');
		$limit = (int)I('get.limit');

		$query['code'] = 0;
		$query['msg'] = "";
		$query['count'] = (int)(M('SignJob')->count());
		$query['data'] = M('SignJob')->order('id desc')->limit(($page-1)*$limit,$page*$limit)->select();
		foreach($query['data'] as &$one){
			$one['country'] = M('Country')->where('id = ' . $one['country_id'])->getField('name');
			$one['sex'] = ($one['sex'] == 0 ? "女" : "男");
			$one['status'] = ((int)$one['status1'] == 0 ? '<span class="layui-badge layui-bg-orange">未分配</span>' : '<span class="layui-badge layui-bg-cyan">已分配</span>');
			$one['time'] = date('Y-m-d',$one['time']);
		}
		echo json_encode($query);
    }


    //拉黑用户
    public function blockUser(){
    	if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}

    	$user_id = (int)I('get.id');
    	if (empty($user_id)) {
    		$this->error("非法请求");
    	}
    	$query = M('User')->where('id = ' . $user_id)->setField('forbid',1);
    	if ($query) {
    		$this->success("拉黑成功");
    	}else{
    		$this->error("拉黑失败");
    	}
     }


    //删除信息
    public function deleteJob(){
     	if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}

    	$user_id = (int)I('get.id');
    	if (empty($user_id)) {
    		$this->error("非法请求");
    	}

    	$query = M('SignJob')->where('user_id = ' . $user_id)->delete();
    	if ($query) {
    		$this->success("删除成功");
    	}else{
    		$this->error("删除失败");
    	}    	
    }
    //分配用户

    public function allotUser(){
    	if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}
    	$user_id = (int)I('get.id');

    	$this->assign('user',M('User')->where('id = ' . $user_id)->find());
    	$this->assign('company',M('company')->select());
    	$this->display();
    }

    public function allotUserFunc(){
    	if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}
    	$post = I('post.');
    	$user_id = (int)$post['user_id'];
    	$company = (int)$post['company'];
    	if (empty($user_id) || empty($company)) {
    		$this->error("缺少参数");
    	}

    	//已分配状态
    	M('User')->where('id = ' . $user_id)->setField('status1',1);
    	M('SignJob')->where('user_id = ' . $user_id)->save(array('company_id' => $company,'status1' => 1));
    	$this->success("分配成功");
    }
}

?>