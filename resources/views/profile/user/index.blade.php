@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="card mt-3">
                    <div class="card-header pt-3 d-flex">
                        <h4>{{ auth()->user()->name }}</h4>
                        <?php
                            $profileImg = auth()->user()->userData->profile_image? auth()->user()->userData->profile_image : "https://via.placeholder.com/50"
                        ?>
                        <img class="profile-image" src="{{ $profileImg }}" alt="Profile Image">
                    </div>
                    <div class="card-body">
                        <p>Email: {{ auth()->user()->email }}</p>
                        <p>First Name: {{ auth()->user()->userData->first_name }}</p>
                        <p>Last Name: {{ auth()->user()->userData->last_name }}</p>
                        <p>Birth Date: {{ auth()->user()->userData->birthdate }}</p>
                        <p>Address: {{ auth()->user()->userData->address }}</p>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header pt-3">
                        <h4>Edit Profile</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="{{ auth()->user()->name }}">
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name" value="{{ auth()->user()->userData->first_name }}">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name" value="{{ auth()->user()->userData->last_name }}">
                            </div>
                            <div class="form-group">
                                <label for="birthdate">Birth Date</label>
                                <input type="date" class="form-control" name="birthdate" id="birthdate" placeholder="Birthdate" value="{{ auth()->user()->userData->birthdate }}">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{ auth()->user()->userData->address }}">
                            </div>
                            <div class="form-group">
                                <label for="profile_image">Profile Image</label>
                                <input type="text" class="form-control" name="profile_image" id="profile_image" placeholder="Profile image" value="{{ auth()->user()->userData->profile_image }}">
                            </div>

                            @if(auth()->user()->isVenue())
                                <h4>YOU ARE A VENUE! WELL DONE!</h4>
                                <div class="form-group">
                                    <label for="services-select">Services</label>
                                    <select multiple class="form-control" id="services-select">
                                        <option>Service 1</option>
                                        <option>Service 2</option>
                                        <option>Service 3</option>
                                        <option>Service 4</option>
                                        <option>Service 5</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="staff-select">Staff</label>
                                    <select multiple class="form-control" id="staff-select">
                                        <option>Staff 1</option>
                                        <option>Staff 2</option>
                                        <option>Staff 3</option>
                                        <option>Staff 4</option>
                                        <option>Staff 5</option>
                                    </select>
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection