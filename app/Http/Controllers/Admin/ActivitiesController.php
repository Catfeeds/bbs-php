<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;


class ActivitiesController extends AdminController
{
	
	/*权限验证规则*/
	protected $validateRules = [
			'title' => 'required|max:128',
			'description' => 'sometimes|max:65535',
	];
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    	$word = $request->input("word",'');
    	$activities = Activity::where('title','like',"%$word%")->orderBy('updated_at','DESC')->paginate(Config::get('tipask.admin.page_size'));
    	return view('admin.activities.index')->with('activities',$activities)->with('word', $word);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.activities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->flash();
        $this->validate($request,$this->validateRules);
        $activities = Activity::create($request->all());
        if($request->hasFile('image')){
            $savePath = storage_path('app/activities/'.gmdate('ym'));
            $file = $request->file('image');
            $fileName = uniqid(str_random(8)).'.'.$file->getClientOriginalExtension();
            $target = $file->move($savePath,$fileName);
            if($target){
                $activities->image = 'activities-'.gmdate('ym').'-'.$fileName;
                $activities->save();
            }
        }

        return $this->success(route('admin.activities.index'),'活动添加成功');
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
        $activity = Activity::find($id);
        if (!$activity) {
        	return $this->error(route('admin.activities.index'), 'activity does not exist, please check');
        }
        return view('admin.activities.edit')->with('activity', $activity);
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
    	$activity = Activity::find($id);
    	if (!$activity) {
    		return $this->error(route('admin.activities.index'), 'activity does not exist, please check');
    	}
    	$this->validate($request, $this->validateRules);
    	$activity->title = $request->input('title');
    	$activity->description = $request->input('description');
        $activity->status = $request->input('status');
        // images
        if ($request->hasFile('image')){
        	$savePath = storage_path('app/activities/'.gmdate('ym'));
        	$file = $request->file('image');
        	$fileName = uniqid(str_random(8)).'.'.$file->getClientOriginalExtension();
        	$target = $file->move($savePath,$fileName);
        	if($target){
        		$activities->image = 'activities-'.gmdate('ym').'-'.$fileName;        		
        	}
        }
        $activity->save();
        return $this->success(route('admin.activities.index'), 'update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        Activity::destroy($request->input('ids'));
        return $this->success(route('admin.activities.index'), 'delete successfully');
    }
}
