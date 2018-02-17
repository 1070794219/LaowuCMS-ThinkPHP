<?php if (!defined('THINK_PATH')) exit();?><title>个人中心</title>
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

<script>
	window.location.href = "<?php echo U('Index/index');?>"
</script>