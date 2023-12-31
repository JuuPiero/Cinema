<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MovieRoom\AddRequest;
use App\Http\Requests\MovieRoom\EditRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\MovieRoom;

class MovieRoomController extends Controller
{
    public function Search(Request $request){
        $Flag = 2;
        $keywords = $request->keywords;
        $listData = MovieRoom::where('name', 'like', "%$keywords%")->paginate(1);
        $Count = MovieRoom::where('name', 'like', "%$keywords%")->count();
        return view('back-end.manage.movie-room.index', compact('listData', 'Flag', 'keywords', 'Count'));
    }

    public function index()
    {
        $Flag = 1;
        $listData = MovieRoom::paginate(2);
        return view('back-end.manage.movie-room.index', compact('listData', 'Flag'));
    }
  
   
    public function store(AddRequest $request, MovieRoom $AddRoom)
    {
        $AddRoom->add($request);
        Alert::success('Success', 'Successfully Add New Movie Room.');
        return redirect()->route('movie-room.index');
    }

    public function edit($id)
    {
        $finbyId = MovieRoom::find($id);
        return view('back-end.manage.movie-room.edit', compact('finbyId'));
    }
   
    public function update(EditRequest $request, $id, MovieRoom $EditRoom)
    {
        $EditRoom->edit($request, $id);
        Alert::success('Update!', 'Successfully Update Movie Room.');
        return redirect()->route('movie-room.index');
    }
    
    public function destroy($id, MovieRoom $DeleteRoom)
    {
        $DeleteRoom->remove($id);
        Alert::success('Delete!', 'Successfully Delete Movie Room.');
        return redirect()->back();
    }
}
