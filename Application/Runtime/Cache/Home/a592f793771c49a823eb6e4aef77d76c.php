<?php if (!defined('THINK_PATH')) exit();?><title>介绍好友</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">     
<meta content="yes" name="apple-mobile-web-app-capable">     
<meta content="black" name="apple-mobile-web-app-status-bar-style">     
<meta content="telephone=no" name="format-detection">
<link rel="stylesheet" href="/Public/layui/css/layui.css">
<link rel="stylesheet" href="/Public/css/index_m.css">
<script src="/Public/js/jquery.js"></script>
<script src="/Public/layui/layui.js"></script>
<script src="/Public/js/index.js"></script>
<div class="m-user-header">
	<div class="m-user-logo">
		<img src="/Public/images/logo-m-user.png" alt="">
	</div>
	<div class="m-detail-header" style="margin-bottom:10px;">
		<button class="layui-btn">个人中心</button>
	</div>
	<div class="m-user-header-btns">
		<a href="<?php echo U('User/popularize');?>" class="layui-btn" id="m-header-user-1">介绍好友</a>
		<a href="<?php echo U('User/deposit');?>" class="layui-btn" id="m-header-user-2">钱包提现</a>
	</div>
	<div class="m-user-header-btns">
		<a href="<?php echo U('User/messages');?>" class="layui-btn" id="m-header-user-3">系统消息</a>
		<a href="<?php echo U('User/sendCompany');?>" class="layui-btn" id="m-header-user-4">紧急救援</a>
	</div>
</div>

<script src="/Public/js/qrCode.js"></script>
<script src="/Public/js/jquery.qrcode.js"></script>
<script src="/Public/js/jquery.zclip.min.js"></script>
<div class="m-popularize-main">
	<div class="layui-field-box" style="font-size:16px">
	    通过下面二维码或链接注册并被成功派遣的的每位用户您将获得<?php echo C('reward');?>元奖励！
	</div>
  	<div class="layui-form-item">
	    <div class="layui-input-inner">
	    	<div id="qrCode" style="border:solid 10px #fff"></div>
	    </div>
	</div>
	<div class="layui-form-item">
	    <div class="layui-input-inner">
	      <span id="url"><?php echo ($url); ?></span>
	    </div>
	</div>
	<button class="layui-btn layui-btn-disabled" lay-submit="" lay-filter="demo2" style="width:70%;margin-left:15%;background:#ce6600" id="copy-btn">浏览器不支持，请手动复制</button>
</div>

<style>
	#m-header-user-1{
		background: #ce6600 !important;
	}
</style>
<script> 
	var url = "<?php echo ($murl); ?>";
    $("#qrCode").qrcode({
    	correctLevel:0,
	    // render: "canvas",
	    width: 150,
	    height:150,
	    // text: url
	    text:url
	});

$(document).ready(function(){
	if ( window.clipboardData ) { 
    $('#copy-btn').click(function(){
    	window.clipboardData.setData("Text", $('#url').val()); 
            layui.msg('复制成功！'); 
    })
	} else { 
	    $("#copy-btn").zclip({ 
	        path:'/Public/js/ZeroClipboard.swf', 
	        copy:function(){return $('#url').val();}, 
	        afterCopy:function(){layui.msg('复制成功！');} 
	    }); 
	} 
})    
</script>