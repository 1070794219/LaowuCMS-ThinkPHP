<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" href="/Public/layui/css/layui.css">
<link rel="stylesheet" href="/Public/css/index.css">
<script src="/Public/layui/layui.js"></script>
<div class="layui-main message-detail-main">
	<fieldset class="layui-elem-field">
	  <legend><?php echo ($arc['title']); ?> - <?php echo (date("Y-m-d",$arc['time'])); ?></legend>
	  <div class="layui-field-box">
	    <?php echo ($arc['body']); ?>
	  </div>
	</fieldset>
</div>