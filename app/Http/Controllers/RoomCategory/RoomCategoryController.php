<?php

namespace App\Http\Controllers\RoomCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\RoomCategory;
use Illuminate\Http\Request;

class RoomCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        $model = str_slug('roomcategory','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $roomcategory = RoomCategory::where('room_type', 'LIKE', "%$keyword%")
                ->orWhere('slug', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $roomcategory = RoomCategory::orderBy('id','DESC')->paginate($perPage);
            }

            return view('roomcategory.room-category.index', compact('roomcategory'));
        }
        return response(view('403'), 403);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $ACTION = 'CREATES';
        $model = str_slug('roomcategory','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('roomcategory.room-category.create',compact('ACTION'));
        }
        return response(view('403'), 403);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
       
        $model = str_slug('roomcategory','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            RoomCategory::create($requestData);
            return redirect('roomcategory/room-category')->with('flash_message', 'RoomCategory added!');
        }
        return response(view('403'), 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $model = str_slug('roomcategory','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $roomcategory = RoomCategory::findOrFail($id);
            return view('roomcategory.room-category.show', compact('roomcategory'));
        }
        return response(view('403'), 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $model = str_slug('roomcategory','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $roomcategory = RoomCategory::findOrFail($id);
            return view('roomcategory.room-category.edit', compact('roomcategory'));
        }
        return response(view('403'), 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $model = str_slug('roomcategory','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $roomcategory = RoomCategory::findOrFail($id);
             $roomcategory->update($requestData);

             return redirect('roomcategory/room-category')->with('flash_message', 'RoomCategory updated!');
        }
        return response(view('403'), 403);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $model = str_slug('roomcategory','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            RoomCategory::destroy($id);

            return redirect('roomcategory/room-category')->with('flash_message', 'RoomCategory deleted!');
        }
        return response(view('403'), 403);

    }

    public function roomStatus(Request $request)
    {

        $room = RoomCategory::find($request->room_id);
        $room->status = $request->status;
        $room->save();
  
        return response()->json(['flash_message'=>'Status change successfully.']);
    }

    public function deleteRoom( $id = null)
    {

        if($id){
            RoomCategory::destroy($id);
            $success = true;
            $message = "Romm Type deleted successfully";
        }else{
            $success = true;
            $message = "Room Type not found";
        }
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
