@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4">
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
                <h4 class="mt-4">Services</h4>
                <div class="row">
                    <?php foreach(json_decode((auth()->user()->userData->services)) as $service):?>
                        <div class="col-12 col-md-4">
                            <div class="card mt-3">
                                <div class="card-body text-center">
                                    {{ $service }}
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>

                <h4 class="mt-4">Staff</h4>
                <div class="row">
                    <?php foreach(json_decode((auth()->user()->userData->staff)) as $staff):?>
                    <div class="col-12 col-md-4">
                        <div class="card mt-3">
                            <div class="card-body text-center">
                                {{ $staff }}
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <iframe width="100%" height="300" frameborder="0" src="https://www.google.com/maps?q={{ auth()->user()->userData->address }}&output=embed"></iframe>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="card mt-3">
                    <div class="card-header pt-3">
                        <h4>Edit Venue Profile</h4>
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

                            <div class="form-group">
                                <label for="services">Services <small>(Type all services separated with comma "," )</small></label>
                                <textarea class="form-control" name="services" id="services"
                                          placeholder="Services... Type all services separated with comma (,)"><?php echo jsonDecode(auth()->user()->userData->services) ?></textarea>
                            </div>


                            <div class="form-group">
                                <label for="staff">Staff <small>(Type all staff separated with comma "," )</small></label>
                                <textarea class="form-control" name="staff" id="staff"
                                          placeholder="Staff... Type all services separated with comma (,)"><?php echo jsonDecode(auth()->user()->userData->staff) ?></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<?php
    function jsonDecode($string){
        return implode(", ", json_decode($string));
    }
?>