<?php
namespace Admin\Controller;
use Think\Controller;

class MessageController extends CommonController{
	public function index(){
    	if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}
		$this->display();
	}

	public function  Messages(){
		if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}
		$page = (int)I('get.page');
		$limit = (int)I('get.limit');
		$query['code'] = 0;
		$query['msg'] = "";
		$query['count'] = (int)(M('Message')->count());
		$query['data'] = M('Message')->order('time desc')->limit(($page-1)*$limit,$page*$limit)->select();
		foreach($query['data'] as &$one){
			$one['time'] = date("Y-m-d",$one['time']);
			$type = "";
			switch ((int)$one['type']) {
				case 0:
					$type = "未分配";
					break;
				case 1:
					$type = "已分配";
					break;	
				case 2:
					$type = "未派遣";
					break;
				case 3:
					$type = "已派遣";
					break;
				case 4:
					$type = "全部";
					break;
				default:
					$type = "全部";
					break;
			}
			$html = '<a class="layui-btn layui-btn-normal layui-btn-xs">' . $type . '</a>';
			$one['type'] = $html;
		}
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

    	$this->assign('arc',M('Message')->where('id = ' . $id)->find());
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

    	$query = M('Message')->where('id = ' . $id)->delete();
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
		$post = I('post.');
		$data = array(
				'title' => trim($post['title']),
				'body' => trim($post['body']),
				'time' => time(),
				'type' => (int)$post['type']
			);
		$query = M('Message')->add($data);
		if ($query) {
			D('UserMessage')->addMessages($data);
			$this->success("添加成功");
		}else{
			$this->error("添加失败");
		}
	}
}
?>