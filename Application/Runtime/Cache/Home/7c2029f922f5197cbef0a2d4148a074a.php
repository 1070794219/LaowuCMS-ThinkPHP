<?php if (!defined('THINK_PATH')) exit();?><title>个人信息</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">     
<meta content="yes" name="apple-mobile-web-app-capable">     
<meta content="black" name="apple-mobile-web-app-status-bar-style">     
<meta content="telephone=no" name="format-detection">
<link rel="stylesheet" href="/Public/layui/css/layui.css">
<link rel="stylesheet" href="/Public/css/index_m.css">
<script src="/Public/js/jquery.js"></script>
<script src="/Public/layui/layui.js"></script>
<script src="/Public/js/index.js"></script>
<div class="m-user-header">
	<div class="m-user-logo">
		<img src="/Public/images/logo-m-user.png" alt="">
	</div>
	<div class="m-detail-header" style="margin-bottom:10px;">
		<button class="layui-btn">个人中心</button>
	</div>
	<div class="m-user-header-btns">
		<a href="<?php echo U('User/popularize');?>" class="layui-btn" id="m-header-user-1">介绍好友</a>
		<a href="<?php echo U('User/deposit');?>" class="layui-btn" id="m-header-user-2">钱包提现</a>
	</div>
	<div class="m-user-header-btns">
		<a href="<?php echo U('User/messages');?>" class="layui-btn" id="m-header-user-3">系统消息</a>
		<a href="<?php echo U('User/sendCompany');?>" class="layui-btn" id="m-header-user-4">紧急救援</a>
	</div>
</div>

<form class="layui-form m-myInfo-main" action="<?php echo U('User/saveInfo');?>" method="post">
	  <div class="layui-form-item">
	    <label class="layui-form-label">用户名:</label>
	    <div class="layui-input-block">
	      <input type="text" name="phone" autocomplete="off" class="layui-input" disabled="disabled" value="<?php echo ($user['username']); ?>">
	    </div>
	  </div>
	  <div class="layui-form-item">
	    <label class="layui-form-label">昵 称:</label>
	    <div class="layui-input-block">
	      <input type="text" name="nickname" lay-verify="required" disabled="disabled" autocomplete="off" class="layui-input" value="<?php echo ($user['nickname']); ?>">
	    </div>
	  </div>
	  
	  <div class="layui-form-item">
	    <div class="layui-inline">
	      <label class="layui-form-label">状态:</label>
	      <div class="layui-input-inline user-myInfo-status">
	      <label class="layui-form-label m-myInfo-status">
    		<?php if($user['status1'] == 0): ?><!-- 未分配 -->
	      		未分配
	      	<?php else: ?>
	      		已分配<?php endif; ?>
	      	|
	      	<?php if($user['status2'] == 0): ?>未派遣
	      	<?php else: ?>
	      		已派遣<?php endif; ?>
	      	</label>
	      </div>
	    </div>
	    <div class="layui-inline user-myInfo-fans">
	      <label class="layui-form-label">介绍人数:</label>
	      <div class="layui-input-inline">
	        <label class="layui-form-label m-myInfo-status"><?php echo ($user['fans']); ?> 人</label>
	      </div>
	    </div>
	  </div>
	  <input type="hidden" name="type" value="info">

	<!-- 修改密码 -->
	  <div class="layui-form-item">
	    <div class="layui-inline">
	      <label class="layui-form-label">新密码</label>
	      <div class="layui-input-inline">
	        <input type="password" name="password" lay-verify="required" autocomplete="off" class="layui-input" placeholder="如不修改不用填写">
	      </div>
	    </div>
	  </div>
	  <div class="layui-form-item">
	    <div class="layui-inline">
	      <label class="layui-form-label" style="width:110%;text-align:center">提示:成功介绍派遣的单人奖励<?php echo C('reward');?>元</label>
	    </div>
	  </div>
	  <div class="layui-form-item">
	    <button class="layui-btn" lay-submit="" lay-filter="demo2" style="width:70%;margin-left:25%;background:#ce6600">点击修改</button>
	  </div>
	  <input type="hidden" name="type" value="pwd">
	</form>