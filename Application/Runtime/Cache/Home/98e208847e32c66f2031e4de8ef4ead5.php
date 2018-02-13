<?php if (!defined('THINK_PATH')) exit();?><title>查询工作状态</title>
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
<div class="layui-main search-main">
	<form action="<?php echo U('Search/result');?>" method="get" class="layui-form">
		<div class="search-bar">
			<input type="text" class="layui-input" placeholder="请输入您预留的手机号进行查询" style="float:left;width:500px" lay-verify="required|phone" name="phone"> 
			<button class="layui-btn" lay-filter="formDemo" style="float:right;width:90px">搜索</button>
		</div>
	</form>
	<div class="clear"></div>
	<?php if($show): ?><div class="search-list">
			<fieldset class="layui-elem-field layui-field-title">
			  <legend>以下为搜索结果</legend>
			</fieldset>
			<table class="layui-table">
			  <colgroup>
			    <col width="150">
			    <col width="200">
			    <col>
			  </colgroup>
			  <thead>
			    <tr>
			      <th>姓名</th>
			      <th>申请国籍</th>
			      <th>申请时间</th>
			      <th>当前状态</th>
			    </tr> 
			  </thead>
			  <tbody>
			    <tr>
			      <td><?php echo ($res['name']); ?></td>
			      <td><?php echo ($res['country']); ?></td>
			      <td><?php echo (date("Y-m-d H:i",$res['time'])); ?></td>
			      <td>
			      	<?php if($res['status1'] == 0): ?><!-- 未分配 -->
			      		<span class="layui-badge layui-bg-gray">未分配</span>
			      	<?php else: ?>
			      		<span class="layui-badge layui-bg-green">已分配</span><?php endif; ?>
			      	|
			      	<?php if($res['status2'] == 0): ?><span class="layui-badge layui-bg-gray">未派遣</span>
			      	<?php else: ?>
			      		<span class="layui-badge layui-bg-blue">已派遣</span><?php endif; ?>
			      </td>
			    </tr>
			  </tbody>
			</table>
		</div><?php endif; ?>
</div>

<script>
</script>
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