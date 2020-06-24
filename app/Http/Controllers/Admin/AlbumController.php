<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
//设置中间件 歌手选择不能为0
use Illuminate\Http\Resources\Json\Resource;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //查询信息
        $data=DB::table('zhuanji')->join('singer','singer_id','=','singer.id')->select('zhuanji.*','singer.name')->get();
        return view('Admin.album.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //获取歌手表数据
        $data=DB::table('singer')->get();
        return view('Admin.album.add',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');
        //写工具匠控制singer不能为0
        //图片上传时间
        $data['addtime']=time();
        //获取歌手id
        $data['singer_id']=$request->input('singer_id');
        //判断上传图片不能为空
        if($request->hasFile('pic')){
            //初始化名字
            $name=time()+rand(1000,9999);
            //获取后缀
            $ext=$request->file('pic')->getClientOriginalExtension();
            $albumName=$name.".".$ext;
            //移动到指定目录
            $request->file('pic')->move("./uploads/album/".date('Y-m-d'),$albumName);
            //专辑封面路径
            $data['pic']="./uploads/album/".date('Y-m-d')."/".$name.".".$ext;
            //插入表中
            DB::table('zhuanji')->insert($data);
            //设置添加返回成功样式
            return redirect('/Album');
        }else{
            echo "添加失败";
            // 设置没有文件上传失败的样式
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
         //获取歌手表数据
         $data=DB::table('singer')->get();
         //获取专辑表数据
         $row=DB::table('zhuanji')->join('singer','singer_id','=','singer.id')->select('zhuanji.*','singer.name')->where('zhuanji.id','=',$id)->first();
        //  $row=DB::table('zhuanji')->where('id','=',$id)->first();
        // dd($row);
        return view('Admin.album.edit',['data'=>$data,'row'=>$row,'id'=>$id]);
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
        $row=DB::table('zhuanji')->where('id','=',$id)->first();
         $data=$request->except('_token','_method','NewPic');
        if($request->hasFile('NewPic')){
            //初始化名字
            $name=time()+rand(1000,9999);
            //获取后缀
            $ext=$request->file('NewPic')->getClientOriginalExtension();
            $albumName=$name.".".$ext;
            //移动到指定目录
            $request->file('NewPic')->move("./uploads/album/".date('Y-m-d'),$albumName);
            //专辑封面路径
            $data['pic']="./uploads/album/".date('Y-m-d')."/".$name.".".$ext;
            //删除原专辑封面

            unlink($row->pic);
        }else{
            $data['pic']=$request->input('pic');
        }
       
        if(DB::table('zhuanji')->where('id','=',$id)->update($data)){
            return redirect('/Album');
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
        if($data=DB::table('zhuanji')->where('id','=',$id)->first()){
            //删除对应的封面图片
            DB::table('zhuanji')->where('id','=',$id)->delete();
            unlink($data->pic); 
            //带回删除成功
            return redirect('/Album');
        }else{
            echo "删除失败";
            //带回删除失败
            return back();

        }
        
    }
}
