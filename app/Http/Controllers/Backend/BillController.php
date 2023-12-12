<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\BookTicket;
use App\Models\Food;
use App\Models\User;
use App\Models\Film;
use App\Models\Time;
use App\Models\MovieRoom;
use App\Models\MovieChair;
use App\Models\TimeDetail;
use App\Models\Cinema;
use App\Models\ContactInfo;
use App\Models\BookTicketDetail;

class BillController extends Controller
{
    public function index() {
        $bookingDates = [];
        $bookTickets = BookTicket::join('users', 'users.id', '=', 'book_tickets.user_id')
                                ->select('book_tickets.*', 'users.name')
                                ->get();
        foreach($bookTickets as $value){
            $dts = $value->created_at->addHours(7)->toDayDateTimeString();
            array_push($bookingDates, $dts);
        }        
        return view('back-end.manage.bill.index')->with([
            'bookTickets' => $bookTickets,
            'bookingDates' => $bookingDates
        ]);
    }

    public function bill_Detail($id) {
        $contact = ContactInfo::first();
        $bookTicket = BookTicket::find($id); // $bookTicket-status : 1 => pending ; 2 => complete
        $bookTicketDetails = BookTicketDetail::where('book_ticket_id', $id)->get();
        $user = User::where('id', $bookTicket->user_id)->first();
        $flag = 0;
        $chairs = MovieChair::all();
        $foods = Food::all();
        $timeDetail = TimeDetail::all();
        return view('back-end.manage.bill.detail')->with([
            'contact' => $contact,
            'bookTicket' => $bookTicket,
            // 'user' => $user,
            'userEmail' => $user->email,
            'userName' => $user->name,
            'bookTicketDetails' => $bookTicketDetails,
            'chairs' => $chairs,
            'timeDetail' => $timeDetail,
            'flag' => $flag,
            'foods' => $foods,
        ]);
    }

    public function post_Edit(Request $request, $id){
        $finbyId = BookTicket::find($id);
        $finbyId->update([
            'status'=>$request->status,
        ]);
        Alert::success('Update!', 'Successfully Update Status Bill.');
        return redirect()->back();
    }

    public function delete($id){
        $finbyId = BookTicket::find($id);
        $finbyId->delete();
        Alert::success('Delete!', 'Successfully Delete Bill.');
        return redirect()->back();
    }
}
