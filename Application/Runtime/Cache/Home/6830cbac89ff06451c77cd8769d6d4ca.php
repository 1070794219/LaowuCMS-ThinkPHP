<?php if (!defined('THINK_PATH')) exit();?><title>个人中心</title>
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
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
        <li class="layui-nav-item layui-nav-itemed">
          <a class="" href="<?php echo U('User/myInfo');?>" target="main_iframe">我的信息</a>
        </li>
        <li class="layui-nav-item">
          <a href="<?php echo U('User/popularize');?>" target="main_iframe">介绍好友</a>
        </li>
        <li class="layui-nav-item">
        	<a href="<?php echo U('User/deposit');?>" target="main_iframe">提现</a>
        </li>
        <li class="layui-nav-item">
        	<a href="<?php echo U('User/messages');?>" target="main_iframe">系统消息</a>
        </li>
      </ul>
    </div>
  </div>
  
  <div class="layui-body">
    <!-- 内容主体区域 -->
    <iframe src="<?php echo U('User/myInfo');?>" frameborder="0" name="main_iframe" class="user-iframe"></iframe>
  </div>
  
    <!-- 底部固定区域 -->
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
</div>
<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
  
});

var type = "<?php echo I('get.type');?>";
console.log(type);
if (type == "nr") {
  //跳转到未读界面
  $('.user-iframe').attr('src',"<?php echo U('User/messages');?>");
};
</script>
</body>