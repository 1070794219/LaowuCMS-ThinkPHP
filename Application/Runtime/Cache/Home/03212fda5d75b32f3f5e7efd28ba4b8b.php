<?php if (!defined('THINK_PATH')) exit();?><title>登录</title>
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
<form action="<?php echo U('Login/login');?>" class="layui-form m-register-main" method="post">
   <div class="layui-form-item">
    <label class="layui-form-label">手机号</label>
    <div class="layui-input-block">
      <input type="text" name="username" lay-verify="required|phone" autocomplete="off" placeholder="请输入手机号" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">密码</label>
    <div class="layui-input-block">
      <input type="password" name="password" lay-verify="required" placeholder="" autocomplete="off" class="layui-input" placeholder="设置6位数密码">
    </div>
  </div>
  
<!--   <div class="layui-form-item">
      <label class="layui-form-label">验证码</label>
      <div class="layui-input-block">
        <input type="text" name="verify" lay-verify="required|number" autocomplete="off" class="layui-input" placeholder="输入短信验证码">
      </div>
  </div> -->

  <div class="layui-form-item">
    <div class="layui-input-block" style="text-align:right">  <button class="layui-btn" lay-submit="" lay-filter="demo1" style="background:#02338f">登录</button>   
      <a href="<?php echo U('Login/register');?>" class="layui-btn" style="background:#02338f">注册</a>
      
    </div>
  </div>
   <div class="layui-form-item">
    <div class="layui-input-block change" style="text-align:center">      
      <span>忘记密码?点击找回</span>
    </div>
  </div>
  <input type="hidden" name="f" value="<?php echo I('get.f');?>">
</form>

<script type="text/javascript">
    layui.use(['form'], function () {
        var form = layui.form, $ = layui.jquery;
    });

    $('#login').click(function(){
      window.location.href = "<?php echo U('Login/index');?>";
    })
    
    $(".change").click(function(){
      window.location.href = "<?php echo U('Login/forget');?>";
    })
</script>