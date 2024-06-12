<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Http\Requests\StoreChecklistRequest;
use App\Http\Requests\UpdateChecklistRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ChecklistController extends Controller
{
    /**
     * Instantiate a new ChecklistController instance.
     */
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:create-checklist|edit-checklist|delete-checklist', ['only' => ['index','show']]);
       $this->middleware('permission:create-checklist', ['only' => ['create','store']]);
       $this->middleware('permission:edit-checklist', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-checklist', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
    $user = Auth::user();
     //$query = Checklist::query();
    //$user = User::find($id);
    $query = Checklist::where("user_id", "=", $user->id);
    
     $checklists = $query->paginate(5);
      
        return view('checklists.index', [
            'checklists' => $checklists
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('checklists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChecklistRequest $request): RedirectResponse
    {
    $user = Auth::user();
     $input = $request->all();
     $input['user_id'] = $user->id;
     $check_count = Checklist::where("user_id", "=", $user->id)->count();
    $max_check = $user->max_check;
     
     if ($check_count < $max_check){
       Checklist::create($input);
        return redirect()->route('checklists.index')
                ->withSuccess('New checklist is added successfully.');
     }else{
        return redirect()->route('checklists.index')
                ->withSuccess('New checklist is not added limit.');
     }
      

    }

    /**
     * Display the specified resource.
     */
    public function show(Checklist $checklist): View
    {
        return view('checklists.show', [
            'checklist' => $checklist
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Checklist $checklist): View
    {
        return view('checklists.edit', [
            'checklist' => $checklist
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChecklistRequest $request, Checklist $checklist): RedirectResponse
    {
        $input = $request->all();
             $input['is_done'] = $request->has('is_done') ? 1 : 0;
            
        $checklist->update($input);
        return redirect()->back()
                ->withSuccess('Checklist is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checklist $checklist): RedirectResponse
    {
        $checklist->delete();
        return redirect()->route('checklists.index')
                ->withSuccess('Checklist is deleted successfully.');
    }
}
