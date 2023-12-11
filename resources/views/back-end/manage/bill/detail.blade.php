@extends('back-end.master')
@section('Main_Admin')
@include('sweetalert::alert')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card px-2">
                    <div class="card-body">
                        <div class="container-fluid status-container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-right btn-handle my-5 book-status">
                                        @if ($bookTicket->status != 2)
                                            <form action="{{ route('post_Edit', $bookTicket->id) }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <select class="form-control form-control-sm" name="status">
                                                                <option value="1">Pending</option>
                                                                <option value="2">Complete</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="com-md-4">
                                                        <button type="submit" class="btn btn-gradient-primary btn-md">
                                                            <i class="mdi mdi-cart-arrow-down menu-icon"></i>
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        @else
                                            <div class="com-md-4 text-left">
                                                <button class="btn btn-gradient-success btn-md">Complete</button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="text-right my-5">Invoice #CNM-0{{ $bookTicket->id }}</h3>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid d-flex justify-content-between contact-container">
                            <div class="col-lg-4 pl-0 text-center admin-contact">
                                <p class="mt-5 mb-2 "><b>Purple Admin</b></p>
                                @if ($contact)
                                    <p>{{ $contact->email }},<br>{{ $contact->phone }},<br>{{ $contact->address }}.</p>
                                @endif
                            </div>

                            <div class="col-lg-4 pr-0 customer-contact">
                                <p class="mt-5 mb-2 text-center"><b>Invoice to</b></p>
                                <p class="text-center">{{ $userName }}<br>
                                    {{ $userEmail }} 
                                    <br>Payment : Banking
                                </p>
                            </div>
                        </div>

                        <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                            <div class="table-responsive w-100">
                                <table class="table">
                                    <thead>
                                        <tr class="bg-dark text-white text-center">
                                            <th>#</th>
                                            <th>Film</th>
                                            <th>Time</th>
                                            <th>Date</th>
                                            <th>Seat</th>
                                            <th>Room</th>
                                            <th>Cinema</th>
                                            <th>Unit cost</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookTicketDetails as $key => $item)
                                            @if ($item->time_id)
                                                @foreach (json_decode($item->chair) as $index => $chair)
                                                    <tr class="text-center">
                                                        <td >{{ $index + 1 }}</td>
                                                        <td>
                                                            {{ $timeDetail->where('id', $item->time_id)->first()->film->name }}
                                                        </td>
                                                        <td>{{ $timeDetail->where('id', $item->time_id)->first()->time->time }}
                                                        </td>
                                                        <td>{{ $timeDetail->where('id', $item->time_id)->first()->date }}
                                                        </td>
                                                        <td class="text-uppercase text-center">
                                                            <pre class="m-0">{{ $chair }}</pre>
                                                        </td>
                                                        <td>
                                                            {{ $timeDetail->where('id', $item->time_id)->first()->room->name }}
                                                        </td>
                                                        <td>
                                                            {{ $timeDetail->where('id', $item->time_id)->first()->cinema->name }}
                                                        </td>
                                                        <td>
                                                            @if (str_contains('abcd', substr($chair, 0,1)))
                                                            $ {{ number_format($chairs->where('id', 2)->first()->price, 2) }}
                                                            @elseif(str_contains('efgh', substr($chair, 0,1)))
                                                            $ {{ number_format($chairs->where('id', 1)->first()->price, 2) }}
                                                            @else
                                                            $ {{ number_format($chairs->where('id', 3)->first()->price, 2) }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="5" class="text-center"><h4>Amount</h4></td>
                                                    <td colspan="5" class="text-center">
                                                        <h4>$ {{ number_format($bookTicketDetails[$key]['price']) }}</h4>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                <a href="{{ route('create-PDF', request()->id) }}" class="btn btn-gradient-info btn-icon-text text-right">
                                    PDF
                                    <i class="mdi mdi-printer btn-icon-append"></i>
                                </a>
                            </div>
                        </div>

                        <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                            <div class="table-responsive w-100">
                                <table class="table">
                                    <thead>
                                        <tr class="bg-dark text-white text-center">
                                            <th>#</th>
                                            <th>Food</th>
                                            <th>Quantity</th>
                                            <th>Unit cost</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookTicketDetails as $index => $value)
                                            @if ($value->food_id)
                                                <h1 class="d-none">{{ $flag += 1 }}</h1>
                                                <tr class="text-center">
                                                    <td>{{ $index }}</td>
                                                    <td>
                                                        {{ $foods->where('id', $value->food_id)->first()->name }}
                                                    </td>
                                                    <td>{{ $value->quantity }}</td>
                                                    <td>$
                                                        {{ number_format($foods->where('id', $value->food_id)->first()->price) }}
                                                    </td>
                                                    <td>$ {{ number_format($value->price) }}</td>
                                                </tr>
                                            @endif
                                        @endforeach

                                        @if ($flag == 0)
                                            <tr class="odd">
                                                <td valign="top" colspan="8" class="dataTables_empty text-center ">
                                                    You have not ordered food yet 
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- <div class="container-fluid mt-5 w-100">
                            <p class="text-right mb-2">Sub - Total amount: ${{ number_format($bookTicket->price) }}</p>
                            <h4 class="text-right mb-5">Total : ${{ number_format($bookTicket->price) }}
                            </h4>
                            <hr>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop