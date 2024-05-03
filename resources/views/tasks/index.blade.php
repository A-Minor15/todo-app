<!-- // Child Template -->
@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- .env file APP_NAME = Todo-App -->
    <h1 class="h3">{{ config('app.name') }}</h1>

    <form action="{{ route('store') }}" method="post">
        <!-- If you use a form in laravel, you to add the @csrf -->
        @csrf
        <!-- CSRF: Cross-Site-Request-Forgeries -->
        <!-- To validate request / Security / for CSRF protection -->

        <div class="row gx-2 mb-3">
            <div class="col-10">
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Add task here..." autofocus>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary w-100">Add</button>
            </div>
            <!-- Error Message Area -->
            @error('name')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>
    </form>

    <!-- Display all data here -->
    @if ($all_tasks->isNotEmpty())
        <ul class="list-group">
            @foreach($all_tasks as $task)
                <li class="list-group-item d-flex align-items-center">
                    <p class="mb-0 me-auto">{{ $task->name }}</p>
                    <!-- Action buttons here Edit|Delete -->

                    <!-- Edit Button -->
                    <a href="{{ route('edit', $task->id) }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-pen"></i></a>

                    <!-- Delete Button -->
                    <form action="{{ route('destroy', $task->id) }}" method="post" class="ms-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif

@endsection