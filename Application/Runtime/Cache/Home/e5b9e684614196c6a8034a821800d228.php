<?php if (!defined('THINK_PATH')) exit();?><title>查询工作状态</title>
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
<div class="m-detail-header">
	<button class="layui-btn">查询工作状态</button>
</div>
<form action="<?php echo U('Search/result');?>" method="get" class="layui-form m-search-main">
<?php if(!$show): ?><div class="layui-form-item">
		<div class="layui-input-inner">
			<input type="text" class="layui-input" placeholder="请输入您预留的手机号进行查询"  lay-verify="required|phone" name="phone"> 
		</div>
	</div>
	<div class="layui-form-item">
		<div class="layui-input-inner">
			<button class="layui-btn" lay-filter="formDemo" style="margin-left:80px;background: #02338f;">搜索</button>
		</div>
	</div><?php endif; ?>
</form>
<div class="clear"></div>
<?php if($show): ?><div class="m-search-list">
		<p>姓名：<?php echo ($res['name']); ?></p>
		<p>国籍：<?php echo ($res['country']); ?></p>
		<p>时间：<?php echo (date("Y-m-d H:i",$res['time'])); ?></p>
		<p>状态：
			<?php if($res['status1'] == 0): ?><!-- 未分配 -->
		  		未分配
		  	<?php else: ?>
		  		已分配<?php endif; ?>
		  	|
		  	<?php if($res['status2'] == 0): ?>未派遣
		  	<?php else: ?>
		  		已派遣<?php endif; ?>
		</p>
	</div>
	<p class="m-search-tip">提示：分配派遣后您将收到手机短信提醒</p><?php endif; ?>


<script>
</script>