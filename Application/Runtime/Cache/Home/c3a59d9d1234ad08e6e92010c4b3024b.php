<?php if (!defined('THINK_PATH')) exit();?><title>注册</title>
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
<form action="<?php echo U('Login/addUser');?>" class="layui-form m-register-main" method="post">
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
  
  <div class="layui-form-item">
      <label class="layui-form-label">验证码</label>
      <div class="layui-input-block">
        <input type="text" name="verify" lay-verify="required|number" autocomplete="off" class="layui-input" placeholder="输入短信验证码">
      </div>
  </div>

  <div class="layui-form-item">
    <div class="layui-input-block" style="text-align:right">      
    	<a href="#" class="layui-btn" id="send_verify" style="background:#8f0227">获取</a>
      <button class="layui-btn" lay-submit="" lay-filter="demo1" style="background:#02338f">注册</button>
    </div>
  </div>
   <div class="layui-form-item">
    <div class="layui-input-block change" style="text-align:center">      
    	<span>已有帐号,点击登录</span>
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

      //注册
      var type = 0;
      $.post("<?php echo U('Login/sendMessage');?>",{phone:phone,type:type},function(res){
        layer.msg(res.message);
      })
      settime($(this));
    })

    var countdown=60; 
    function settime(obj) { //发送验证码倒计时
          if (countdown == 0) { 
              obj.removeClass("layui-btn-disabled"); 
              //obj.removeattr("disabled"); 
              obj.html("发送");
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

    $(".change").click(function(){
    	window.location.href = "<?php echo U('Login/index');?>"
    })
</script>