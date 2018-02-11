<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo C('webname');?></title>
</head>
<body style="background-color: #eee;">
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

  <!-- 轮播图 -->
  <div class="layui-carousel" id="lantern">
    <div carousel-item="">
      <div><img src="//res.layui.com/images/layui/demo/1.png"></div>
      <div><img src="//res.layui.com/images/layui/demo/2.png"></div>
      <div><img src="//res.layui.com/images/layui/demo/3.png"></div>
      <div><img src="//res.layui.com/images/layui/demo/4.png"></div>
      <div><img src="//res.layui.com/images/layui/demo/5.png"></div>
      <div><img src="//res.layui.com/images/layui/demo/6.png"></div>
      <div><img src="//res.layui.com/images/layui/demo/7.png"></div>
    </div>
  </div>

  <!-- 文章 -->
  <div class="layui-main index-main">
    <p class="index-tip"><i class="layui-icon" style="font-size: 25px; color: #FF5722">&#xe756;
</i>  
最新公告</p>
    <ul class="site-idea">
      <li>
        <fieldset class="layui-elem-field layui-field-title">
          <legend>返璞归真</legend>
          <p>身处在前端社区的繁荣之下，我们都在有意或无意地追逐。而 layui 偏偏回望当初，奔赴在返璞归真的漫漫征途，自信并勇敢着，追寻于原生态的书写指令，试图以最简单的方式诠释高效。</p>
        </fieldset>
      </li>
      <li>
        <fieldset class="layui-elem-field layui-field-title">
          <legend>双面体验</legend>
          <p>拥有双面的不仅是人生，还有 layui。一面极简，一面丰盈。极简是视觉所见的外在，是开发所念的简易。丰盈是倾情雕琢的内在，是信手拈来的承诺。一切本应如此，简而全，双重体验。</p>
        </fieldset>
      </li>
      <li>
        <fieldset class="layui-elem-field layui-field-title">
          <legend>星辰大海</legend>
          <p>如果眼下还是一团零星之火，那运筹帷幄之后，迎面东风，就是一场烈焰燎原吧，那必定会是一番尽情的燃烧。待，秋风萧瑟时，散作满天星辰，你看那四季轮回<!--海天相接-->，正是 layui 不灭的执念。</p>
        </fieldset>
      </li>
    </ul>
  </div>

  <!-- 底部 -->
    <div class="layui-footer footer footer-index">
    <div class="layui-main">
      <p>© 2018 <a href="/"></a> </p>
      <p>
        <a href="" target="_blank">首页</a>
        <a href="" target="_blank">登记找工作</a>
        <a href="">查询工作状态</a>
        <a href="" target="_blank" rel="nofollow">联系我们</a>
        <a href="" target="_blank" rel="nofollow">关于我们</a>
      </p>
    </div>
  </div>
</body>

</html>