<?php if (!defined('THINK_PATH')) exit();?><title>文章列表</title>
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
          <li class="layui-nav-item" id="u_login">登录/注册</li>
        </ul><?php endif; ?>
     </div>
  </div>

<script>
  $('#u_login').click(function(){
    window.location.href = "<?php echo U('Login/index');?>";
  })
</script>

<div class="layui-main article-main">
    <p class="index-tip"><i class="layui-icon" style="font-size: 25px; color: #FF5722">&#xe756;</i><?php echo ($typename); ?></p>
	<table id="list" lay-filter="arclist"></table>
</div>
<script>
layui.use('table', function(){
  var table = layui.table;
  var type = <?php echo ($type); ?>;
  //第一个实例
  table.render({
    elem: '#list'
    ,height: 800
    ,url: "<?php echo U('Article/getList');?>" //数据接口
    ,where: {type: type}
    ,page: true //开启分页
    ,cols: [[ //表头
      {field: 'id', title: 'ID',  sort: true, width:50, fixed: 'left'}
      ,{field: 'title', title: '文章标题'}
      ,{field: 'time', title: '发布时间', width:150, sort: true}
      ,{fixed:'right',width:150,align:'center',toolbar:'#arcBar'}
    ]]
  });

  //监听工具条
	table.on('tool(arclist)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
	  var data = obj.data; //获得当前行数据
	  var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
	  var tr = obj.tr; //获得当前行 tr 的DOM对象
	 
	  if(layEvent === 'detail'){ //查看
	    //do somehing
	    var id = parseInt(tr.find("td[data-field='id']").find("div").html());
	    window.location.href = "<?php echo U('Article/detail');?>" + "?id=" + id;
	  }
	});

});
</script>
<script type="text/html" id="arcBar">
  <a class="layui-btn layui-btn-xs" lay-event="detail">查看原文</a>
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