@extends('layout')
@section('title','ブログ一覧')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-10">
            <table class="table table-striped table-dark mt-5">
                <tr>
                    <th>レシピ名</th>
                    <th>レシピ投稿者</th>
                    <th>調理時間</th>
                    <th>ループ</th>
                </tr>
                @foreach($items as $item)
                <tr>
                    <td><a href="{{route('rakuten.show',['recipeid'=>$recipeid,'id'=>$loop->index])}}">{{$item['recipeTitle']}}</a><td>
                    <td>{{$item['nickname']}}</td>
                    <td>{{$item['recipeIndication']}}</td>
                    <td>{{$loop->index}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    @endsection    
    