<?php if (!defined('THINK_PATH')) exit();?><title>提现</title>
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

<div class="layui-form-item">
	<div class="layui-inline">
      <label class="layui-form-label">可用金额:</label>
      <div class="layui-input-inline">
        <label class="layui-form-label" style="text-align:left"><?php echo ($reward); ?> 元</label>
      </div>
    </div>
</div>
<form action="<?php echo U('User/withdraw');?>" method="post" class="layui-form m-deposit-main">
	<div class="layui-form-item">
		    <div class="layui-inline">
		      <label class="layui-form-label">提现账户</label>
		      <div class="layui-input-inline">
		        <input type="text" name="bank" lay-verify="required" autocomplete="off" class="layui-input">
		      </div>
		    </div>
		</div>
	<div class="layui-form-item">
	    <div class="layui-inline">
	      <label class="layui-form-label">提现金额</label>
	      <div class="layui-input-inline">
	        <input type="text" name="money" lay-verify="required|number" autocomplete="off" class="layui-input"  onkeypress="return event.keyCode>=48&&event.keyCode<=57" ng-pattern="/[^a-zA-Z]/">
	      </div>
	    </div>
	</div>
    <div class="layui-form-item">
        <div class="layui-inline">
          <label class="layui-form-label">验证码</label>
          <div class="layui-input-inline">
            <input type="tel" name="verify" lay-verify="required|number" autocomplete="off" class="layui-input"  id="verify" >
            <a href="#" class="layui-btn" id="send_verify" style="background:#ce6600">发送验证码</a>

          </div>
        </div>
    </div>
	<div class="layui-form-item">
    	<button class="layui-btn" lay-submit="" lay-filter="demo2" style="margin-left:25%;margin-top:100px;width:60%;background:#ce6600">点击提现</button>
    </div>

</form>
<style>
	#m-header-user-2{
		background: #ce6600 !important;
	}
	#verify{
		width:100px;
		display:inline-block !important;
	}
</style>
<script>
	layui.use(['form'], function () {
        var form = layui.form, $ = layui.jquery;
    });
	  //发送验证码
	  $('#send_verify').click(function(){
	  	$.post("<?php echo U('User/sendMessage');?>",{},function(res){
	        layer.msg(res.message);
	      });
	  	settime($(this));
	  });

	var countdown=60; 
    function settime(obj) { //发送验证码倒计时
          if (countdown == 0) { 
              obj.removeClass("layui-btn-disabled"); 
              //obj.removeattr("disabled"); 
              obj.html("发送验证码");
              countdown = 60; 
              return;
          } else { 
              obj.addClass("layui-btn-disabled"); 
              obj.html("(" + countdown + ")");
              countdown--; 
          } 
      setTimeout(function() { 
          settime(obj) }
          ,1000) 
      }
</script>