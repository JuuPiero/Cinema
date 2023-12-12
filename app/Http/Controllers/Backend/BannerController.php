<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Banner\AddRequest;
use App\Http\Requests\Banner\EditRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Banner;
class BannerController extends Controller
{
    
    public function index()
    {
        $listData = Banner::paginate(1);
        return view('back-end.manage.ui-elements.banner', compact('listData'));
    }

    public function store(AddRequest $request, Banner $AddBanner)
    {
        $AddBanner->add($request);
        Alert::success('Success', 'Successfully Add New Banner.');
        return redirect()->back();
    }
   
    public function edit($id)
    {
        $finbyId = Banner::find($id);
        return view('back-end.manage.ui-elements.banner-edit', compact('finbyId'));
    }
    
    public function update(EditRequest $request, $id, Banner $EditBanner)
    {
        $EditBanner->edit($request, $id);
        Alert::success('Update!', 'Successfully Update Banner.');
        return redirect()->route('banner.index');
    }

    public function destroy($id, Banner $DeleteBanner)
    {
        $DeleteBanner->Remove($id);
        Alert::success('Delete!', 'Successfully Delete Banner.');
        return redirect()->route('banner.index');
    }
}
