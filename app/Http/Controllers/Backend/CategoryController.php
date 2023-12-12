<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Category\AddRequest;
use App\Http\Requests\Category\EditRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Category;
class CategoryController extends Controller
{
    public function Search(Request $request){
        $Flag = 2;
        $keywords = $request->keywords;
        $listData = Category::where('name', 'like', "%$keywords%")->paginate(2);
        $Count = Category::where('name', 'like', "%$keywords%")->count();
        return view('back-end.manage.category.index', compact('listData', 'Flag', 'keywords', 'Count'));
    }
    
    public function index()
    {
        $Flag = 1;
        $listData = Category::paginate(2);
        
        return view('back-end.manage.category.index', compact('listData', 'Flag'));
    }

    public function store(AddRequest $request, Category $AddCate)
    {
        $AddCate->add($request);
        // Alert::success('Success', 'Successfully Add New Category Film.');
        return redirect()->back()->with('success', 'Successfully Add New Category.');
    }

    public function edit($id)
    {
        $finbyId = Category::find($id);
        return view('back-end.manage.category.edit', compact('finbyId'));
    }

    public function update(EditRequest $request, $id, Category $EditCate)
    {
        $EditCate->edit($request, $id);
        Alert::success('Update!', 'Successfully Update Category Film.');
        return redirect()->route('category.index');
    }
    
    public function destroy($id, Category $DeleteCate)
    {
        $DeleteCate->remove($id);
        Alert::success('Delete!', 'Successfully Delete Category Film.');
        return redirect()->back();
    }
}
