<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" href="/Public/layui/css/layui.css">
<link rel="stylesheet" href="/Public/css/index.css">
<script src="/Public/layui/layui.js"></script>
<div class="layui-main message-main">
	<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
	  <legend>系统消息</legend>
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
    ,url: "<?php echo U('User/getMessages');?>" //数据接口
    ,page: true //开启分页
    ,cols: [[ //表头
      {field: 'message_id', title: '信息ID',  sort: true, width:100, fixed: 'left'}
      ,{field: 'title', title: '信息标题'}
      ,{field: 'status', title: '状态', width:100, sort: true}
      ,{field: 'time', title: '时间', width:120, sort: true}
      ,{fixed:'right',title: '操作', width:100,align:'center',toolbar:'#read'}
    ]]
  });

    //监听工具条
	table.on('tool(messages)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
	  var data = obj.data; //获得当前行数据
	  var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
	  var tr = obj.tr; //获得当前行 tr 的DOM对象
	 
	  if(layEvent === 'detail'){ //查看
	    //do somehing
	    var id = parseInt(tr.find("td[data-field='message_id']").find("div").html());
	    window.location.href = "<?php echo U('User/messageDetail');?>" + "?id=" + id;
	  }
	});
 });
</script>
<script type="text/html" id="read">
  <a class="layui-btn layui-btn-xs" lay-event="detail">查看</a>
</script>