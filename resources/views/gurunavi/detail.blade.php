@extends('layout')
@section('title','お店詳細')
@section('content')
    <div class="detail">
      <div class="left pl-0 col-md-8 col-md-offset-2">
        <h1 class="title">{{$item['name']}} </h1>
          <img class="recipe-img" src="{{$item['image_url']['shop_image1']}}">
      </div>
      <div class="right col-md-6 mb-5">
        <table class="mb-5">
            <tbody>
                <tr>
                    <th>お店詳細(ぐるなび)</th>
                    <td><a href="{{$item['url']}}">こちら</a></td>
                </tr>
                <tr>
                    <th>お店所在地</th>
                    <td>{{$item['address']}}</td> 
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>{{$item['tel']}}</td> 
                </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary" onclick="location.href='/gurunavi/blogcreate/{{$areacode}}/{{$page_id}}/{{$id}}/'">このお店を投稿</button>
      </div>
    </div>
@endsection    
    