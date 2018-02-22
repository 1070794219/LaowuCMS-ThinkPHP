<?php
namespace Admin\Controller;
use Think\Controller;

class ManagerController extends CommonController {
	public function index(){
		$this->display();
	}

	//添加管理员
	public function addManager(){
		if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}

		$post = I('post.');
		$data = array(
				'username' => trim($post['username']),
				'password' => md5(trim($post['password']))
			);

		$query = M('Admin')->add($data);
		if ($data) {
			$this->success("添加成功");
		}else{
			$this->error("添加失败");
		}

	}

	//修改新密码
	public function changePwd(){
		if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}

    	$new_pwd = trim(I('post.password'));
    	if (empty($new_pwd)) {
    		$this->error("请输入正确的密码");
    	}

    	$id = $this->admin_id;
    	$query = M('Admin')->where('id = ' . $id)->setField('password',md5($new_pwd));
    	if ($query) {
    		//退出
    		cookie('admin_id',null);
    		session('admin_id',null);
    		$this->success("修改成功,请重新登录",U('Admin/Login/index'));
    	}else{
    		$this->error("修改失败");
    	}
	}

	//获取管理员列表
	public function managers(){
		if (!$this->is_login) {
            //未登录
            $this->error("请登录",U('Admin/Login/index'));
        }

        $page = (int)I('get.page');
        $limit = (int)I('get.limit');

        $query['code'] = 0;
        $query['msg'] = "";
        $query['count'] = (int)(M('Admin')->count());
        $query['data'] = M('Admin')->order('id asc')->limit(($page-1)*$limit,$page*$limit)->select();
        echo json_encode($query);
	}

	//删除管理员
	public function deleteManager(){
		if (!$this->is_login) {
            //未登录
            $this->error("请登录",U('Admin/Login/index'));
        }

        $id = (int)I('get.id');
        if (empty($id)) {
        	$this->error("缺少参数");
        }

        //防止把自己删除
        if ($id == $this->admin_id) {
        	$this->error("请不要删除自己");
        }
        $query = M('Admin')->where('id = ' . $id)->delete();
        if ($query) {
        	$this->success("删除成功");
        }else{
        	$this->error("删除失败");
        }
	}
}
?>