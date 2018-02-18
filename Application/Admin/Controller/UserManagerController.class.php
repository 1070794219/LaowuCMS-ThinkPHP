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
        //发送短信
        $webhost = C('webhost');
        $user = M('SignJob')->where('user_id = ' . $user_id)->find();
        $message = "【扬帆国际劳务派遣】{$user['name']}，您的工作已分配，请登录扬帆国际劳务派遣查看。";
        $res = sendNormalMessage($user['phone'],$message);
    	$this->success("分配成功\n" . $res);
    }

    //派遣用户
    public function dispatch(){
        $this->display();
    }

    public function dispatchList(){
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
            $one['company'] = M('Company')->where('id = ' . $one['company_id'])->getField('name');
            $one['sex'] = ($one['sex'] == 0 ? "女" : "男");
            $one['status'] = ((int)$one['status2'] == 0 ? '<span class="layui-badge layui-bg-orange">未派遣</span>' : '<span class="layui-badge layui-bg-cyan">已派遣</span>');
            $one['time'] = date('Y-m-d',$one['time']);
        }
        echo json_encode($query);
    }

    public function dispatchFunc(){
        if (!$this->is_login) {
            //未登录
            $this->error("请登录",U('Admin/Login/index'));
        }

        $id = (int)I('get.id');
        M('User')->where('id = ' . $id)->setField('status2',1);
        $query = M('SignJob')->where("user_id = {$id}")->setField('status2',1);
        if ($query) {
            //成功派遣后成为有效推广用户
            $from_id = (int)(M('User')->where('id = ' . $id)->getField('from_user_id'));
            $true_fans = (int)(M('User')->where('id = ' . $from_id)->getField('true_fans'));
            $true_fans++;
            M('User')->where('id = ' . $from_id)->setField('true_fans',$true_fans);

            //增加金额
            $funds = (float)(M('UserFunds')->where('user_id = ' . $from_id)->getField('funds'));
            $funds += C('reward');
            M('UserFunds')->where('user_id = ' . $from_id)->setField('funds',$funds);

            //增加推广展示金额
            $funds = (float)(M('UserFunds')->where('user_id = ' . $from_id)->getField('all_funds'));
            $funds += C('reward');
            M('UserFunds')->where('user_id = ' . $from_id)->setField('all_funds',$funds);

            $this->success("派遣成功");
        }else{
            $this->error("派遣失败");
        }
    }

    //全部用户管理
    public function users(){
        if (!$this->is_login) {
            //未登录
            $this->error("请登录",U('Admin/Login/index'));
        }
        $this->display();
    }

    public function getUsers(){
        if (!$this->is_login) {
            //未登录
            $this->error("请登录",U('Admin/Login/index'));
        }

        $page = (int)I('get.page');
        $limit = (int)I('get.limit');

        $query['code'] = 0;
        $query['msg'] = "";
        $query['count'] = (int)(M('User')->count());
        $query['data'] = M('User')->order('id asc')->limit(($page-1)*$limit,$page*$limit)->select();
        foreach($query['data'] as &$one){
            $one['sex'] = ($one['sex'] == 0 ? "女" : "男");
            $one['status'] = ((int)$one['status1'] == 0 ? '<span class="layui-badge layui-bg-orange">未分配</span>' : '<span class="layui-badge layui-bg-cyan">已分配</span>');
            $one['time'] = date('Y-m-d',$one['time']);
        }
        echo json_encode($query);
    }

    public function userInfo(){
        if (!$this->is_login) {
            //未登录
            $this->error("请登录",U('Admin/Login/index'));
        }

        $id = (int)I('get.id');
        $this->assign('user',M('User')->where('id = ' . $id)->find());
        $this->display();
    }

    //删除用户
    public function deleteUser(){
        if (!$this->is_login) {
            //未登录
            $this->error("请登录",U('Admin/Login/index'));
        }

        $user_id = (int)I('get.id');
        if (empty($user_id)) {
            $this->error("非法请求");
        }

        $query = M('User')->where('id = ' . $user_id)->delete();
        if ($query) {
            //删除用户之后 也要删除登记信息
            M('SignJob')->where('user_id = ' . $user_id)->delete();
            //删除消息列表
            M('UserMessage')->where('user_id = ' . $user_id)->delete();
            //删除用户资金
            M('UserFunds')->where('user_id = ' . $user_id)->delete();
            //删除用户资金详情
            M('UserFundsDetail')->where('user_id = ' . $user_id)->delete();
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }       
    }

    public function adminAddUser(){
        //国家信息
        $this->assign('country',M('Country')->select());
        $this->display();
    }

    //管理员增加用户
    public function adminAddUserFunc(){
        if (!$this->is_login) {
            //未登录
            $this->error("请登录",U('Admin/Login/index'));
        }

        $post = I('post.');
        //判断是否存在
        if (M('User')->where("username = {$post['username']}")->find()) {
            $this->error("手机号已被注册");
        }
        //推广用户系统
        // 系统创建
        $user = array(
                'username' => $post['username'],
                'password' => md5($post['password']),
                'nickname' => $post['username'],
                'fans' => 0,
                'status' => 0,
                'from_user_id' => 0,
                'time' => time(),
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
            //登记
            $record = array(
                'user_id' => $id,
                'name' => trim($post['name']),
                'phone' => $post['username'],
                'country_id' => (int)$post['country'],
                'sex' => (int)$post['sex'],
                'wechat' => trim($post['wechat']),
                'status1' => 0,
                'status2' => 0,
                'time' => time()
            );
            $query = M('SignJob')->add($record);
            if ($query) {
                //注册后直接发送短信
                $message = "感谢您注册扬帆国际劳务派遣！系统已经为您自动登记工作，平台会马上为您匹配！";
                sendNormalMessage($user['username'],$message);
                $this->success("添加成功");
            }else{
                $this->error("添加失败");
            }
        }else{
            $this->error("注册失败");
        }
    }

    public function searchList(){
        if (!$this->is_login) {
            //未登录
            $this->error("请登录",U('Admin/Login/index'));
        }

        $page = (int)I('get.page');
        $limit = (int)I('get.limit');
        $keyword = trim(I('get.keyword'));
        if (empty($keyword)) {
            $this->error("请输入关键词");
        }

        $query['code'] = 0;
        $query['msg'] = "";
        $query['count'] = (int)(M('User')->count());
        $query['data'] = M('User')->where("username = {$keyword} or wechat_account = {$keyword} or nickname = {$keyword}")->order('id asc')->limit(($page-1)*$limit,$page*$limit)->select();
        foreach($query['data'] as &$one){
            $one['sex'] = ($one['sex'] == 0 ? "女" : "男");
            $one['status'] = ((int)$one['status1'] == 0 ? '<span class="layui-badge layui-bg-orange">未分配</span>' : '<span class="layui-badge layui-bg-cyan">已分配</span>');
            $one['time'] = date('Y-m-d',$one['time']);
        }
        echo json_encode($query);
    }
}

?>