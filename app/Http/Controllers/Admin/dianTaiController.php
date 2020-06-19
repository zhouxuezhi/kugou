<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class dianTaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data=DB::table('diantai')->get();
        return view('admin.diantai.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.diantai.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取数据
        $data=$request->except('_token');
        if($request->hasFile('pic')){
            //初始化名字
            $name=time()+rand(1000,9999);
            //获取后缀
            $ext=$request->file('pic')->getClientOriginalExtension();
            $albumName=$name.".".$ext;
            //移动到指定目录
            $request->file('pic')->move("./uploads/diantai/".date('Y-m-d'),$albumName);
            //专辑封面路径
            $data['pic']="./uploads/diantai/".date('Y-m-d')."/".$name.".".$ext;
            //插入表中
            DB::table('diantai')->insert($data);
            //设置添加返回成功样式
            return redirect('/dianTai')->with('success','添加成功');
        }else{
           
            // 设置没有文件上传失败的样式
            return back()-with('error','添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $row=DB::table('diantai')->where('id','=',$id)->first();
      
        return view('admin.diantai.edit',['row'=>$row,'id'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //查询原数据
        $row=DB::table('diantai')->where('id','=',$id)->first();
         $data=$request->except('_token','_method','NewPic');
        if($request->hasFile('NewPic')){
            //初始化名字
            $name=time()+rand(1000,9999);
            //获取后缀
            $ext=$request->file('NewPic')->getClientOriginalExtension();
            $dianTaiName=$name.".".$ext;
            //移动到指定目录
            $request->file('NewPic')->move("./uploads/diantai/".date('Y-m-d'),$dianTaiName);
            //专辑封面路径
            $data['pic']="./uploads/diantai/".date('Y-m-d')."/".$name.".".$ext;
            //删除原专辑封面

            unlink($row->pic);
        }else{
            $data['pic']=$request->input('pic');
        }
       
        if(DB::table('diantai')->where('id','=',$id)->update($data)){
            return redirect('/dianTai');
        }else{
            return back();
        }
    
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除id对应的数据
        if($data=DB::table('diantai')->where('id','=',$id)->first()){
            //删除对应的封面图片
            DB::table('diantai')->where('id','=',$id)->delete();
            unlink($data->pic); 
            //带回删除成功
            return redirect('/dianTai');
        }else{
            echo "删除失败";
            //带回删除失败
            return back();

        }
    }
}
