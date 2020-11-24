@extends('layout')
@section('title','ブログ一覧')
@section('content')

<a href="{{$item['recipeUrl']}}">{{$item['recipeUrl']}}</a>
<img src="{{$item['foodImageUrl']}}" alt="" height="100px" width="100px">
<p></p>
<p></p>
<p></p>
<p></p>
<button type="button" class="btn btn-primary" onclick="location.href='/rakuten/blogcreate/{{$recipeid}}/{{$id}}'">このレシピを投稿</button>
@endsection 