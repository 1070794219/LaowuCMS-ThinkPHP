<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" href="/Public/layui/css/layui.css">
<link rel="stylesheet" href="/Public/css/index.css">
<script src="/Public/layui/layui.js"></script>
<div class="layui-main myInfo-main">
	<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
	  <legend>个人信息</legend>
	</fieldset>
	<form class="layui-form" action="<?php echo U('Admin/UserManager/allotUserFunc');?>" method="post">
	  <div class="layui-form-item">
	    <label class="layui-form-label">用户名</label>
	    <div class="layui-input-block">
	      <input type="text" name="phone" autocomplete="off" class="layui-input" disabled="disabled" value="<?php echo ($user['username']); ?>">
	    </div>
	  </div>
	  <div class="layui-form-item">
	    <label class="layui-form-label">昵称</label>
	    <div class="layui-input-block">
	      <input type="text" name="nickname" lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo ($user['nickname']); ?>"  disabled="disabled">
	    </div>
	  </div>
	  
	  <div class="layui-form-item">
	    <div class="layui-inline">
	      <label class="layui-form-label">派遣状态</label>
	      <div class="layui-input-inline user-myInfo-status">
    		<?php if($user['status1'] == 0): ?><!-- 未分配 -->
	      		<span class="layui-badge layui-bg-gray">未分配</span>
	      	<?php else: ?>
	      		<span class="layui-badge layui-bg-green">已分配</span><?php endif; ?>
	      	|
	      	<?php if($user['status2'] == 0): ?><span class="layui-badge layui-bg-gray">未派遣</span>
	      	<?php else: ?>
	      		<span class="layui-badge layui-bg-blue">已派遣</span><?php endif; ?>
	      </div>
	    </div>
	    <div class="layui-inline user-myInfo-fans">
	      <label class="layui-form-label">分配到</label>
	      <div class="layui-input-inline">
	        <select name="company" lay-verify="">
	        	<?php if(is_array($company)): $i = 0; $__LIST__ = $company;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><option value="<?php echo ($c['id']); ?>"><?php echo ($c['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select> 
	      </div>
	    </div>
	  </div>
	
	  <div class="layui-form-item">
	    <button class="layui-btn" lay-submit="" lay-filter="demo2" style="margin-left:50px">修改资料</button>
	  </div>
	  <input type="hidden" name="user_id" value="<?php echo ($user['id']); ?>">
	</form>
	 
</div>
<script type="text/javascript">
    layui.use(['form'], function () {
        var form = layui.form(), $ = layui.jquery;
    });
</script>