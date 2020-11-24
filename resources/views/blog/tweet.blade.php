@extends('layout')
@section('title','tweet投稿')
@section('content')
<div>
  <form method="POST" action="{{ route('tweet.store',$blog_id)}}" >
@csrf  
    <button type="submit" class="btn btn-primary" >公式アカウントにツイートする</button>
  </form>
</div>
<div>
<a class="btn btn-secondary" href="{{ route('blog.index') }}">ツイートしない</a>
</div>
@endsection 