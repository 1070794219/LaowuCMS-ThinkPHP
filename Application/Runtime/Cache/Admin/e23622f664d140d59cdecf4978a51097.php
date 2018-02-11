<?php if (!defined('THINK_PATH')) exit();?><title><?php echo ($arc['title']); ?></title>
<link rel="stylesheet" href="/Public/layui/css/layui.css">
<link rel="stylesheet" href="/Public/css/admin.css">
<script src="/Public/layui/layui.js"></script>
<div class="layui-main article-main">
	<fieldset class="layui-elem-field">
	  <legend><?php echo ($arc['title']); ?> - <?php echo (date("Y-m-d",$arc['time'])); ?></legend>
	  <div class="layui-field-box">
	    <?php echo ($arc['body']); ?>
	  </div>
	</fieldset>
</div>