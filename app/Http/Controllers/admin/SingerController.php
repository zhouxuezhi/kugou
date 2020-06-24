<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Storage;
class SingerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search=$request->input('search','');
        //歌手列表展示
        $data=DB::table('singer')->where('name','like',"%$search%")->Paginate(5);
        return view('admin.singer.index',['data'=>$data,'search'=>$search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //歌手添加
        return view('admin.singer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //执行歌手添加
        if($request->hasFile('pic')){
            //验证规则
            $this->validate($request, 
            [
                'name'          =>      'required',
                'sex'           =>      'required',
                'place'         =>      'required',
                'content'       =>      'required',
            ],[
                'name.required' =>      '歌手名必须填写',
                'sex.required'  =>      '歌手性别必须填写',
                'place.required'=>      '歌手地区必须填写',
                'count.required'=>      '歌手描述必须填写',
            ]
            );

            $data=$request->except('_token');
            //制作文件名
            $name=time()+rand(100000,999999);
            //获取上传文件的扩展名
            $kz=$request->file('pic')->getClientOriginalExtension();
            //拼接文件名
            $pic=$name.'.'.$kz;
            //定义存储图片的路径
            $path='./uploads/singer/'.date('Y-m-d').'/';
            //执行文件上传
            $request->file('pic')->move($path,$pic);
            //dump($path);
            $data['pic']= $path.$pic;
            $data['num']= mt_rand(1,999999999);
            $res=DB::table('singer')->insert($data);
            if($res){
                return back()->with('success',"添加成功");
            }else{
                return back()->with('error',"添加失败");
            }
        }else{
            return back()->with('error',"请上传图片");
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
        //歌手修改方法
       $data=DB::table('singer')->where('id',$id)->first();
       //dump($data);
       return view('admin.singer.edit',['data'=>$data]);
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
        
        if($request->hasFile('pic')){
            echo "有文件上传";
            //接收数据
            $data=$request->except(['_token','_method']);
            //dump($data);
            //查找图片名称
            $pic=DB::table('singer')->where('id',$id)->first();
            //删除旧文件名
            unlink("$pic->pic");
            //制作文件名
            $name=time()+rand(100000,999999);
            //获取上传文件的扩展名
            $kz=$request->file('pic')->getClientOriginalExtension();
            //拼接文件名
            $pic=$name.'.'.$kz;
            //定义存储图片的路径
            $path='./uploads/singer/'.date('Y-m-d').'/';
            //执行文件上传
            $request->file('pic')->move($path,$pic);
            //dump($path);
            $data['pic']= $path.$pic;
            //$data['pic']= $path.$pic;
            $res=DB::table('singer')->where('id',$id)->update($data);
            if($res){
                return redirect('/singer')->with('success',"修改成功");
            }else{
                return back()->with('error',"修改失败");
            }
        }else{
            //接收数据
            $data=$request->except(['_token','_method']);
            $res=DB::table('singer')->where('id',$id)->update($data);
            if($res){
                return redirect('/singer')->with('success',"修改成功");
            }else{
                return back()->with('error',"修改失败");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->all('id');
        $pic=DB::table('singer')->where('id',$id)->first();
        unlink("$pic->pic");
        $res=DB::table('singer')->where('id',$id)->delete();
        if($res){
            return ['message'=>"success",'status'=>200];
        }else{
            return ['message'=>"error",'status'=>404];
        }
    }
}
