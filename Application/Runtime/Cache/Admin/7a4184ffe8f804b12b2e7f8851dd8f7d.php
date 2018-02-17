<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" href="/Public/layui/css/layui.css">
<link rel="stylesheet" href="/Public/css/admin.css">
<script src="/Public/layui/layui.js"></script>
<script src="/Public/js/jquery.js"></script>
<div class="layui-main message-main">
	<fieldset class="layui-elem-field layui-field-title" style="">
	  <legend>文章</legend>
	</fieldset>
  <button class="layui-btn" id="add-message">添加信息</button>
	<table id="list" lay-filter="messages"></table>
</div>

<script>
  layui.use('table', function(){
  var table = layui.table;
  var type = "<?php echo I('get.type');?>";
  //第一个实例
  table.render({
    elem: '#list'
    ,height: 500
    ,url: "<?php echo U('Admin/Article/articles');?>" //数据接口
    ,where: {type:type}
    ,page: true //开启分页
    ,cols: [[ //表头
      {field: 'id', title: '信息ID',  sort: true, width:100, fixed: 'left'}
      ,{field: 'title', title: '信息标题'}
      ,{field: 'time', title: '时间', width:120, sort: true}
      ,{fixed:'right',title: '操作', width:150,align:'center',toolbar:'#bar'}
    ]]
  });

    //监听工具条
	table.on('tool(messages)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
	  var data = obj.data; //获得当前行数据
	  var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
	  var tr = obj.tr; //获得当前行 tr 的DOM对象
	  var id = parseInt(tr.find("td[data-field='id']").find("div").html());

	  if(layEvent === 'detail'){ //查看
	    //do somehing
	    window.location.href = "<?php echo U('Admin/Article/detail');?>" + "?id=" + id;
	  }else if(layEvent === 'delete'){
      window.location.href = "<?php echo U('Admin/Article/delete');?>" + "?id=" + id;
    }else if(layEvent === 'change'){
      window.location.href = "<?php echo U('Admin/Article/change');?>" + "?id=" + id;
    }
	});
 });
</script>
<script type="text/html" id="bar">
  <a class="layui-btn layui-btn-xs" lay-event="detail">查看</a>
  <a class="layui-btn layui-btn-xs" lay-event="change">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delete">删除</a>
</script>

<script>
  $(function(){
    $('#add-message').click(function(){
      window.location.href = "<?php echo U('Admin/Article/add',array('type' => I('get.type')));?>";
    })
  })
</script>