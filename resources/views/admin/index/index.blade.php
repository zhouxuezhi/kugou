<!DOCTYPE html>
<html lang="en">
<head>
<!-- 静态资源 -->
@include('admin.public.static')
</head>
<body>
<!-- 公共头开始 -->
@include('admin.public.header')
<!-- 公共头结束 -->
<!--主体div开始 -->
<div id="mws-wrapper">
    <!-- Necessary markup, do not remove -->
    <div id="mws-sidebar-stitch"></div>
    <div id="mws-sidebar-bg"></div>
    <!-- 左侧导航开始 -->
    @include('admin.public.left')
    <!-- 左侧导航结束 --> 
    <!-- 主体内容开始 -->
    <div id="mws-container" class="clearfix">
        <!-- 功能模块板式页面 -->
        <h1>主页面</h1>

    </div>
    <!-- 主体内容结束 -->
</div>
<!--主体div结束 -->
</body>
</html>
