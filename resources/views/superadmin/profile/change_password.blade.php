@extends('superadmin.navigation')
   
@section('content')

@php
    $users = DB::table('users')->first();
    
@endphp
    <!-- Start User Profile area -->
    <div class="user-profile-area d-flex flex-wrap">
        <!-- Left side -->
        <div class="user-info d-flex flex-column">
            <div
            class="user-info-basic d-flex flex-column justify-content-center"
            >
            <div class="user-graphic-element-1">
                <img src="{{ asset('public/backend/assets/images/sprial_1.png') }}" alt="" />
            </div>
            <div class="user-graphic-element-2">
                <img src="{{ asset('public/backend/assets/images/polygon_1.png') }}" alt="" />
            </div>
            <div class="user-graphic-element-3">
                <img src="{{ asset('public/backend/assets/images/circle_1.png') }}" alt="" />
            </div>
            <div class="userImg">
                @if(empty($users->image))
                    <img src="{{asset('public/backend/assets/images/avatar.jpg')}}" width="100%" height="150px" />
                @else
                    <img src="{{asset('public/assets/upload/user_image/'. $users->image)}}" width="100%" height="150px"/>
                @endif
                
            </div>
            <div class="userContent text-center">
                <h4 class="title">{{ auth()->user()->name }}</h4>
                <p class="info">Admin</p>
                <p class="user-status-verify">Verified</p>
            </div>
            </div>
            <div class="user-info-edit">
            <div
                class="user-edit-title d-flex justify-content-between align-items-center"
            >
                <h3 class="title">Details info</h3>
            </div>
            <div class="user-info-edit-items">
                <div class="item">
                <p class="title">Email</p>
                <p class="info">{{ auth()->user()->email }}</p>
                </div>
                <div class="item">
                <p class="title">Phone Number</p>
                <p class="info">{{ auth()->user()->phone_number }}</p>
                </div>
                <div class="item">
                <p class="title">Address</p>
                <p class="info">
                {{ auth()->user()->address}}
                </p>
                </div>
            </div>
            </div>
        </div>
        <!-- Right side -->
        <div class="user-details-info">
            
            <!-- Tab content -->
            <div class="tab-content eNav-Tabs-content" id="myTabContent">
            <div
                class="tab-pane fade show active"
                id="basicInfo"
                role="tabpanel"
                aria-labelledby="basicInfo-tab"
            >
                <div class="eForm-layouts">
                <form action="{{route('superadmin.profile.change_password', 'update')}}" method="post">
                    @CSRF

                    <div class="fpb-7">
                    <label for="new_password" class="eForm-label">New Password</label>
                    <input
                        type="password"
                        class="form-control eForm-control"
                        id="new_password"
                        name="new_password"
                        placeholder="Your current password"
                    />
                    </div>

                    <div class="fpb-7">
                    <label for="confirm_password" class="eForm-label">Confirm Password</label>
                    <input
                        type="password"
                        class="form-control eForm-control"
                        id="confirm_password"
                        name="confirm_password"
                        placeholder="Your current password"
                    />
                    </div>

                    <div class="fpb-7">
                    <label for="old_password" class="eForm-label">Current Password</label>
                    <input
                        type="password"
                        class="form-control eForm-control"
                        id="old_password"
                        name="old_password"
                        placeholder="Your current password"
                    />
                    </div>
                    <div class="fpb-7 text-end pt-3">
                        <button type="submit" class="btn btn-primary text-12px p-2">Change Password</button>
                    </div>

                </form>
                </div>
            </div>

            </div>
        </div>
    </div>
    <!-- End User Profile area -->
@endsection