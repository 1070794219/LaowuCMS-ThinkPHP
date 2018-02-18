<?php
namespace Admin\Controller;
use Think\Controller;

class ClassifyController extends CommonController{
	//国家操作
	public function country(){
		if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}

		$this->assign('type','country');
		$this->display('manage');
	}
	//公司操作
	public function company(){
    	if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}

		$this->assign('type','company');
		$this->display('manage');
	}

	//获取列表
	public function getList(){
    	if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}
    	$type = trim(I('get.type'));		
		$page = (int)I('get.page');
		$limit = (int)I('get.limit');

		$db = null;
		if ($type == "country") {
			$db = M('Country');
		}else{
			$db = M('Company');
		}
		$query['code'] = 0;
		$query['msg'] = "";
		$query['count'] = (int)($db->count());
		$query['data'] = $db->order('id desc')->limit(($page-1)*$limit,$page*$limit)->select();
		foreach($query['data'] as &$one){
			$one['time'] = date("Y-m-d",$one['time']);
		}

		echo json_encode($query);
	}

	//添加
	public function add(){
		if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}
    	$type = trim(I('post.type'));
    	$name = trim(I('post.name'));
    	if (empty($type) || empty($name)) {
    		$this->error("非法操作");
    	}
    	$db = ($type == "country" ? M('Country') : M('Company'));
    	$data = array(
    			'name' => $name,
    			'time' => time() 
    		);
    	$query = $db->add($data);
    	// if ($query) {
    	// 	echo "添加成功";
    	// }else{
    	// 	echo "添加失败";
    	// }
	}
	//删除
	public function delete(){
		if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}
    	$type = trim(I('get.type'));
    	$id = (int)I('get.id');
    	if (empty($type) || empty($id)) {
    		$this->error("非法操作");
    	}
    	$db = ($type == "country" ? M('Country') : M('Company'));
    	$query = $db->where('id = ' . $id)->delete();
    	if ($query) {
    		$this->success("删除成功");
    	}else{
    		$this->error("删除失败");
    	}

	}
	//编辑
	public function change(){
		if (!$this->is_login) {
    		//未登录
    		$this->error("请登录",U('Admin/Login/index'));
    	}
    	$type = trim(I('post.type'));
    	$id = (int)I('post.id');	
    	$name = trim(I('post.name'));

  		if (empty($type) || empty($id)) {
    		$this->error("非法操作");
    	}
    	$db = ($type == "country" ? M('Country') : M('Company'));
    	$query = $db->where('id = ' . $id)->setField('name',$name);
	}

    //查看成员
    public function getMembers(){
        if (!$this->is_login) {
            //未登录
            $this->error("请登录",U('Admin/Login/index'));
        }

        $id = (int)I('get.country_id');
        $page = (int)I('get.page');
        $limit = (int)I('get.limit');
        
        $query['code'] = 0;
        $query['msg'] = "";
        $query['count'] = (int)(M('User')->count());
        $query['data'] = M('SignJob')->where("country_id = {$id}")->order('id asc')->limit(($page-1)*$limit,$page*$limit)->select();
        foreach($query['data'] as &$one){
            $one['sex'] = ($one['sex'] == 0 ? "女" : "男");
            $one['status'] = ((int)$one['status1'] == 0 ? '<span class="layui-badge layui-bg-orange">未分配</span>' : '<span class="layui-badge layui-bg-cyan">已分配</span>');
            $one['time'] = date('Y-m-d',$one['time']);
        }
        echo json_encode($query);

    }

}
?>