@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="card mt-3">
                    <div class="card-header pt-3 d-flex">
                        <h4>{{ $user->name }}</h4>
                        <?php
                            $profileImg = $user->userData->profile_image? $user->userData->profile_image : "https://via.placeholder.com/50"
                        ?>
                        <img class="profile-image" src="{{ $profileImg }}" alt="Profile Image">
                    </div>
                    <div class="card-body">
                        <p>Email: {{ $user->email }}</p>
                        <p>First Name: {{ $user->userData->first_name }}</p>
                        <p>Last Name: {{ $user->userData->last_name }}</p>
                        <p>Birth Date: {{ $user->userData->birthdate }}</p>
                        <p>Address: {{ $user->userData->address }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection