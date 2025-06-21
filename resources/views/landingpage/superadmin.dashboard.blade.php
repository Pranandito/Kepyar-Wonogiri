<!-- resources/views/superadmin/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('superadmin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('superadmin.log.akun') }}">Log Akun</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="dashboard">
                        <!-- Dashboard content here -->
                    </div>
                    <div class="tab-pane" id="log-akun">
                        <!-- Log Akun content here -->
                        <h1>Log Akun</h1>
                        <p>This is the log akun page.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection