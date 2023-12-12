<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ContactInfo\AddRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ContactInfo;
use App\Models\User;

class ContactInfoController extends Controller
{
    public function index()
    {
        $listData = ContactInfo::all();
        $user = User::all();
        $check = ContactInfo::where('user_id', 1)->first();
        return view('back-end.manage.ui-elements.contact-info', compact('listData', 'user', 'check'));
    }

    public function store(AddRequest $request, ContactInfo $AddInfo)
    {
        $AddInfo->add($request);
        Alert::success('Success', 'Successfully Add New Contact Infor.');
        return redirect()->route('contact-info.index');
    }

    public function edit($id)
    {
        $finbyId = ContactInfo::find($id);
        return view('back-end.manage.ui-elements.contact-edit', compact('finbyId'));
    }

    public function update(AddRequest $request, $id, ContactInfo $EditInfo)
    {
        $EditInfo->edit($request, $id);
        Alert::success('Update!', 'Successfully Update Contact Infor.');
        return redirect()->route('contact-info.index');
    }
}
