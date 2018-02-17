<?php if (!defined('THINK_PATH')) exit();?><!-- 登录 -->
<title>输入验证码</title>
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

    <div class="m-login-main">
        <form class="layui-form" action="<?php echo U('Login/loginWithCodeFunc');?>" method="post">
          <div class="layui-form-item">
            <div class="layui-block">
              <label class="layui-form-label">验证码</label>
              <div class="layui-input-block">
                <input type="text" name="verify" lay-verify="required|number" autocomplete="off" class="layui-input" style="margin-right:80px">
              </div>
            </div>
          </div>

          <div class="layui-form-item">
            <div class="layui-input-block">
              <button class="layui-btn" lay-submit="" lay-filter="demo1">登录</button>
            </div>
          </div>
          <input type="hidden" name="username" value="<?php echo ($username); ?>">
          <input type="hidden" name="password" value="<?php echo ($password); ?>">
        </form>
    </div>
<script type="text/javascript">
    layui.use(['form'], function () {
        var form = layui.form, $ = layui.jquery;
    });
    $('#register').click(function(){
      window.location.href = "<?php echo U('Login/register');?>";
    })

    layui.use('layer',function () {
      layer.alert('当前操作频繁,验证码已发送到手机中,请输入验证码后登录 (验证码5分钟内有效)');
    });
</script>