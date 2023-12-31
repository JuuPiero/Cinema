<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MovieChair\AddRequest;
use App\Http\Requests\MovieChair\EditRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\MovieChair;
class MovieChairController extends Controller
{
    public function Search(Request $request){
        $Flag = 2;
        $keywords = $request->keywords;
        $listData = MovieChair::where('name', 'like', "%$keywords%")->paginate(4);
        $Count = MovieChair::where('name', 'like', "%$keywords%")->count();
        return view('back-end.manage.movie-chair.index', compact('listData', 'Flag', 'keywords', 'Count'));
    }

    public function index()
    {
        $Flag = 1;
        $listData = MovieChair::paginate(4);
        return view('back-end.manage.movie-chair.index', compact('listData', 'Flag'));
    }

    public function store(AddRequest $request, MovieChair $AddChair)
    {
        $AddChair->add($request);
        Alert::success('Success', 'Successfully Add New Movie Chair.');
        return redirect()->back();
    }

    public function edit($id)
    {
        $finbyId = MovieChair::find($id);
        return view('back-end.manage.movie-chair.edit', compact('finbyId'));
    }

    public function update(EditRequest $request, $id, MovieChair $EditChair)
    {
        $EditChair->edit($request, $id);
        Alert::success('Update!', 'Successfully Update Movie Chair.');
        return redirect()->route('movie-chair.index');
    }
    
    public function destroy($id, MovieChair $DeleteChair)
    {
        $DeleteChair->Remove($id);
        Alert::success('Delete!', 'Successfully Delete Movie Chair.');
        return redirect()->route('movie-chair.index');
    }
}
