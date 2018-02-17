<?php if (!defined('THINK_PATH')) exit();?><title>登记找工作</title>
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
	<button class="layui-btn">登记找工作</button>
</div>
	<form action="<?php echo U('SignJob/addRecord');?>" class="layui-form m-sign-main" method="post">
		<div class="layui-form-item">
			<div class="layui-inline">
			    <label class="layui-form-label">姓名</label>
			    <div class="layui-input-inline">
			      <input type="text" name="name" autocomplete="off" class="layui-input" lay-verify="required" placeholder="姓名">
			    </div>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-inline">
		      <label class="layui-form-label">国籍</label>
		      <div class="layui-input-inline">
		        <select name="country" lay-verify="">
		        	<?php if(is_array($country)): $i = 0; $__LIST__ = $country;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><option value="<?php echo ($c['id']); ?>"><?php echo ($c['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select> 
		      </div>
		    </div>
		</div>
		<div class="layui-form-item">
<!-- 		    <div class="layui-inline">
 -->		      <label class="layui-form-label">性别</label>
		      <div class="layui-input-block">
		      	<input type="radio" name="sex" value="0" title="女" checked>
		        <input type="radio" name="sex" value="1" title="男">
		      </div>
		    <!-- </div> -->
		</div>
		<div class="layui-form-item">
			<div class="layui-inline">
			    <label class="layui-form-label">微信</label>
			    <div class="layui-input-inline">
			      <input type="text" name="wechat" autocomplete="off" class="layui-input" lay-verify="required" placeholder="微信号">
			    </div>
			</div>
		</div>

		  <div class="layui-form-item">
		    <button class="layui-btn" lay-submit="" lay-filter="demo2" style="margin-left:170px;background: #02338f;">登记</button>
		</div>
	</form>
<script type="text/javascript">
    layui.use(['form'], function () {
        var form = layui.form(), $ = layui.jquery;
    });
</script>