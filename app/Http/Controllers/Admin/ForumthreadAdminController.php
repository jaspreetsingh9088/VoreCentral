<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ForumthreadRequest;
use App\Traits\ApiResponse;
use App\Http\Traits\CustomFileUpload;
use Illuminate\Support\Facades\Session;
use App\Models\Forumcategory;
use App\Models\Thread;
use App\Models\Threadcomment;
use Illuminate\Support\Facades\Auth;

class ForumthreadAdminController extends Controller
{
    use CustomFileUpload,ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $forumcategorie = Forumcategory::where('status',1)->get();
        return view('admin.forumthread.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $forumcat = Forumcategory::where('status',1)->get();
        return view('admin.forumthread.create',compact('forumcat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ForumthreadRequest $request)
    {
        $Thread = new Thread ;
        if($request->file('media')){
            $file= $request->file('media');
            $filename= time().".".$file->getClientOriginalExtension();
            $file-> move(public_path('thread'), $filename);
            $Thread->media = $filename ;
        }
        $Thread->topic    = $request->topic;
        $Thread->comment  = $request->comment;
        $Thread->userid   = Auth::user()->id;
        $Thread->cid      = $request->cid;
        $Thread->save();

        $Threadcomment = new Threadcomment;
        $Threadcomment->comment  = $request->comment;
        $Threadcomment->userid   = Auth::user()->id;
        $Threadcomment->threadid = $Thread->id;
        $Threadcomment->save();
        $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];

        return $this->sendResponse('Content created successfully', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $forumthread = Thread::where('cid',$id)->paginate(config('constants.pg_default', 10));
        return view('admin.forumthread.show',compact('forumthread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $forumcat = Forumcategory::where('status',1)->get();
        $thread = Thread::findOrFail($id);
        // dd($thread);
        return view('admin.forumthread.edit',compact('thread','forumcat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ForumthreadRequest $request, $id,$status)
    {
        if($status == 'all'){
            $Thread = Thread::where('id',$id)->first();
            if($request->file('media')){
                $file= $request->file('media');
                $filename= time().".".$file->getClientOriginalExtension();
                $file-> move(public_path('thread'), $filename);

                $this->deleteFile(
                    $Thread->media,
                    'thread/'
                );
                $Thread->media = $filename ;
            }
            $Thread->topic    = $request->topic;
            $Thread->comment  = $request->comment;
            $Thread->userid   = Auth::user()->id;
            $Thread->cid      = $request->cid;
            $Thread->save();
            return redirect()->back()->with('Thread update succesfully');
        }else if($status == 1){
            $thread = Thread::where('id',$id)->first();
            $thread->thread_lock = 1;
            $thread->save();
            return redirect()->back()->with('Thread lock succesfully');
        }else if($status == 0){
            $thread = Thread::where('id',$id)->first();
            $thread->thread_lock = 0;
            $thread->save();
            return redirect()->back()->with('Thread unlock succesfully');
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
        $thread = Thread::where('id',$id)->first();
        if($thread->media != null){
            $this->deleteFile(
                $thread->media,
                'thread/'
            );
        }
        $thread->delete();
        Session::flash('success', 'Thread delete successfully.');
        return redirect(route('admin.forumthread.index'));
    }
}
