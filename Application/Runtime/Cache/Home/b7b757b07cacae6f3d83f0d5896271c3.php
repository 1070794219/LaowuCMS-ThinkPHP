<?php if (!defined('THINK_PATH')) exit();?><title><?php echo C('webname');?></title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">     
<meta content="yes" name="apple-mobile-web-app-capable">     
<meta content="black" name="apple-mobile-web-app-status-bar-style">     
<meta content="telephone=no" name="format-detection">
<link rel="stylesheet" href="/Public/layui/css/layui.css">
<link rel="stylesheet" href="/Public/css/index_m.css">
<script src="/Public/js/jquery.js"></script>
<script src="/Public/layui/layui.js"></script>
<script src="/Public/js/index.js"></script>
<div class="m-header">
	<div class="m-header-logo">
		<img src="/Public/images/logo-m.png" alt="">
	</div>
</div>

<!-- 登录 -->
<div class="m-header-nav-btn">
	<?php if($isLogin): ?><button class="layui-btn m-header-btn" id="userCenter">个人中心</button>
	<?php else: ?>
		<button class="layui-btn layui-btn-danger" style="margin-left:18%;margin-right:6%" id="login-btn">登录</button>
		<button class="layui-btn" style="margin-left:6%" id="register-btn">注册</button><?php endif; ?>
</div>
<div class="m-header-btn-list">
	<a href="<?php echo U('Article/lastArticle',array('type' => 0));?>" class="layui-btn layui-btn-normal">关于我们</a>
	<a href="<?php echo U('SignJob/index');?>" class="layui-btn layui-btn-normal">登记找工作</a>
	<a href="<?php echo U('Search/index');?>" class="layui-btn layui-btn-normal">查询登记状态</a>
	<a href="<?php echo U('Article/lastArticle',array('type' => 1));?>" class="layui-btn layui-btn-normal">联系我们</a>
</div>
<script>
	$('#login-btn').click(function(){
		window.location.href = "<?php echo U('Login/index');?>";
	})
	$('#register-btn').click(function(){
		window.location.href = "<?php echo U('Login/register');?>";
	})
	$('#userCenter').click(function(){
		window.location.href = "<?php echo U('User/myInfo');?>";
	})
</script>