@extends('employee-layout')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="text-left">
                <div class="row">
                    <div class="col-md-3">
                        <h1> Discussion </h1>
                    </div>
                </div>
            </div>

            <!-- entry box and search button -->
            <br>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <form class="row align-items-end">
                            <div class="col-md-9 mb-3">
                                <label for="search" class="form-label"></label>
                                <input type="text" id="search" name="search" placeholder="Type your questions here!" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3 text-md-end">
                                <!-- submit button for search -->
                                <button type="submit" class="btn btn-primary btn-sm" style="width: 100%; padding: 6px;">
                                    <i class="bi bi-search"></i> Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- type your own question button -->
            <div class="row">
                <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary btn-sm" style="width: 100%; padding: 10px;">
                        <i class="bi bi-search"></i> Cannot find your questions? Write your own now!
                    </button>
                </div>
            </div>

            <!-- Answered questions header -->
            <div class="row mt-3">
                <div class="col-md-12 mb-3">
                    <h1>Answered Questions</h1>
                </div>
            </div>

            <!-- Check if $randomPost exists and contains valid data -->
            @if($randomPost)
            <!-- 2x2 cards for answered questions -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card twoxtwo-gray-card">
                        <div class="card-body">
                            <!-- Card content goes here -->
                            <h5 class="card-title">Asked by: {{ $user -> name }}</h5>

                            <!-- Additional Card content goes here -->
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Title: {{ $randomPost->title }}</h5>
                                    <p class="card-text">Content: {{ $randomPost->content }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="card twoxtwo-gray-card">
                        <div class="card-body">
                            <!-- Card content goes here -->
                            <h5 class="card-title">Asked by: {{ $user -> name }}</h5>

                            <!-- Additional Card content goes here -->
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Title: {{ $randomPost->title }}</h5>
                                    <p class="card-text">Content: {{ $randomPost->content }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-md-12">
                    <p>No posts found.</p>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

@endsection
