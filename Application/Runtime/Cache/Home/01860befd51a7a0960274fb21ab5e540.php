<?php if (!defined('THINK_PATH')) exit();?><title>登记找工作</title>
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
<div class="layui-main signjob-main" style="height:300px">
	<form action="<?php echo U('SignJob/addRecord');?>" class="layui-form" method="post">
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
		    <button class="layui-btn" lay-submit="" lay-filter="demo2" style="margin-left:170px">登记</button>
		</div>
	</form>
</div>
<script type="text/javascript">
    layui.use(['form'], function () {
        var form = layui.form(), $ = layui.jquery;
    });
</script>