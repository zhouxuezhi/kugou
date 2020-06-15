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
        return view('Admin.album.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
