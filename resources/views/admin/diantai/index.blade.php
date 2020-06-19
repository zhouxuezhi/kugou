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
  <div class="mws-panel-body no-padding"> 
   <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
   <div id="DataTables_Table_1_length" class="dataTables_length">
     <label>Show <select size="1" name="DataTables_Table_1_length" aria-controls="DataTables_Table_1"><option value="10" selected="selected">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label>
    </div>
    <div class="dataTables_filter" id="DataTables_Table_1_filter">
     <label>Search: <input type="text" aria-controls="DataTables_Table_1" /></label>
    </div>
    <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
     <thead> 
      <tr role="row">
       <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 181px;">编号</th>
       <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 247.01px;">电台名称</th>
       <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 156.01px;">状态</th>
       <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 156.01px;">封面图片路径</th>
       <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 117.01px;">操作</th>
      </tr> 
     </thead> 
     <tbody role="alert" aria-live="polite" aria-relevant="all">
     @foreach($data as $v)
      <tr class="odd"> 
       <td class="  sorting_1">{{$v->id}}</td> 
       <td class="  sorting_1">{{$v->name}}</td> 
       <td class="  sorting_1">{{$v->state}}</td> 
       <td class="  sorting_1">{{$v->pic}}</td> 
  
       <td>
            <form action="/dianTai/{{$v->id}}" method="post">
               {{method_field('DELETE')}}
               {{csrf_field()}}
            <button>删除</button>
            </form>
            <form action="/dianTai/{{$v->id}}/edit" method="get">
               
               {{csrf_field()}}
            <button>编辑</button>
            </form>
       
       </td> 
      </tr>
      @endforeach
     </tbody>
    </table>
    <div class="dataTables_info" id="DataTables_Table_1_info">
     Showing 1 to 10 of 57 entries
    </div>
    <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
     <a tabindex="0" class="first paginate_button paginate_button_disabled" id="DataTables_Table_1_first">First</a>
     <a tabindex="0" class="previous paginate_button paginate_button_disabled" id="DataTables_Table_1_previous">Previous</a>
     <span><a tabindex="0" class="paginate_active">1</a><a tabindex="0" class="paginate_button">2</a><a tabindex="0" class="paginate_button">3</a><a tabindex="0" class="paginate_button">4</a><a tabindex="0" class="paginate_button">5</a></span>
     <a tabindex="0" class="next paginate_button" id="DataTables_Table_1_next">Next</a>
     <a tabindex="0" class="last paginate_button" id="DataTables_Table_1_last">Last</a>
    </div>
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
