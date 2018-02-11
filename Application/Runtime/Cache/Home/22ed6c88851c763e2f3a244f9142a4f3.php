<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" href="/Public/layui/css/layui.css">
<link rel="stylesheet" href="/Public/css/index.css">
<script src="/Public/layui/layui.js"></script>
<script src="/Public/js/qrCode.js"></script>
<script src="/Public/js/jquery.qrcode.js"></script>

<div class="layui-main popularize-main">
	<fieldset class="layui-elem-field">
	  <legend>推广介绍</legend>
	  <div class="layui-field-box">
	    通过该网址注册(或扫描二维码注册)的用户成功派遣后您将获得<?php echo C('reward');?>元奖励！
	  </div>
	</fieldset>

	<fieldset class="layui-elem-field layui-field-title" style="margin-top:50px">
	  <legend>推广链接</legend>
	  <div class="layui-field-box">
	      <div class="layui-form-item">
		    <label class="layui-form-label">我的链接</label>
		    <div class="layui-input-block">
		      <input type="text" name="myurl"  autocomplete="off" class="layui-input" value="<?php echo ($url); ?>">
		    </div>
		  </div>
		  <div class="layui-form-item">
		    <label class="layui-form-label">我的二维码</label>
		    <div class="layui-input-block" id="qrCode">
				
		    </div>
		  </div>
	  </div>
	</fieldset>
</div>
<script>
	var url = $("input[name='myurl']").val();
    $("#qrCode").qrcode({
	    render: "table",
	    width: 350,
	    height:350,
	    text: url
	});
</script>