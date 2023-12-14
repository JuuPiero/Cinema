@extends('master')
@section('main')
    <style>
        .proceed-form,
        .payment-card-form {
            display: none !important;
        }
        .open {
            display: block !important;
        }
        .payment-item {
            cursor: pointer;
        }
    </style>
    <div class="movie-facility padding-bottom padding-top">
        @if(session('message'))
            <h4 class="message alert ">
                {{ session('message') }}
            </h4>
        @endif
        <div class="container">
            <div class="row">
                @if (Auth::check())
                    <div class="col-lg-8">
                        <div class="checkout-widget checkout-card payment-container ">
                            <h5 class="title">Payment Option</h5>
                            <ul class="payment-option"></ul>
                            <form class="payment-card-form vnpay-form" method="POST" action="{{ route('checkout.vnpay') }}">
                                <h5 class="subtitle">Enter Your Card Details </h5>
                                @csrf
                                <input type="hidden" name="total-price"/>
                                <input type="hidden" name="payment-type" value="3"/>
                                <div class="form-group w-100">
                                    <label for="card2">Bank</label>
                                    <style>
                                        select {
                                            background-color: transparent;
                                        }
                                        select option {
                                            background-color: #11326f;
                                        }
                                    </style>
                                   
                                    <select name="bankcode" id="bankcode" required>
                                        <option value="">Không chọn </option>    
                                        <option value="MBAPP">Ung dung MobileBanking</option>			
                                        <option value="VNPAYQR">VNPAYQR</option>
                                        <option value="VNBANK">LOCAL BANK</option>
                                        <option value="IB">INTERNET BANKING</option>
                                        <option value="ATM">ATM CARD</option>
                                        <option value="INTCARD">INTERNATIONAL CARD</option>
                                        <option value="VISA">VISA</option>
                                        <option value="MASTERCARD"> MASTERCARD</option>
                                        <option value="JCB">JCB</option>
                                        <option value="UPI">UPI</option>
                                        <option value="VIB">VIB</option>
                                         <option value="VIETCAPITALBANK">VIETCAPITALBANK</option>
                                        <option value="SCB">Ngan hang SCB</option>
                                        <option value="NCB">Ngan hang NCB</option>
                                        <option value="SACOMBANK">Ngan hang SacomBank  </option>
                                        <option value="EXIMBANK">Ngan hang EximBank </option>
                                        <option value="MSBANK">Ngan hang MSBANK </option>
                                        <option value="NAMABANK">Ngan hang NamABank </option>
                                        <option value="VNMART"> Vi dien tu VnMart</option>
                                        <option value="VIETINBANK">Ngan hang Vietinbank  </option>
                                        <option value="VIETCOMBANK">Ngan hang VCB </option>
                                        <option value="HDBANK">Ngan hang HDBank</option>
                                        <option value="DONGABANK">Ngan hang Dong A</option>
                                        <option value="TPBANK">Ngân hàng TPBank </option>
                                        <option value="OJB">Ngân hàng OceanBank</option>
                                        <option value="BIDV">Ngân hàng BIDV </option>
                                        <option value="TECHCOMBANK">Ngân hàng Techcombank </option>
                                        <option value="VPBANK">Ngan hang VPBank </option>
                                        <option value="AGRIBANK">Ngan hang Agribank </option>
                                        <option value="MBBANK">Ngan hang MBBank </option>
                                        <option value="ACB">Ngan hang ACB </option>
                                        <option value="OCB">Ngan hang OCB </option>
                                        <option value="IVB">Ngan hang IVB </option>
                                        <option value="SHB">Ngan hang SHB </option>
                                        <option value="APPLEPAY">Apple Pay </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label >Language</label>
                                    <select name="language" required>
                                        <option value="en">English</option>
                                        <option value="vn">Tiếng Việt</option>
                                    </select>
                                </div>
                                <div class="form-group w-100">
                                    <label for="card2">Note</label>
                                    <input name="card-note" type="text" id="card2" >
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="custom-button" value="make payment">
                                </div>
                            </form>

                            <form class="payment-card-form momo-form" method="POST" action="{{ route('checkout.momo') }}">
                                <h5 class="subtitle">Enter Your Card Details </h5>
                                @csrf
                                <input type="hidden" name="total-price"/>
                                <input type="hidden" name="payment-type" value="2"/>
                                <div class="form-group">
                                    <label >Method</label>
                                    <select name="method" required>
                                        <option value="qr">QR</option>
                                        <option value="atm">ATM</option>
                                    </select>
                                </div>
                                <div class="form-group w-100">
                                    <label for="card2">Note</label>
                                    <input name="card-note" type="text" id="card2" >
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="custom-button" value="make payment">
                                </div>
                            </form>
                            <p class="notice">
                                By Clicking "Make Payment" you agree to the 
                                <a href="#0">terms and conditions</a>
                            </p>
                        </div>
                        <div class="checkout-widget checkout-contact">
                            <h5 class="title">Share your Contact Details </h5>
                            <form class="checkout-contact-form" action="{{ route('customer.contact-info') }}"
                                method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" placeholder="Enter your Address" name="address">
                                    @if ($errors->has('phone'))
                                        <small class="err col-md-12">{{ $errors->first('address') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Continue" class="custom-button">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Enter your Mail" name="email"
                                        value="{{ Auth::user()->email }}">
                                    @if ($errors->has('email'))
                                        <small class="err col-md-12">{{ $errors->first('email') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Enter your Phone Number " name="phone">
                                    @if ($errors->has('phone'))
                                        <small class="err col-md-12">{{ $errors->first('phone') }}</small>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="booking-summery bg-one">
                            <h4 class="title">booking summery</h4>
                            @foreach ($cart->content() as $item)
                                <ul>
                                    <li>
                                        <h6 class="subtitle">{{ $item['detail']->film->name }}</h6>
                                    </li>
                                    <li>
                                        <h6 class="subtitle"><span>{{ $item['detail']->cinema->name }}</h6>
                                        <div class="info">
                                            <span>{{ $item['detail']->date }},{{ $item['detail']->time->time }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <h6 class="subtitle">Seats: {{ implode(',', $item['seat']) }}</h6>
                                    </li>
                                    <li>
                                        <h6 class="info mb-0">
                                            <span>Tickets Price</span>
                                            <span>$ {{ number_format($item['price'], 2) }}</span>
                                        </h6>
                                    </li>
                                </ul>
                            @endforeach
                            @foreach ($cart->content_food() as $item)
                                <ul class="side-shape">
                                    <li>
                                        <h6 class="subtitle"><span>{{ $item['pro']->name }}</span></h6>
                                        <span class="info">
                                            <span>Quantity: {{ $item['qty'] }}</span>
                                            <span>$ {{ number_format($item['price'], 2) }}</span>
                                        </span>
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                        <div class="proceed-area text-center">
                            <h6 class="subtitle">
                                <span>Amount Payable</span>
                                <span>$ <span class="total-price">{{ number_format($cart->get_total_price()) }}</span></span>
                            </h6>
                            <form class="proceed-form" action="{{ route('post-checkout') }}" method="POST">
                                @csrf
                                <button class="proceed-btn custom-button back-button" type="submit" >proceed</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="col-lg-12">
                        <div class="checkout-widget d-flex flex-wrap align-items-center justify-cotent-between">
                            <div class="title-area">
                                <h5 class="title">You need to sign in!</h5>
                                <p>Sign in to earn points and make booking easier!</p>
                            </div>
                            <a href="{{ route('login', ['checkout']) }}" class="sign-in-area">
                                <i class="fas fa-user"></i><span>Sign in</span>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    const assetUrl = "{{ asset('images') }}"
    const checkoutVnpay = "{{ route('checkout.vnpay') }}"
    const checkoutMomo = "{{ route('checkout.momo') }}"
</script>
<script src="{{ asset('js/payment.js') }}"></script>    
@endsection
