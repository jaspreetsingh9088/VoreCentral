<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsarchive;
use App\Http\Requests\NewsarchiveRequest;
use App\Traits\ApiResponse;
use App\Http\Traits\CustomFileUpload;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class NewsarchiveAdminController extends Controller
{
    use CustomFileUpload,ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $newsarchive = Newsarchive::where('status',1)->orderBy('id', 'DESC')->get();
        return view('admin.newsarchive.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.newsarchive.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsarchiveRequest $request)
    {
        $data = $request->only(
            'title',
            'description',
        );
        if ($request->hasFile('image')) {
            $image = $this->uploadImageFile(
                $request->image,
                'newsarchive/'
            );
            $data['image'] = $image;
        }
        Newsarchive::create($data);


        // Removing News Item From The Cache
        Cache::forget('news');
        Cache::forget('forum_news');

        return $this->sendResponse('News create successfully.', 200);
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
        $newsarchive = Newsarchive::findOrFail($id);
        return view('admin.newsarchive.edit',compact('newsarchive'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsarchiveRequest $request, $id)
    {
        $newsarchive = Newsarchive::where('id',$id)->first();
        $data = $request->only(
            'title',
            'description',
        );
        if ($request->hasFile('image')) {
            $image = $this->uploadImageFile(
                $request->image,
                'newsarchive/'
            );
            $data['image'] = $image;

            $this->deleteFile(
                $newsarchive->image,
                'newsarchive/'
            );
        }
        Newsarchive::find($id)->update($data);


        // Removing News Item From The Cache
        Cache::forget('news');
        Cache::forget('forum_news');


        return $this->sendResponse('News updated successfully.', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newsarchive = Newsarchive::where('id',$id)->first();
        if($newsarchive->image != null){
            $this->deleteFile(
                $newsarchive->image,
                'newsarchive/'
            );
        }
        $newsarchive->delete();


        // Removing News Item From The Cache
        Cache::forget('news');
        Cache::forget('forum_news');

        Session::flash('success', 'News delete successfully.');
        return redirect(route('admin.newsarchive.index'));
    }
}
