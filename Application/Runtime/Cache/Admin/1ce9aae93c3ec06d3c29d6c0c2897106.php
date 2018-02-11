<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" href="/Public/layui/css/layui.css">
<link rel="stylesheet" href="/Public/css/index.css">
<script src="/Public/layui/layui.js"></script>
<div class="layui-main myInfo-main">
	<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
	  <legend>网站信息</legend>
	</fieldset>
	<form class="layui-form" action="<?php echo U('Admin/Settings/save');?>" method="post">
	  <div class="layui-form-item">
	    <label class="layui-form-label">网站名</label>
	    <div class="layui-input-block">
	      <input type="text" name="webname" autocomplete="off" class="layui-input" value="<?php echo ($webname); ?>">
	    </div>
	  </div>
	  <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
		  <legend>短信平台</legend>
		</fieldset>
	  <div class="layui-form-item">
	    <label class="layui-form-label">账号</label>
	    <div class="layui-input-block">
	      <input type="text" name="sms_name" lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo ($sms_name); ?>">
	    </div>
	  </div>
	  <div class="layui-form-item">
	    <label class="layui-form-label">密码</label>
	    <div class="layui-input-block">
	      <input type="text" name="sms_key" lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo ($sms_key); ?>">
	    </div>
	  </div>
	  
	  <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
		  <legend>邮箱设置</legend>
		</fieldset>
	  <div class="layui-form-item">
	    <label class="layui-form-label">账号</label>
	    <div class="layui-input-block">
	      <input type="text" name="email_name" lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo ($email_name); ?>">
	    </div>
	  </div>
	  <div class="layui-form-item">
	    <label class="layui-form-label">密码</label>
	    <div class="layui-input-block">
	      <input type="text" name="email_key" lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo ($email_key); ?>">
	    </div>
	  </div>
	  <div class="layui-form-item">
	    <label class="layui-form-label">客服邮箱</label>
	    <div class="layui-input-block">
	      <input type="text" name="email" lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo ($email); ?>">
	    </div>
	  </div>

	  <div class="layui-form-item">
	    <button class="layui-btn" lay-submit="" lay-filter="demo2" style="margin-left:50px">保存</button>
	  </div>
	</form>

	 
</div>