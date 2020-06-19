<!DOCTYPE html>
<html lang="en">
<head>
<!-- 静态资源 -->
@include('admin.public.static')
<style>
.hiddens1{
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
        <div class="mws-panel grid_8">
            <div class="mws-panel-header" style="height:50px;">
                <span><i class="icon-table"></i> 歌手列表</span>
            </div>
            <div style="width:100%;height:50px;line-height: 50px; ">
                <div style="float: right;">
                <form action="/singer" method="get">
                    搜索内容：<input type="text" name="search" @if($search)value="{{$search}}"@endif placeholder="请输入歌手名">
                    <input type="submit" value="搜索" class="btn btn-info"> 
                    {{csrf_field()}}
               </form>
               </div>
            </div>
            <div class="mws-panel-body no-padding">
                <table class="mws-table">
                    <thead>
                        <tr>
                            <th>歌手序号</th>
                            <th>歌手姓名</th>
                            <th>歌手性别</th>
                            <th>歌手图片</th>
                            <th>歌手地区</th>
                            <th>歌手点击量</th>
                            <th>歌手简介</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($data as $v)
                        <tr align="center">
                            <td>{{$v->id}}</td>
                            <td>{{$v->name}}</td>
                            <td>
                                @if($v->sex==1)
                                    男
                                @endif
                                @if($v->sex==2)
                                    女
                                @endif
                                @if($v->sex==3)
                                    组合
                                @endif
                            </td>
                            <td><img src="{{$v->pic}}" class="img-thumbnail" style="width:60px;"></td>
                            <td>
                                @if($v->place==1)
                                    华语地区
                                @endif
                                @if($v->place==2)
                                    日韩地区
                                @endif
                                @if($v->place==3)
                                    欧美地区
                                @endif
                                @if($v->place==4)
                                    其他
                                @endif
                            </td>
                            <td>
                                {{$v->num}}
                            </td>
                            <td >
                                <p title="{{$v->content}}"style="width:50px;" class="hiddens1">{{$v->content}}</p>
                            </td>
                            <td>
                                <a href="/singer/{{$v->id}}/edit" class="btn btn-success">修改</a>
                                <a href="javascript:;"  class="btn btn-danger del" id="{{$v->id}}">删除</a> 
                            </td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
                <div style="float: right;margin-right: 50px;">
                    {{$data->appends(['search'=>$search])->render()}}
                </div>
                
            </div>
        </div>




    </div>
    <!-- 主体内容结束 -->
</div>
<!--主体div结束 -->
</body>
<script>
    $('.del').click(function(){
        var id=$(this).context.id;
        var tr=$(this).parents('tr');
        if(confirm('确定删除吗？')){
             $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                //路由
                url:'/singer/1',
                //传值
                data:{'id':id},
                //后端返回类型
                dataType:'json',
                //请求方式
                type:'DELETE',
                //成功回调
                success:function(res){
                    console.log(res);
                    if(res.status==200){
                        tr.remove();
                    }else{
                        alert('删除失败');
                    }
                },
                //失败回调
                error:function(res2){
                    console.log(res2);
                }
            })
        }
       
    });
</script>
</html>
