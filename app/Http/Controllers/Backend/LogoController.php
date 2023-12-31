<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Logo\AddRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Logo;

class LogoController extends Controller
{
    public function index()
    {
        $listData = Logo::orderBy('status', 'ASC')
                        ->paginate(3);
        return view('back-end.manage.ui-elements.logo', compact('listData'));
    }

   
    public function store(AddRequest $request, Logo $AddLogo)
    {
        $AddLogo->add($request);
        Alert::success('Success', 'Successfully Add New Logo.');
        return redirect()->back();
    }

    public function edit($id)
    {
        $finbyId = Logo::find($id);
        return view('back-end.manage.ui-elements.logo-edit', compact('finbyId'));
    }

    public function update(Request $request, $id, Logo $EditLogo)
    {
        $EditLogo->edit($request, $id);
        Alert::success('Update!', 'Successfully Update Logo.');
        return redirect()->route('logo.index');
    }

    public function destroy($id, Logo $DeleteLogo)
    {
        $DeleteLogo->Remove($id);
        Alert::success('Delete!', 'Successfully Delete Logo.');
        return redirect()->route('logo.index');
    }
}
