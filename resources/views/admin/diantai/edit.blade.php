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
        <html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>Inline Form</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/dianTai/{{$id}}" method="post" enctype="multipart/form-data"> 
    {{csrf_field()}}
    {{method_field('PUT')}}
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">电台名称</label> 
       <div class="mws-form-item"> 
        <input type="text" class="medium" name="name" value="{{$row->name}}"/> 
       </div> 
      </div> 
    
      <div class="mws-form-row"> 
       <label class="mws-form-label">原专辑封面</label> 
       <div class="mws-form-item"> 
        <input type="text" class="medium" name="pic" readonly value="{{$row->pic}}">
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">专辑封面图片</label> 
       <div class="mws-form-item"> 
        <input type="file" class="medium" name="NewPic"/> 
      </div> 
      </div>   
     <div class="mws-button-row"> 
      <input type="submit" value="修改" class="btn btn-danger" /> 
      <input type="reset" value="重置" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>

    </div>
    <!-- 主体内容结束 -->
</div>
<!--主体div结束 -->
</body>
</html>
