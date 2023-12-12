<style>
.dataTables_length label {
    font-weight: normal;
    text-align: left;
    white-space: nowrap;
    font-family: monospace;
}

.dataTables_filter {
    display: flex;
    justify-content: flex-end;
}

.dataTables_info {
    font-family: monospace;
    padding-top: 10px;
}

.pagination {
    padding: 10px;
    justify-content: flex-end;
}

.dataTables_empty {
    text-align: center;
}
</style>
@extends('back-end.master')
@section('Main_Admin')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row overflow-auto">
                            <div class="col-12">
                                <div id="order-listing_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="order-listing" class="table dataTable no-footer" cellspacing="0"
                                                width="100%" role="grid" aria-describedby="order-listing_info"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr role="row" class="text-center">
                                                        <th class="sorting_desc" tabindex="0"
                                                            aria-controls="order-listing" rowspan="1" colspan="1"
                                                            aria-label="Order #: activate to sort column ascending"
                                                            style="width: 71px;" aria-sort="descending">#</th>
                                                        <th class="sorting" tabindex="0" aria-controls="order-listing"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Customer: activate to sort column ascending"
                                                            style="width: 85px;">Name</th>
                                                        <th class="sorting" tabindex="0" aria-controls="order-listing"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Ship to: activate to sort column ascending"
                                                            style="width: 78px;">Amount</th>
                                                        <th class="sorting" tabindex="0" aria-controls="order-listing"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Base Price: activate to sort column ascending"
                                                            style="width: 90px;">Price</th>
                                                        <th class="sorting" tabindex="0" aria-controls="order-listing"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Purchased Price: activate to sort column ascending"
                                                            style="width: 134px;">Payment</th>
                                                        <th class="sorting" tabindex="0" aria-controls="order-listing"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Purchased Price: activate to sort column ascending"
                                                            style="width: 134px;">Booking Date</th>
                                                        <th class="sorting" tabindex="0" aria-controls="order-listing"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Status: activate to sort column ascending"
                                                            style="width: 72px;">Status</th>
                                                        <th class="sorting" tabindex="0" aria-controls="order-listing"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Actions: activate to sort column ascending"
                                                            style="width: 220px;">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($bookTickets as $index => $bookTicket)
                                                    <tr role="row" class="text-center">
                                                        <td class="sorting_1">{{ $bookTicket->id }}</td>
                                                        <td>{{ $bookTicket->name }}</td>
                                                        <td>
                                                            {{ $bookTicket->amount }}
                                                            <br> <pre>( Tickets + Food )</pre>
                                                        </td>
                                                        <td>$ {{ number_format($bookTicket->price) }}</td>
                                                        <td class="payment-type">{{ $bookTicket->payment }}</td>
                                                        <td>{{ $bookingDates[$index] }}</td>
                                                        <td class="">
                                                            <label class="badge {{ $bookTicket->status == 1 ? 'badge-danger' : 'badge-success' }}">
                                                                {{($bookTicket->status == 1)? 'Pending' : 'Complete'}}
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('billDetail', $bookTicket->id)}}" class="btn btn-gradient-dark btn-sm w-75"> 
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </td>
                                                        </tr>
                                                        @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script src="{{url('assets-admin')}}/js/jquery.dataTables.js"></script>
<script src="{{url('assets-admin')}}/js/dataTables.bootstrap4.js"></script>
<script src="{{url('assets-admin')}}/js/settings.js"></script>
<script src="{{url('assets-admin')}}/js/todolist.js"></script>
<script src="{{url('assets-admin')}}/js/jquery.cookie.js"></script>
<script src="{{url('assets-admin')}}/js/data-table.js"></script>
<script>
    const paymentTypes = document.querySelectorAll('.payment-type')

    paymentTypes.forEach(item => {
        if(item.innerHTML == 1) {
            item.innerHTML = 'cash payment'
        }
        else if(item.innerHTML == 2) {
            item.innerHTML = 'momo'
        }
        else {
            item.innerHTML = 'vnpay'
        }
    })

</script>
@stop