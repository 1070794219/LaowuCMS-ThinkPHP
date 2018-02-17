<?php if (!defined('THINK_PATH')) exit();?><!-- 忘记密码 -->
<title>忘记密码</title>
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

<form class="layui-form m-forget-main" action="<?php echo U('Login/forgetFunc');?>" method="post">
  <div class="layui-form-item">
    <label class="layui-form-label">手机号</label>
    <div class="layui-input-block">
      <input type="text" name="username" lay-verify="required|phone" autocomplete="off" placeholder="请输入手机号" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">验证码</label>
      <div class="layui-input-inline">
        <input type="tel" name="verify" lay-verify="required|number" autocomplete="off" class="layui-input">
      </div>
    </div>
  </div>

  <div class="layui-form-item">
    <div class="layui-input-block">
          <a href="#" class="layui-btn" id="send_verify">发送</a>

      <button class="layui-btn" lay-submit="" lay-filter="demo1">提交</button>
    </div>
  </div>
</form>
<script type="text/javascript">
    layui.use(['form'], function () {
        var form = layui.form, $ = layui.jquery;
    });

    $('#send_verify').click(function(){
      var phone = $("input[name='username']").val();

      var myreg = /^(((13[0-9]{1})|(14[0-9]{1})|(17[0]{1})|(15[0-3]{1})|(15[5-9]{1})|(18[0-9]{1}))+\d{8})$/;       
      if(phone == ''){
        layer.msg("手机号码不能为空！");
        return false;
      }else if(phone.length !=11){
        layer.msg("请输入有效的手机号码！");
        return false;
      }else if(!myreg.test(phone)){
        layer.msg("请输入有效的手机号码！");
        return false;
      }

      //忘记密码
      var type = 4;
      $.post("<?php echo U('Login/sendForgetMessage');?>",{phone:phone,type:type},function(res){
        layer.msg(res.message);
      })
    })
</script>