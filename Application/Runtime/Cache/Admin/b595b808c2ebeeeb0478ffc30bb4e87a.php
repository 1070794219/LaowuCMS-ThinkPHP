<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>后台管理</title>
  <link rel="stylesheet" href="/Public/layui/css/layui.css">
  <link rel="stylesheet" href="/Public/css/admin.css">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">后台管理</div>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item"><a href="<?php echo U('Admin/Login/logout');?>">退出</a></li>
    </ul>
  </div>
  
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
        <li class="layui-nav-item layui-nav-itemed">
          <a class="" href="<?php echo U('Admin/UserManager/userManager');?>" target="main_iframe">登记用户管理</a>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">分类</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo U('Admin/Classify/country');?>" target="main_iframe">国家地区</a></dd>
            <dd><a href="<?php echo U('Admin/Classify/company');?>" target="main_iframe">派遣公司</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item"><a href="<?php echo U('Admin/UserManager/dispatch');?>" target="main_iframe">派遣状态</a></li>
        <li class="layui-nav-item">
          <a href="javascript:;">文章管理</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo U('Admin/Article/index',array('type' => 1));?>" target="main_iframe">联系我们</a></dd>
            <dd><a href="<?php echo U('Admin/Article/index',array('type' => 0));?>" target="main_iframe">关于我们</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item"><a href="<?php echo U('Admin/Message/index');?>" target="main_iframe">系统消息</a></li>
        <li class="layui-nav-item"><a href="<?php echo U('Admin/FundsManager/index');?>" target="main_iframe">提现管理</a></li>

<!--         <li class="layui-nav-item"><a href="<?php echo U('Admin/Settings/index');?>" target="main_iframe">系统设置</a></li>

 -->      </ul>
    </div>
  </div>
  
  <div class="layui-body">
    <!-- 内容主体区域 -->
    <iframe src="<?php echo U('Admin/UserManager/userManager');?>" frameborder="0" name="main_iframe" class="user-iframe"></iframe>
  </div>
  
</div>
<script src="/Public/layui/layui.js"></script>
<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
  
});
</script>
</body>
</html>