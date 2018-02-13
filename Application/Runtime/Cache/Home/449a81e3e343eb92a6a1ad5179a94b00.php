<?php if (!defined('THINK_PATH')) exit();?><!-- 登录 -->
<title>登录/注册</title>
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
        <li class="layui-nav-item"><a href="<?php echo U('Article/index',array('type' => 1));?>">联系我们</a></li>
        <li class="layui-nav-item"><a href="<?php echo U('Article/index',array('type' => 0));?>">关于我们</a></li>
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
          <li class="layui-nav-item" id="u_login">登录/注册</li>
        </ul><?php endif; ?>
     </div>
  </div>

<script>
  $('#u_login').click(function(){
    window.location.href = "<?php echo U('Login/index');?>";
  })
</script>

<div class="layui-main">
    <div class="login-main">
        <form class="layui-form" action="<?php echo U('Login/loginWithCodeFunc');?>" method="post">
          <div class="layui-form-item">
            <div class="layui-inline">
              <label class="layui-form-label">验证码</label>
              <div class="layui-input-inline">
                <input type="text" name="verify" lay-verify="required|number" autocomplete="off" class="layui-input">
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