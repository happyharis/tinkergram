@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="w-100">
        </div>
        <div class="col-4">
            <h2>{{$user->name}}</h2>
            <p> {{$post->caption}}</p>

            <a class="btn btn-primary" href="{{ url("post/$post->id/edit") }}">
                Edit
            </a>
            
            <form action="{{ route('post.destroy', ['post' => $post]) }}" 
                enctype="multipart/form-data" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            
        </div>
    </div>
</div>
@endsection


