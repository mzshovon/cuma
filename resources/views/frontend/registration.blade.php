@extends('frontend.partials.app')
@section('content')

<div class="main">

    <div class="container">
        <div class="signup-content">
            <div class="signup-img">
                <img src="{{asset('/frontend/images/CUMA-Logo.png')}}" alt="">
            </div>
            <div class="signup-form">
                <form method="POST" class="register-form" id="register-form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <div class="form-input">
                                <label for="first_name" class="required">First name</label>
                                <input type="text" name="first_name" id="first_name" />
                            </div>
                            <div class="form-input">
                                <label for="last_name" class="required">Last name</label>
                                <input type="text" name="last_name" id="last_name" />
                            </div>
                            <div class="form-input">
                                <label for="email" class="required">Email</label>
                                <input type="text" name="email" id="email" />
                            </div>
                            <div class="form-input">
                                <label for="phone_number" class="required">Phone number</label>
                                <input type="text" name="phone_number" id="phone_number" />
                            </div>
                            <div class="form-input">
                                <label for="company" class="required">NID Number</label>
                                <input type="text" name="nid" id="nid" />
                            </div>
                            <div class="form-input">
                                <label for="company" class="required">Date Of Birth</label>
                                <input type="date" name="dob" id="dob" />
                            </div>
                            <div class="form-input">
                                <label for="company" class="required">Contact Address</label>
                                <input type="text" name="address" id="address" />
                            </div>
                            <div class="form-input">
                                <label for="company" class="required">Blood Group</label>
                                <input type="text" name="blood_group" id="blood_group" />
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="form-select">
                                <div class="label-flex">
                                    <label for="batch">Batch No</label>
                                    <a href="#" class="form-link">Batch detail</a>
                                </div>
                                <div class="select-list">
                                    <select name="batch" id="batch">
                                        @for ($i=0; $i<=9 ; $i++)
                                         <option value="2020">202{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                                <div class="form-input">
                                    <label for="chequeno">Employer's / Business Name</label>
                                    <input type="text" name="employee_name" id="employee_name" />
                                </div>
                                <div class="form-input">
                                    <label for="chequeno">Designation</label>
                                    <input type="text" name="designation" id="designation" />
                                </div>
                                <div class="form-input">
                                    <label for="chequeno">Employer's / Business Address</label>
                                    <input type="text" name="employer_address" id="employer_address" />
                                </div>
                                <div class="form-input">
                                    <label for="chequeno">Reference Name</label>
                                    <input type="text" name="reference" id="reference" />
                                </div>
                                <div class="form-input">
                                    <label for="chequeno">Reference Number</label>
                                    <input type="text" name="reference_number" id="reference_number" />
                                </div>
                                <div class="form-input">
                                    <label for="password" class="required">Password</label>
                                    <input type="password" name="password" id="password" />
                                    <small style="color: red">Password must be at least 8 characters</small>
                                </div>
                                <div class="form-input">
                                    <label for="confirm_password" class="required">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password" />
                                </div>
                            </div>
                            <div class="form-radio">
                                <div class="label-flex">
                                    <label for="payment" class="required">Payment Mode</label>
                                </div>
                                <div class="form-radio-group">
                                    <div class="form-radio-item">
                                        <input type="radio" name="payment" id="life_member" >
                                        <label for="life_member">Life Member</label>
                                        <span class="check"></span>
                                    </div>
                                    </div>
                                <div class="form-radio-group">
                                    <div class="form-radio-item">
                                        <input type="radio" name="payment" id="general_member" >
                                        <label for="general_member">General Member</label>
                                        <span class="check"></span>
                                    </div>
                                    </div>
                                <div class="form-radio-group">
                                    <div class="form-radio-item">
                                        <input type="radio" name="payment" id="donor_member" >
                                        <label for="donor_member">Donor Member</label>
                                        <span class="check"></span>
                                    </div>
                                    </div>
                                    <div class="form-radio-group">
                                    <div class="form-radio-item">
                                        <input type="radio" name="payment" id="honorary_member">
                                        <label for="honorary_member">Honorary Member</label>
                                        <span class="check"></span>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-submit">
                        <input type="submit" value="Submit" class="submit" id="submit" name="submit" />
                        {{-- <input type="button" value="Reset" class="submit" id="reset" name="reset" /> --}}
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>

</div>


@endsection
