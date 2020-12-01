@extends('layout')
@section('title','レシピ詳細')
@section('content')
    <div lass="row detail">
      <div class="left pl-0 col-md-8 col-md-offset-2">
        <h1 class="title">{{$item['recipeTitle']}} </h1>
          <img class="recipe-img" src="{{$item['foodImageUrl']}}">
        <div class="recipe-introduce">
          
          <div class="recipe-introduce_inner">
              <!-- <p></p> -->
          </div>
        </div>
      </div>
      <div class="right col-md-6 mb-5">
        <table class="mb-5">
            <tbody>
                <tr>
                    <th>レシピ詳細(楽天レシピ)</th>
                    <td><a href="{{$item['recipeUrl']}}">こちら</a></td>
                </tr>
                <tr>
                    <th>ひとこと</th>
                    <td>{{$item['recipeDescription']}}</td> 
                </tr>
                <tr>
                    <th>調理時間</th>
                    <td>{{$item['recipeIndication']}}</td> 
                </tr>
                <tr>
                    <th>費用</th>
                    <td>{{$item['recipeCost']}}</td> 
                </tr>
            </tbody>
        </table>
<button type="button" class="btn btn-primary" onclick="location.href='/rakuten/blogcreate/{{$recipeid}}/{{$id}}'">このレシピを投稿</button>
@endsection 