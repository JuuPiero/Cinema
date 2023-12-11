<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Blog\AddRequest;
use App\Http\Requests\Blog\EditRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Blog;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(Request $request){
        $Flag = 2;
        $keywords = $request->keywords;
        $listData = Blog::where('title', 'like', "%$keywords%")->paginate(1);
        $Count = Blog::where('title', 'like', "%$keywords%")->count();
        return view('back-end.manage.blog.index', compact('listData', 'Flag', 'keywords', 'Count'));
    }

    public function index()
    {
        $Flag = 1;
        $listData = Blog::paginate(3);
        return view('back-end.manage.blog.index', compact('listData', 'Flag'));
    }
   

    public function create()
    {
        return view('back-end.manage.blog.add');
    }

   
    public function store(AddRequest $request, Blog $AddBlog)
    {
        $AddBlog->add($request);
        Alert::success('Success', 'Successfully Add New Blog.');
        return redirect()->route('blog.index');
    }

    
    
    public function edit($id)
    {
        $finbyId = Blog::find($id);
        return view('back-end.manage.blog.edit', compact('finbyId'));
    }

   
    public function update(EditRequest $request, $id, Blog $EditBlog)
    {
        $EditBlog->edit($request, $id);
        Alert::success('Update!', 'Successfully Update Blog.');
        return redirect()->route('blog.index');
    }

    
    public function destroy($id, Blog $DeleteBlog)
    {
        $DeleteBlog->Remove($id);
        Alert::success('Delete!', 'Successfully Delete Blog.');
        return redirect()->route('blog.index');
    }
}
