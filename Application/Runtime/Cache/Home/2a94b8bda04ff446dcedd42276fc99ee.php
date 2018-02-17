<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo C('webname');?></title>
  <link rel="stylesheet" href="/Public/css/owl.carousel.css">
  <link rel="stylesheet" href="/Public/css/owl.theme.css">
</head>
<body style="background-color: #eee;">
    <link rel="stylesheet" href="/Public/layui/css/layui.css">
  <link rel="stylesheet" href="/Public/css/index.css">
  <script src="/Public/js/jquery.js"></script>
  <script src="/Public/layui/layui.js"></script>
  <script src="/Public/js/index.js"></script>
  <div class="layui-header header">
     <div class="layui-main">
      <a class="logo" href="/">
        <img src="/Public/images/logo.png" alt="layui">
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

  <!-- 轮播图 -->
  <div class="layui-carousel" id="lantern">
    <div carousel-item>
      <div><img src="//res.layui.com/images/layui/demo/1.png"></div>
      <div><img src="//res.layui.com/images/layui/demo/2.png"></div>
      <div><img src="//res.layui.com/images/layui/demo/3.png"></div>
      <div><img src="//res.layui.com/images/layui/demo/4.png"></div>
      <div><img src="//res.layui.com/images/layui/demo/5.png"></div>
      <div><img src="//res.layui.com/images/layui/demo/6.png"></div>
      <div><img src="//res.layui.com/images/layui/demo/7.png"></div>
    </div>
  </div>

  <!-- 文章 -->
  <div class="layui-main index-main">
<!--     <p class="index-tip"><i class="layui-icon" style="font-size: 25px; color: #FF5722">&#xe756;
</i>  
最新公告</p> -->
    <ul class="site-idea">
      <li class="index-about">
        <fieldset class="layui-elem-field layui-field-title">
          <legend>关于我们</legend>
          <img src="<?php echo C('about_img');?>" alt="">
          <p><?php echo C('about_body');?></p>
        </fieldset>
      </li>
      <li class="index-news">
        <fieldset class="layui-elem-field layui-field-title">
          <legend>最新资讯</legend>
            <?php if(is_array($arclist)): $i = 0; $__LIST__ = $arclist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$arc): $mod = ($i % 2 );++$i;?><p><a href="<?php echo U('Article/detail',array('id'=>$arc['id']));?>" style="width:295px;overflow:hidden">* <?php echo ($arc['title']); ?></a><span><?php echo (date('Y-m-d',$arc['time'])); ?></span></p><?php endforeach; endif; else: echo "" ;endif; ?>
        </fieldset>
      </li>
      <li class="index-contact">
        <fieldset class="layui-elem-field layui-field-title">
          <legend>联系我们</legend>
          <p>地址: <?php echo C('contact_address');?></p>
          <p>电话: <?php echo C('contact_phone');?></p>
          <p><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('contact_qq');?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo C('contact_qq');?>:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></p>
        </fieldset>
      </li>
      <li class="index-shows">
        <fieldset class="layui-elem-field layui-field-title">
          <legend>合作公司办公环境一览</legend>
              <div id="owl-demo" class="owl-carousel">
                  <a class="item"><img src="/Public/images/owl1.jpg" alt=""></a>
                  <a class="item"><img src="/Public/images/owl2.jpg" alt=""></a>
                  <a class="item"><img src="/Public/images/owl3.jpg" alt=""></a>
                  <a class="item"><img src="/Public/images/owl4.jpg" alt=""></a>
                  <a class="item"><img src="/Public/images/owl5.jpg" alt=""></a>
                  <a class="item"><img src="/Public/images/owl6.jpg" alt=""></a>
                  <a class="item"><img src="/Public/images/owl7.jpg" alt=""></a>
                  <a class="item"><img src="/Public/images/owl8.jpg" alt=""></a>
                  <a class="item"><img src="/Public/images/owl1.jpg" alt=""></a>
                  <a class="item"><img src="/Public/images/owl2.jpg" alt=""></a>
                  <a class="item"><img src="/Public/images/owl3.jpg" alt=""></a>
                  <a class="item"><img src="/Public/images/owl4.jpg" alt=""></a>
                  <a class="item"><img src="/Public/images/owl5.jpg" alt=""></a>
                  <a class="item"><img src="/Public/images/owl6.jpg" alt=""></a>
                  <a class="item"><img src="/Public/images/owl7.jpg" alt=""></a>
                  <a class="item"><img src="/Public/images/owl8.jpg" alt=""></a>
              </div>
    </fieldset>
      </li>
    </ul>


  </div>

  <!-- 底部 -->
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
</body>
<script src="/Public/js/owl.carousel.js"></script>
<script>
  $(function(){
    $('#owl-demo').owlCarousel({
      autoPlay: 2000,
    });
});
</script>
<script>
layui.use('carousel', function(){
  var carousel = layui.carousel;
  //建造实例
  carousel.render({
    elem: '#lantern'
    ,width: '100%' //设置容器宽度
    ,height: '250px'
    //,anim: 'updown' //切换动画方式
  });
});
</script>
</html>