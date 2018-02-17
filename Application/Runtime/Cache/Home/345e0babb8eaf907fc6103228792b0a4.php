<?php if (!defined('THINK_PATH')) exit();?><!-- 忘记密码 -->
<title>忘记密码</title>
  <link rel="stylesheet" href="/Public/layui/css/layui.css">
  <link rel="stylesheet" href="/Public/css/index.css">
  <script src="/Public/js/jquery.js"></script>
  <script src="/Public/layui/layui.js"></script>
  <script src="/Public/js/index.js"></script>
  <div class="layui-header header">
     <div class="layui-main">
      <a class="logo" href="/">
        <img src="//res.layui.com/images/layui/logo.png" alt="layui">
      </a>

        <!-- 头部区域（可配合layui已有的水平导航） -->
      <ul class="layui-nav layui-layout-left">
        <li class="layui-nav-item"><a href="<?php echo U('Index/index');?>">首页</a></li>
        <li class="layui-nav-item"><a href="<?php echo U('SignJob/index');?>">登记找工作</a></li>
        <li class="layui-nav-item"><a href="<?php echo U('Search/index');?>">查询工作状态</a></li>
        <li class="layui-nav-item"><a href="<?php echo U('Article/lastArticle',array('type' => 1));?>">联系我们</a></li>
        <li class="layui-nav-item"><a href="<?php echo U('Article/lastArticle',array('type' => 0));?>">关于我们</a></li>
      </ul>
      <?php if($isLogin): ?><ul class="layui-nav layui-layout-right">
          <li class="layui-nav-item">
            <a href="javascript:;">
              <?php echo ($nickname); ?>
            </a>
            <dl class="layui-nav-child">
              <dd><a href="<?php echo U('User/index');?>">个人中心</a></dd>
            </dl>
          </li>
          <li class="layui-nav-item"><a href="<?php echo U('Login/logout');?>">退出</a></li>
        </ul>
      <?php else: ?>
        <ul class="layui-nav layui-layout-right">
          <li class="layui-nav-item" id="u_login">登录</li>
          <li class="layui-nav-item"><span>&nbsp;|&nbsp;</span></li>
          <li class="layui-nav-item" id="u_register">注册</li>
        </ul><?php endif; ?>
     </div>
  </div>

<script>
  $('#u_login').click(function(){
    window.location.href = "<?php echo U('Login/index');?>";
  })
  $('#u_register').click(function(){
    window.location.href = "<?php echo U('Login/register');?>";
  })
</script>

<div class="layui-main">
    <div class="login-main">
        <form class="layui-form" action="<?php echo U('Login/forgetFunc');?>" method="post">
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
              <a href="#" class="layui-btn" id="send_verify">发送</a>
            </div>
          </div>

          <div class="layui-form-item">
            <div class="layui-input-block">
              <button class="layui-btn" lay-submit="" lay-filter="demo1">提交</button>
            </div>
          </div>
        </form>
    </div>
</div>
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