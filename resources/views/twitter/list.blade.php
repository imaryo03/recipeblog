@extends('layout')
@section('title','ツイート検索')
@section('content')
    <form action="{{route('tweet.search')}}" method="POST">
        @csrf
        <input type="text" name="input" value="{{old('input')}}">
        <input type="submit" value="find">
    </form>
@endsection