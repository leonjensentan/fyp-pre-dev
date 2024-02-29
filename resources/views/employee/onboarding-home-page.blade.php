<!-- onboarding-home-page.blade.php -->
@extends('layout')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Onboarding Modules</h1>
    
    <div class="row">
        @foreach ($modules as $module)
        <div class="col-md-6">
            <div class="card mb-4">
                <img src="{{ asset('images/' . $module->image) }}" class="card-img-top" alt="{{ $module->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $module->title }}</h5>
                <div class="progress-container"> <progress class="progress" value="{{ $module->completion_percentage }}"
                        max="100"></progress>
                    <span class="progress-percentage">{{ $module->completion_percentage }}%</span>
                </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
