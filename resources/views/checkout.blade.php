@extends('master')
@section('main')
    <div class="movie-facility padding-bottom padding-top">
        <div class="container">
            <div class="row">
                @if (Auth::check())
                    <div class="col-lg-8">
                    
                        {{-- <div class="checkout-widget checkout-contact">
                            <h5 class="title">Promo Code </h5>
                            <form class="checkout-contact-form">
                                <div class="form-group">
                                    <input type="text" placeholder="Please enter promo code">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Verify" class="custom-button">
                                </div>
                            </form>
                        </div> --}}
                        <div class="checkout-widget checkout-card payment-container">
                            <h5 class="title">Payment Option</h5>
                            <ul class="payment-option"></ul>
                            <h6 class="subtitle">Enter Your Card Details </h6>
                            <form class="payment-card-form" method="" action="">
                                <div class="form-group w-100">
                                    <label for="card1">Card Details</label>
                                    <input type="text" id="card1">
                                    <div class="right-icon">
                                        <i class="flaticon-lock"></i>
                                    </div>
                                </div>
                                <div class="form-group w-100">
                                    <label for="card2">Bank</label>
                                    <style>
                                        select option {
                                            background-color: #11326f;
                                        }
                                    </style>
                                    <select name="bank" id="cars" class="bank-option" style="background-color: transparent">
                                        <option value="ACB">ACB / Ngân hàng Á Châu / Asia Commercial Joint Stock Bank</option>
                                        <option value="TPBank">TPBank / Ngân hàng Tiên Phong / Tien Phong Bank</option>
                                        <option value="Đông Á Bank, DAB">Đông Á Bank, DAB / Ngân hàng Đông Á / DongA Bank</option>
                                        <option value="SeABank">SeABank / Ngân hàng Đông Nam Á / South East Asia Bank</option>
                                        <option value="ABBANK">ABBANK / Ngân hàng An Bình / An Binh Bank</option>
                                        <option value="BacABank">BacABank / Ngân hàng Bắc Á / Bac A Bank</option>
                                        <option value="VietCapitalBank">VietCapitalBank / Ngân hàng Bản Việt / Viet Capital Bank</option>
                                        <option value="MSB">MSB / Hàng Hải Việt Nam / Vietnam Maritime Joint - Stock Commercial Bank</option>
                                        <option value="Techcombank, TCB">Techcombank, TCB / Kỹ Thương Việt Nam / VietNam Technological and Commercial Joint Stock Bank</option>
                                        <option value="KienLongBank">KienLongBank / Kiên Long / Kien Long Commercial Joint Stock Bank</option>
                                        <option value="Nam A Bank">Nam A Bank / Nam Á / Nam A Bank</option>
                                        <option value="NCB">NCB / Quốc Dân / National Citizen Bank</option>
                                        <option value="VPBank">VPBank / Việt Nam Thịnh Vượng / Vietnam Prosperity Bank</option>
                                        <option value="HDBank">HDBank / Phát triển nhà Thành phố Hồ Chí Minh / Ho Chi Minh City Housing Development Bank</option>
                                        <option value="OCB">OCB / Phương Đông / Orient Commercial Joint Stock Bank</option>
                                        <option value="MB">MB / Quân đội / Military Commercial Joint Stock Bank</option>
                                        <option value="PVcombank">PVcombank / Đại chúng / Vietnam Public Joint Stock Commercial Bank</option>
                                        <option value="VIBBank, VIB">VIBBank, VIB / Quốc tế / Vietnam International and Commercial Joint Stock Bank</option>
                                        <option value="SCB">SCB / Sài Gòn / Sai Gon Commercial Bank</option>
                                        <option value="SGB">SGB / Sài Gòn Công Thương / Sai Gon Thuong Tin Bank</option>
                                        <option value="SHB">SHB / Sài Gòn-Hà Nội / Saigon - Hanoi Commercial Joint Stock Bank</option>
                                        <option value="STB">STB / Sài Gòn Thương Tín / Sai Gon Thuong Tin Commercial Joint Stock Bank</option>
                                        <option value="VAB">VAB / Việt Á / Viet A Bank</option>
                                        <option value="BVB">BVB / Bảo Việt / Bao Viet Bank</option>
                                        <option value="VietBank">VietBank / Việt Nam Thương Tín / Vietnam Thuong Tin Commercial Joint Stock Bank</option>
                                        <option value="PG Bank">PG Bank / Xăng dầu Petrolimex / Joint Stock Commercia Petrolimex Bank</option>
                                        <option value="EIB">EIB / Xuất Nhập khẩu Việt Nam / Vietnam Joint Stock Commercia lVietnam Export Import Bank</option>
                                        <option value="LPB">LPB / Bưu điện Liên Việt / Joint stock commercial Lien Viet postal bank</option>
                                        <option value="VCB">VCB / Ngoại thương Việt Nam / JSC Bank for Foreign Trade of Vietnam</option>
                                        <option value="CTG">CTG / Công Thương Việt Nam / Vietnam Joint Stock Commercial Bank for Industry and Trade</option>
                                        <option value="BIDV, BID">BIDV, BID / Đầu tư và Phát triển Việt Nam / JSC Bank for Investment and Development of Vietnam</option>
                                      </select>
                                </div>
                                <div class="form-group w-100">
                                    <label for="card2"> Name on the Card</label>
                                    <input type="text" id="card2">
                                </div>
                                <div class="form-group">
                                    <label for="card3">Expiration</label>
                                    <input type="text" id="card3" placeholder="MM/YY">
                                </div>
                                <div class="form-group">
                                    <label for="card4">CVV</label>
                                    <input type="text" id="card4" placeholder="CVV">
                                </div>
                                <div class="form-group check-group">
                                    <input id="card5" type="checkbox" checked>
                                    <label for="card5">
                                        <span class="title">QuickPay</span>
                                        <span class="info">
                                            Save this card information to my Boleto  account and make faster payments.
                                        </span>
                                    </label>
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
                                <span>$ <span class="total-price">{{ number_format($cart->get_total_price(), 2) }}</span></span>
                            </h6>
                            <form action="{{ route('post-checkout') }}" method="POST">
                                @csrf
                                <button class="proceed-btn" type="submit" >proceed</button>
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
<script>const assetUrl = "{{ asset('images') }}" </script>
<script src="{{ asset('js/payment.js') }}"></script>    
@endsection
