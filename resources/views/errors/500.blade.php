@extends('frontend.navigation')
@section('content') 
<div class="d-flex flex-column justify-content-center align-items-center mb-5 mt-5">
    <div class="text-center p-4 bg-white shadow rounded" style="max-width: 500px; width: 100%;">
        <img src="https://cdn-icons-png.flaticon.com/512/564/564619.png" alt="Error Icon" width="80" class="mb-3">
        <h2 class="text-danger mb-3">Oops! Something went wrong</h2>
        <p class="f-nav-text pb-20">We're sorry, but an unexpected error occurred.<br>Please try again later or go back to the homepage.</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Return to Homepage</a>
    </div>
</div>

@endsection