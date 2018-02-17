<?php if (!defined('THINK_PATH')) exit();?><title><?php echo ($arc['title']); ?></title>
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
	
<?php $type = ((int)I('get.type') == 0 ? "关于我们" : "联系我们"); ?>
<div class="m-detail-header">
	<button class="layui-btn"><?php echo ($type); ?></button>
</div>
<div class="layui-field-box m-detail-body">
<?php echo ($arc['body']); ?>
</div>