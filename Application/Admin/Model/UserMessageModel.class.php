<?php
namespace Admin\Model;
use Think\Model;

class UserMessageModel extends Model{
	public function addMessages($data){
		$message = M('Message')->where($data)->find();
		$sql = "";
		switch((int)$data['type']){
			case 0:
				$sql = "status1 = 0";
				break;
			case 1:
				$sql = "status1 = 1";
				break;
			case 2:
				$sql = "status2 = 0";
				break;
			case 3:
				$sql = "status2 = 1";
				break;
			case 4:
				$sql = "";
				break;
			default:
				$sql = "";
				break;
		}

		$users = M('User')->where($sql)->select();
		foreach($users as $one){
			$res = array(
					'user_id' => $one['id'],
					'message_id' => $message['id'],
					'status' => 0
				);
			$this->add($res);
		}
	}
}
?>