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
        <div class="mws-panel grid_8">
        <div class="mws-panel-header" style="height:50px;">
            <span>歌手添加</span>
        </div>
        @if(session('error'))
        <div class="mws-form-message error">
            {{session('error')}}
        </div>
        @elseif(session('success'))
        <div class="mws-form-message success">
            {{session('success')}}
        </div>
        @endif
        @if (count($errors) > 0)
        <div class="mws-form-message error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
        @endif
        <div class="mws-panel-body no-padding">
            <form class="mws-form" action="/singer" enctype="multipart/form-data" method="post">
                {{csrf_field()}}
                <div class="mws-form-inline">
                    <div class="mws-form-row">
                        <label class="mws-form-label">歌手姓名</label>
                        <div class="mws-form-item">
                            <input type="text" name="name" class="small">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">歌手性别</label>
                        <div class="mws-form-item">
                            <select class="small" name="sex">
                                <option value="">请选择</option>
                                <option value="1">男</option>
                                <option value="2">女</option>
                                <option value="3">组合</option>
                            </select>
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">歌手地区</label>
                        <div class="mws-form-item">
                            <select class="small" name="place">
                                <option value="">请选择</option>
                                <option value="1">华语地区</option>
                                <option value="2">日韩地区</option>
                                <option value="3">欧美地区</option>
                                <option value="4">其他</option>
                            </select>
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">歌手图片</label>
                        <div class="mws-form-item ">
                            <input type="file" class="" name="pic">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">歌手介绍</label>
                        <div class="mws-form-item">
                            <textarea rows="" cols="" class="small" name="content"></textarea>
                        </div>
                    </div>
                </div>
                <div class="mws-button-row">
                    <input type="submit" value="添加" class="btn btn-danger">
                    <input type="reset" value="重置" class="btn ">
                </div>
            </form>
        </div>      
        </div>

    </div>
    <!-- 主体内容结束 -->
</div>
<!--主体div结束 -->
</body>
</html>
