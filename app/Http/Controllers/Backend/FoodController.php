<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Food\AddRequest;
use App\Http\Requests\Food\EditRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Food;
use App\Models\BookTicketDetail;

class FoodController extends Controller
{
    public function Search(Request $request){
        $Flag = 2;
        $keywords = $request->keywords;
        $listData = Food::where('name', 'like', "%$keywords%")->paginate(1);
        $Count = Food::where('name', 'like', "%$keywords%")->count();
        return view('back-end.manage.food.index', compact('listData', 'Flag', 'keywords', 'Count'));
    }

    public function index()
    {
        $Flag = 1;
        $listData = Food::orderBy('created_at', 'DESC')
                        ->paginate(4);
        return view('back-end.manage.food.index', compact('listData', 'Flag'));
    }

    public function create()
    {
        $listData = Food::orderBy('created_at', 'DESC')
                        ->paginate(2);
        return view('back-end.manage.food.add', compact('listData'));
    }

    public function store(AddRequest $request, Food $AddFood)
    {
        $AddFood->add($request);
        Alert::success('Success', 'Successfully Add New Food.');
        return redirect()->route('food.index');
    }

   
    public function edit($id)
    {
        $finbyId = Food::find($id);
        return view('back-end.manage.food.edit', compact('finbyId'));
    }

    public function update(EditRequest $request, $id, Food $EditFood)
    {
        $EditFood->edit($request, $id);
        Alert::success('Update!', 'Successfully Update Food.');
        return redirect()->route('food.index');
    }

    public function destroy($id,  Food $DeleteFood)
    {
        $checkFood = BookTicketDetail::where('food_id', $id)->count();
        if($checkFood == 0 ){
            $DeleteFood->Remove($id);
            Alert::success('Delete!', 'Successfully Delete Food.');
        }else{
            Alert::error('Delete!', 'This Product Was Ordered!');
        }
        return redirect()->route('food.index');
    }
}
