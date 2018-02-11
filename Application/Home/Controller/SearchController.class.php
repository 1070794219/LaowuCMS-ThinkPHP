<?php
namespace Home\Controller;
use Think\Controller;

class SearchController extends CommonController{
	public function index(){
		$this->display();
	}

	public function result(){
		$phone = trim(I('get.phone'));
		if (empty($phone)) {
			redirect(U('Search/index'));
		}

		$query = M('SignJob')->where("phone = '{$phone}'")->find();
		if ($query) {
			$query['country'] = M('Country')->where('id = ' . $query['country_id'])->getField('name');
		}else{
			$this->error("暂无记录",U('Search/index'));
		}
		$this->assign('show',true);
		$this->assign('res',$query);
		$this->display('index');
	}
}

?>