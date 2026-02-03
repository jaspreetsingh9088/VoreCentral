<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Traits\ApiResponse;
use App\Traits\CheckPermissionTrait;
use Illuminate\Http\Request;

class SubscriptionAdminController extends Controller
{
    use ApiResponse, CheckPermissionTrait;
    public function index()
    {
         return view('admin.subscription.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$this->checkRoutePermission('add'))  return redirect()->back()->with('unathorized');
        $request->validate([
            'title' => 'required|unique:contents|min:3|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
        ]);
        Subscription::create($request->all());
        return $this->sendResponse('Subscription created succesfully.', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatestatus($id,$status)
    {
            $Subscription = Subscription::find($id);
            $Subscription->status = ($status==1?0:1);
            $Subscription->save();
           return redirect()->back()->with('Status updated succesfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
       if (!$this->checkRoutePermission('update'))  return redirect()->back()->with('unathorized');
        $data['url'] = route('admin.subscription.update', $subscription);
        $data['html'] = (string) view('admin.subscription.edit', compact('subscription'));
        return $this->sendResponse('Subscription edit page load successfully.', 200, $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
       
       if (!$this->checkRoutePermission('update'))  return redirect()->back()->with('unathorized');
        $request->validate([
            'title' => 'required|min:3|max:255|unique:subscriptions,title,' . $subscription->id,
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
        ]);
        $subscription->update($request->all());
        return $this->sendResponse('Subscription updated succesfully.', 200);
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
