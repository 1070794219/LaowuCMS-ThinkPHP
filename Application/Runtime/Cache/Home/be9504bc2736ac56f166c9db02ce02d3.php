<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" href="/Public/layui/css/layui.css">
<link rel="stylesheet" href="/Public/css/index.css">
<script src="/Public/layui/layui.js"></script>
<div class="layui-main myInfo-main">
	<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
	  <legend>个人信息</legend>
	</fieldset>
	<form class="layui-form" action="<?php echo U('User/saveInfo');?>" method="post">
	  <div class="layui-form-item">
	    <label class="layui-form-label">用户名</label>
	    <div class="layui-input-block">
	      <input type="text" name="phone" autocomplete="off" class="layui-input" disabled="disabled" value="<?php echo ($user['username']); ?>">
	    </div>
	  </div>
	  <div class="layui-form-item">
	    <label class="layui-form-label">昵称</label>
	    <div class="layui-input-block">
	      <input type="text" name="nickname" lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo ($user['nickname']); ?>">
	    </div>
	  </div>
	  
	  <div class="layui-form-item">
	    <div class="layui-inline">
	      <label class="layui-form-label">派遣状态</label>
	      <div class="layui-input-inline user-myInfo-status">
    		<?php if($res['status1'] == 0): ?><!-- 未分配 -->
	      		<span class="layui-badge layui-bg-gray">未分配</span>
	      	<?php else: ?>
	      		<span class="layui-badge layui-bg-green">已分配</span><?php endif; ?>
	      	|
	      	<?php if($res['status2'] == 0): ?><span class="layui-badge layui-bg-gray">未派遣</span>
	      	<?php else: ?>
	      		<span class="layui-badge layui-bg-blue">已派遣</span><?php endif; ?>
	      </div>
	    </div>
	    <div class="layui-inline user-myInfo-fans">
	      <label class="layui-form-label">介绍人数</label>
	      <div class="layui-input-inline">
	        <button class="layui-btn layui-bg-blue" disabled="disabled"><?php echo ($user['fans']); ?> 人<span class="layui-badge layui-bg-gray">当前单人奖励金额为 <?php echo C('reward');?></span></button>
	      </div>
	    </div>
	  </div>

	  <div class="layui-form-item">
	    <button class="layui-btn" lay-submit="" lay-filter="demo2" style="margin-left:50px">修改资料</button>
	  </div>
	  <input type="hidden" name="type" value="info">
	</form>

	<!-- 修改密码 -->
	<form action="<?php echo U('User/saveInfo');?>" method="post">  
	<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
	  <legend>修改密码</legend>
	</fieldset>
	  <div class="layui-form-item">
	    <div class="layui-inline">
	      <label class="layui-form-label">新密码</label>
	      <div class="layui-input-inline">
	        <input type="password" name="password" lay-verify="required" autocomplete="off" class="layui-input">
	      </div>
	    </div>
	  </div>
	  <div class="layui-form-item">
	    <button class="layui-btn" lay-submit="" lay-filter="demo2" style="margin-left:50px">修改密码</button>
	  </div>
	  <input type="hidden" name="type" value="pwd">
	</form>
	 
</div>