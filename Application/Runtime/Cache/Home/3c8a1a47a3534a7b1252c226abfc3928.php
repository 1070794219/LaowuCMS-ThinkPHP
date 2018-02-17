<?php if (!defined('THINK_PATH')) exit();?><title><?php echo ($arc['title']); ?></title>
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

<div class="layui-main article-main">
	<fieldset class="layui-elem-field">
	  <legend><?php echo ($arc['title']); ?> - <?php echo (date("Y-m-d",$arc['time'])); ?></legend>
	  <div class="layui-field-box">
	    <?php echo ($arc['body']); ?>
	  </div>
	</fieldset>
</div>
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