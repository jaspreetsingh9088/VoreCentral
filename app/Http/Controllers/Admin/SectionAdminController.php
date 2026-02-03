<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Traits\ApiResponse;
use App\Traits\CheckPermissionTrait;
use Illuminate\Http\Request;

class SectionAdminController extends Controller
{
    use ApiResponse, CheckPermissionTrait;
    public function index()
    {
        return view('admin.cms.index');
    }
    
    public function addsection($id)
    {
        return view('admin.section.create',compact('id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.section.create');
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
            'name' => 'required',
            'text' => 'required',
            'cid' => 'required',
        ]);
        Section::create($request->all());
        return $this->sendResponse('Section created succesfully.', 200);
    }
    
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
         $sectionData = Section::where('id',$id)->first();
         return view('admin.section.show',compact('sectionData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       return view('admin.section.create',compact('id'));
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
       
       dd($request);
       if (!$this->checkRoutePermission('update'))  return redirect()->back()->with('unathorized');
        $request->validate([
            'name' => 'required',
            'text' => 'required',
        ]);
        
            $section = Section::find($id);
            $section->name  = $request->name;
            $section->stext  = $request->text;
            $section->save();
            return $this->sendResponse('Section updated succesfully.', 200);
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
