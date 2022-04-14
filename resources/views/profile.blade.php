@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-3">
           <img class="rounded-circle" width="150" src="/storage/{{ $profile->image }}">
       </div>
       <div class="col-md-9">
           <h3>{{ $user->name }}</h3>
           <span><strong>{{$numPosts}}</strong> posts</span>
           <div class="pt-3">{{$profile->description}}</div>
           <div class="pt-3"><a href="/profile/edit">Edit profile</a></div>
       </div>
   </div>
   <div class="row pt-5">
    <div class="row pt-5">
        {{-- $posts = [Post(1), Post(2)] --}}
        {{-- $post represent a single element of the posts --}}
        {{-- for the first loop, $post = Post(id: 1, image: 'asdf')  --}}
        @foreach($posts as $post)
            <div class="col-4 mb-5">
                <a href="/post/{{$post->id}}">
                    <img src="/storage/{{$post->image}}" class="w-100">
                </a>
            </div>
        @endforeach
    </div>
   
</div>
@endsection

