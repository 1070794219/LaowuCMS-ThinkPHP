<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" href="/Public/layui/css/layui.css">
<link rel="stylesheet" href="/Public/css/admin.css">
<script src="/Public/layui/layui.js"></script>

<div class="layui-main userManager-main">
	<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
	  <legend>登记信息管理</legend>
	</fieldset>
	<table id="list" lay-filter="messages"></table>
</div>

<script>
  layui.use('table', function(){
  var table = layui.table;
  //第一个实例
  table.render({
    elem: '#list'
    ,height: 500
    ,url: "<?php echo U('Admin/UserManager/getUserManager');?>" //数据接口
    ,page: true //开启分页
    ,cols: [[ //表头
      {field: 'user_id', title: 'ID',  sort: true, width:50, fixed: 'left'}
      ,{field: 'name', title: '姓名',width:100,}
      ,{field: 'phone', title: '电话', width:150}
      ,{field: 'country', title: '国籍', width:120}
      ,{field: 'sex', title: '性别', width:120}
      ,{field: 'wechat', title: '微信', width:150}
      ,{field: 'status', title: '状态', width:80}
      ,{field: 'time', title: '时间', width:120, sort: true,}
      ,{fixed:'right',title: '操作', width:180,align:'center',toolbar:'#userTool'}
    ]]
  });

    //监听工具条
	table.on('tool(messages)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
	  var data = obj.data; //获得当前行数据
	  var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
	  var tr = obj.tr; //获得当前行 tr 的DOM对象
	  var id = parseInt(tr.find("td[data-field='user_id']").find("div").html());
	 
	  if(layEvent === 'block'){ //拉黑
	    window.location.href = "<?php echo U('Admin/UserManager/blockUser');?>" + "?id=" + id;
	  }else if(layEvent === 'allot'){ //分配
	  	window.location.href = "<?php echo U('Admin/UserManager/allotUser');?>" + "?id=" + id;
	  }else if(layEvent === 'del'){ //删除
	  	window.location.href = "<?php echo U('Admin/UserManager/deleteJob');?>" + "?id=" + id;
	  }
	});
 });

</script>

<script type="text/html" id="userTool">
  <a class="layui-btn layui-btn-warm layui-btn-xs" lay-event="block">拉黑</a>
  <a class="layui-btn layui-btn-xs" lay-event="allot">分配</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>

</script>