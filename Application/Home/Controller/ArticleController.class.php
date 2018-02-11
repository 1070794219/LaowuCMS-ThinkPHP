<?php
namespace Home\Controller;
use Think\Controller;

class ArticleController extends CommonController{
	public function index(){
		$type = (int)I('get.type');
		if ($type == 1 || $type == 0) {
			$this->assign('type',$type);
			$this->assign('typename',($type == 1 ? "联系我们" : "关于我们"));
			$this->display();
		}else{
			$this->error("非法请求");
		}
	}

	public function getList(){
		$type = (int)I('get.type');
		$page = (int)I('get.page');
		$limit = (int)I('get.limit');
		if ($type == 1 || $type == 0) {
			$query['code'] = 0;
			$query['msg'] = "";
			$query['count'] = (int)(M('Article')->where('type = ' . $type)->count());
			$query['data'] = M('Article')->where('type = ' . $type)->order('time desc')->limit(($page-1)*$limit,$page*$limit)->select();
			echo json_encode($query);
		}else{
			$this->error("非法请求");
		}
	}

	public function detail(){
		$id = (int)I('get.id');
		if (empty($id)) {
			redirect(U('Article/index'));
		}
		$query = M("Article")->where('id = ' . $id)->find();
		if (!$query) {
			$this->error("文章不存在或已被删除");
		}
		$this->assign("arc",$query);
		$this->display();
	}
}
?>