<?php
namespace Admin\Controller;
use Think\Controller;

class ArticleController extends CommonController{
	public function index(){
		if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}
		$this->display();
	}

	public function  articles(){
		if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}
		$page = (int)I('get.page');
		$limit = (int)I('get.limit');
		$type = (int)I('get.type');
		$query['code'] = 0;
		$query['msg'] = "";
		$query['count'] = (int)(M('Article')->where("type = {$type}")->count());
		$query['data'] = M('Article')->where("type = {$type}")->order('time desc')->limit(($page-1)*$limit,$page*$limit)->select();
		echo json_encode($query);
	}

	public function detail(){
		if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}

    	$id = (int)I('get.id');
    	if (empty($id)) {
    		$this->error("缺少参数");
    	}

    	$this->assign('arc',M('Article')->where('id = ' . $id)->find());
    	$this->display();
	}

	//删除消息
	public function delete(){
		if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}

    	$id = (int)I('get.id');
    	if (empty($id)) {
    		$this->error("缺少参数");
    	}

    	$query = M('Article')->where('id = ' . $id)->delete();
    	if ($query) {
    		$this->success("删除成功");
    	}else{
    		$this->error("删除失败");
    	}
	}

	//添加信息
	public function add(){
		$this->display();
	}

	public function addFunc(){
		if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}
		$post = I('post.');
		$data = array(
				'title' => trim($post['title']),
				'body' => trim($post['body']),
				'time' => time(),
				'type' => (int)$post['type']
			);
		$query = M('Article')->add($data);
		if ($query) {
			$this->success("添加成功");
		}else{
			$this->error("添加失败");
		}
	}

	//修改文章
	public function change(){
		if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}
		$id = (int)I('get.id');
		$this->assign('arc',M('Article')->where('id = ' . $id)->find());
		$this->display();
	}

	public function changeFunc(){
		if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}
		$post = I('post.');
		$id = (int)$post['id'];
		$data = array(
				'title' => trim($post['title']),
				'body' => trim($post['body']),
				'time' => time(),
				'type' => (int)$post['type']
			);
		M('Article')->where('id = ' . $id)->save($data);
		$this->success("修改成功");
	}

	//置顶
	public function stick(){
		if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}
		$id = (int)I('get.id');
		$query = M('Article')->where("id = {$id}")->setField('time',time());
		if ($query) {
			$this->success("置顶成功");
		}else{
			$this->error("置顶失败");
		}
	}
}

?>