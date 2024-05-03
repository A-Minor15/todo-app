@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
    <form action="{{ route('update', ['id' => $task->id]) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="row gx-2 mb-3">
            <div class="col-10">
                <input type="text" name="name" value="{{ old('name', $task->name) }}" class="form-control" placeholder="Add task here..." autofocus>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-secondary w-100"><i class="fa-solid fa-check"> Update</i></button>
            </div>
            <!-- Error Message Area -->
            @error('name')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>
    </form>
