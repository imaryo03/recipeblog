@extends('layout')
@section('title','ブログ一覧')
@section('content')

<a href="{{$item['recipeUrl']}}">{{$item['recipeUrl']}}</a>
<p></p>
<p></p>
<p></p>
<p></p>
<p></p>
<button type="button" class="btn btn-primary" onclick="location.href='/rakuten/blogcreate/{{$id}}'">このレシピを投稿</button>
@endsection 