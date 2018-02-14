<?php
namespace Home\Controller;
use Think\Controller;

class CommonController extends Controller{

	protected $is_login;
	protected $user_id;
	protected $username;
	protected $nickname;
	public function _initialize(){
		if (isset($_SESSION['id'])) {

			//已登录
			$this->is_login = true;
			$this->user_id = $_SESSION['id'];
			$this->username = $_SESSION['username'];
			$this->nickname = $_SESSION['nickname'];

			$this->assign("isLogin",$this->is_login);
			$this->assign("id",$this->id);
			$this->assign("username",$this->username);
			$this->assign("nickname",M('User')->where('id = ' . $this->user_id)->getField('nickname'));
		}else{
			$this->is_login = false;
			$this->id = 0;
			$this->username = "";
		}
	}

	//重构display方法，实现手机版跳转
	public function display($templateFile = '', $charset = '', $contentType = '', $content = '', $prefix = '')
    {
 
        $template = null;
        $tplName = null;
        if($templateFile){
        	//传入值
        	$template = $templateFile;

            //判断success和error
        	//获取模板名字
	        $temp = explode("/", $template);
	        $tplName = $temp[count($temp) - 1];
        }else{
        	$template = ucfirst(CONTROLLER_NAME) . '/' . ACTION_NAME;
        }


        if(isMobile())
        {
        	//如果传入模板
            // echo $tplName;
        	if ($tplName) {
                if ($tplName != "dispatch_jump.tpl") {
                    $template = ucfirst(CONTROLLER_NAME) . '/' . "m_" . $tplName;
                }else{
                    $template = $templateFile;
                }
        	}else{
        		$template = ucfirst(CONTROLLER_NAME) . '/' . "m_" . ACTION_NAME;
        	}
        }
        try{
        	// echo $templateFile;
        	// echo $template;
            parent::display($template, $charset, $contentType, $content, $prefix);
        }catch(\Exception $e) {
            header('HTTP/1.1 404 Not Found');
        }
    }
}

?>