<?php if (!defined('THINK_PATH')) exit();?><title>系统信息</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">     
<meta content="yes" name="apple-mobile-web-app-capable">     
<meta content="black" name="apple-mobile-web-app-status-bar-style">     
<meta content="telephone=no" name="format-detection">
<link rel="stylesheet" href="/Public/layui/css/layui.css">
<link rel="stylesheet" href="/Public/css/index_m.css">
<script src="/Public/js/jquery.js"></script>
<script src="/Public/layui/layui.js"></script>
<script src="/Public/js/index.js"></script>
<div class="m-user-header">
	<div class="m-user-logo">
		<img src="/Public/images/logo-m-user.png" alt="">
	</div>
	<div class="m-detail-header" style="margin-bottom:10px;">
		<button class="layui-btn">个人中心</button>
	</div>
	<div class="m-user-header-btns">
		<a href="<?php echo U('User/popularize');?>" class="layui-btn" id="m-header-user-1">介绍好友</a>
		<a href="<?php echo U('User/deposit');?>" class="layui-btn" id="m-header-user-2">钱包提现</a>
	</div>
	<div class="m-user-header-btns">
		<a href="<?php echo U('User/messages');?>" class="layui-btn" id="m-header-user-3">系统消息</a>
		<a href="<?php echo U('User/sendCompany');?>" class="layui-btn" id="m-header-user-4">紧急救援</a>
	</div>
</div>

<table id="list" lay-filter="messages"></table>

<style>
	#m-header-user-3{
		background: #ce6600 !important;
	}
</style>

<script>
  layui.use('table', function(){
  var table = layui.table;
  //第一个实例
  table.render({
    elem: '#list'
    ,height: 400
    ,url: "<?php echo U('User/getMessages');?>" //数据接口
    ,page: true //开启分页
    ,cols: [[ //表头
      {field: 'message_id', title: 'ID',  sort: true,  fixed: 'left' ,width:10}
      ,{field: 'title', title: '标题'}
      ,{field: 'time', title: '时间', sort: true}
      ,{fixed:'right',title: '操作', align:'center',toolbar:'#read',width:70}
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