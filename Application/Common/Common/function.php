<?php

//短信验证码
function sendMessage($phone,$code,$type){
	$statusStr = array(
	"0" => "短信发送成功",
	"-1" => "参数不全",
	"-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
	"30" => "密码错误",
	"40" => "账号不存在",
	"41" => "余额不足",
	"42" => "帐户已过期",
	"43" => "IP地址限制",
	"50" => "内容含有敏感词"
	);
	$smsapi = "http://api.smsbao.com/";
	$user = C('sms_name'); //短信平台帐号
	$pass = md5(C('sms_key')); //短信平台密码
	$content= "【扬帆国际劳务派遣】您的验证码是[ " . $code . " ],五分钟内有效。";//要发送的短信内容
	$phone = $phone;//要发送短信的手机号码
	$sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);
	$result = file_get_contents($sendurl) ;
	if ((int)$result == 0) {
		$data = array(
				'phone' => $phone,
				'verify' => $code,
				'type' => $type,
				'time' => time()
			);
		M('Verify')->add($data);
		return "短信发送成功";
	}else{
		return "信息发送失败，请联系管理员。[错误码:" . $result . "]";
	}
}

//发送普通短信
function sendNormalMessage($phone,$message){
	$smsapi = "http://api.smsbao.com/";
	$user = C('sms_name'); //短信平台帐号
	$pass = md5(C('sms_key')); //短信平台密码
	$content= $message;//要发送的短信内容
	$phone = $phone;//要发送短信的手机号码
	$sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);
	$result = file_get_contents($sendurl) ;
	if ((int)$result == 0) {
		return "短信发送成功";
	}else{
		return "信息发送失败，请联系管理员。[错误码:" . $result . "]";
	}
}

//发送邮箱
function sendEmail($title,$message){
	require_once "./Application/Admin/Common/email/email.class.php";
	//******************** 配置信息 ********************************
	$smtpserver = "ssl://smtp.qq.com";//SMTP服务器
	$smtpserverport =465;//SMTP服务器端口
	$smtpusermail = C('email_name');//SMTP服务器的用户邮箱
	$smtpemailto = C('email');//发送给谁
	$smtpuser = C('email_name');//SMTP服务器的用户帐号
	$smtppass = C('email_pwd');//SMTP服务器的用户密码
	$mailtitle = $title;//邮件主题
	$mailcontent = $message;//邮件内容
	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
	//************************ 配置信息 ****************************
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = false;//是否显示发送的调试信息
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);

	echo "<div style='width:300px; margin:36px auto;'>";
	if($state==""){
		return 0;
	}
	return 1;
}
function ajaxReturn($message, $code=1, $data = array())
{
    $param = array(
        'code' => $code,
        'message' => $message,
        'data' => (is_array($data) ? $data : array())
    );
    if( IS_AJAX )
    {
        header('Content-Type:application/json; charset=utf-8');
        exit(json_encode($param));
    }
    exit(include_once(__DIR__.DIRECTORY_SEPARATOR.'error.html'));
}

//验证手机版
function isMobile() {
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
        return true;
    
    //此条摘自TPM智能切换模板引擎，适合TPM开发
    if(isset ($_SERVER['HTTP_CLIENT']) &&'PhoneClient'==$_SERVER['HTTP_CLIENT'])
        return true;
    //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
        //找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], 'wap') ? true : false;
    //判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array(
            'nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile'
        );
        //从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }
    //协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT'])) {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return true;
        }
    }
    return false;
}
?>