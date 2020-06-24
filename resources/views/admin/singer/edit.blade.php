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
            <form class="mws-form" action="/singer/{{$data->id}}" enctype="multipart/form-data" method="post">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <div class="mws-form-inline">
                    <div class="mws-form-row">
                        <label class="mws-form-label">歌手姓名</label>
                        <div class="mws-form-item">
                            <input type="text" name="name" class="small" value="{{$data->name}}">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">歌手性别</label>
                        <div class="mws-form-item">
                            <select class="small" name="sex">
                               <!--  <option value="">请选择</option> -->
                                @if($data->sex==1)
                                <option value="1" selected>男</option>
                                <option value="2">女</option>
                                <option value="3">组合</option>
                                @elseif($data->sex==2)
                                <option value="1" >男</option>
                                <option value="2" selected>女</option>
                                <option value="3">组合</option>
                                @elseif($data->sex==3)
                                <option value="1" >男</option>
                                <option value="2">女</option>
                                <option value="3" selected>组合</option>
                                @endif  
                            </select>
                        </div>
                    </div>
                    <div class="mws-form-row">
                    <label class="mws-form-label">歌手地区</label>
                        <div class="mws-form-item">
                            <select class="small" name="place">
                                
                                @if($data->place==1)
                                <option value="1" selected>华语地区</option>
                                <option value="2">日韩地区</option>
                                <option value="3">欧美地区</option>
                                <option value="4">其他</option>
                                @elseif($data->place==2)
                                <option value="1">华语地区</option>
                                <option value="2" selected>日韩地区</option>>
                                <option value="3">欧美地区</option>
                                <option value="4">其他</option>日韩地区</option>
                                @elseif($data->place==3)
                                <option value="1">华语地区</option>
                                <option value="2">日韩地区</option>
                                <option value="3" selected>欧美地区</option>
                                <option value="4">其他</option>
                                @else
                                <option value="1">华语地区</option>
                                <option value="2">日韩地区</option>
                                <option value="3">欧美地区</option>
                                <option value="4" selected>其他</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">歌手图片</label>
                        <div class="mws-form-item ">
                            <img src="{{ltrim($data->pic,'.')}}">
                            <input type="file" name="pic" value="{{$data->pic}}">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">歌手介绍</label>
                        <div class="mws-form-item">
                            <textarea rows="" cols="" class="small" name="content">{{$data->content}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="mws-button-row">
                    <input type="submit" value="修改" class="btn btn-danger">
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
