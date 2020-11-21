@extends('layout')
@section('title','ツイート一覧')
@section('content')
<div class="container">
   @foreach ($tweets as $tweet)
       <div class="card mb-2">
           <div class="card-body">
               <div class="media">
                   <img src="https://placehold.jp/70x70.png" class="rounded-circle mr-4">
                   <div class="media-body">
                       <h5 class="d-inline mr-3"><strong>{{ $tweet->user->name }}</strong></h5>
                       <h6 class="d-inline text-secondary">{{ date('Y/m/d', strtotime($tweet->created_at)) }}</h6>
                       <p class="mt-3 mb-0">{{ $tweet->text }}</p>
                   </div>
               </div>
           </div>
       </div>
   @endforeach
</div>
@endsection
