<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\ChecklistResource;
use App\Models\Checklist;
use Validator;

class ChecklistController extends BaseController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checklists = Checklist::all();
    
        return $this->sendResponse(ChecklistResource::collection($checklists), 'Checklist retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $checklist = Checklist::create($input);
   
        return $this->sendResponse(new ChecklistResource($checklist), 'Checklist created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $checklist = Checklist::find($id);
  
        if (is_null($checklist)) {
            return $this->sendError('Checklist not found.');
        }
   
        return $this->sendResponse(new ChecklistResource($checklist), 'Checklist retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checklist $checklist)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'nullable',
            'description' => 'nullable'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        if (isset($input['name'])) {
            $checklist->name = $input['name'];
        }
    
        if (isset($input['description'])) {
            $checklist->description = $input['description'];
        }
    
        if (isset($input['is_done'])) {
            $checklist->is_done = $input['is_done'];
        }
    
        $checklist->save();
   
        return $this->sendResponse(new ChecklistResource($checklist), 'Checklist updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checklist $checklist)
    {
        $checklist->delete();
   
        return $this->sendResponse([], 'Checklist deleted successfully.');
    }
}
