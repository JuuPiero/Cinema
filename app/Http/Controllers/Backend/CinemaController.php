<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Cinema\AddRequest;
use App\Http\Requests\Cinema\EditRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Cinema;

class CinemaController extends Controller
{
    public function Search(Request $request){
        $Flag = 2;
        $keywords = $request->keywords;
        $listData = Cinema::where('name', 'like', "%$keywords%")->paginate(4);
        $Count = Cinema::where('name', 'like', "%$keywords%")->count();
        return view('back-end.manage.cinema.index', compact('listData', 'Flag', 'keywords', 'Count'));
    }

    public function index()
    {
        $Flag = 1;
        $listData = Cinema::paginate(4);
        return view('back-end.manage.cinema.index', compact('listData', 'Flag'));
    }

    public function create()
    {
        return view('back-end.manage.cinema.add');
    }

    public function store(AddRequest $request, Cinema $AddCinema)
    {
        $AddCinema->add($request);
        Alert::success('Success', 'Successfully Add New Cinema.');
        return redirect()->route('cinema.index');
    }

    public function edit($id)
    {
        $finbyId = Cinema::find($id);
        return view('back-end.manage.cinema.edit', compact('finbyId'));
    }

    public function update(EditRequest $request, $id, Cinema $EditCinema)
    {
        $EditCinema->edit($request, $id);
        Alert::success('Update!', 'Successfully Update Cinema.');
        return redirect()->route('cinema.index');
    }

    public function destroy($id, Cinema $DeleteCinema)
    {
        $DeleteCinema->remove($id);
        Alert::success('Delete!', 'Successfully Delete Cinema.');
        return redirect()->back();
    }
}
