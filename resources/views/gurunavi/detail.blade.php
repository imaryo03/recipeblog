@extends('layout')
@section('title','お店詳細')
@section('content')

<a href="{{$item['url']}}">{{$item['url']}}</a>
<p>{{$item['name']}}</p>
<p></p>
<p></p>
<p></p>
<button type="button" class="btn btn-primary" onclick="location.href='/rakuten/blogcreate/{{$areacode}}/{{$id}}'">このレシピを投稿</button>
@endsection 