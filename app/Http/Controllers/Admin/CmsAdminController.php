<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Section;
use App\Traits\ApiResponse;
use App\Traits\CheckPermissionTrait;
use Illuminate\Http\Request;

class CmsAdminController extends Controller
{
    use ApiResponse, CheckPermissionTrait;
    public function index()
    {
        $userData = Content::get()->toArray();
        if(isset($userData) && is_array($userData) && count($userData) > 0)
        {
            foreach($userData as $userDataK => $userDataV){
             $userData[$userDataK]['sections'] = Section::select('name')->where('cid',$userDataV['id'])->get()->toArray();        
            }
        }
        return view('admin.cms.index',compact('userData'));
    }
    
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.cms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
 
        if (!$this->checkRoutePermission('add'))  return redirect()->back()->with('unathorized');
        $request->validate([
            'alias' => 'required|unique:contents',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_tag' => 'required',
        ]);
        Content::create($request->all());
        return $this->sendResponse('Content created succesfully.', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $userData = Content::where('id',$id)->first();
      $sectionData = Section::where('cid',$id)->get();
        return view('admin.cms.show',compact('userData','sectionData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        die('test');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {  
       
       if (!$this->checkRoutePermission('update'))  return redirect()->back()->with('unathorized');
        $request->validate([
            'meta_title' => 'required',
            'title' => 'required',
            'meta_description' => 'required',
            'meta_tag' => 'required',
        ]);
        
            $Content = Content::find($id);
            $Content->meta_title= $request->meta_title;
            $Content->title      = $request->title;
            $Content->meta_description = $request->meta_description;
            $Content->meta_tag = $request->meta_tag;
            $Content->save();
            return $this->sendResponse('Content updated succesfully.', 200);
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
