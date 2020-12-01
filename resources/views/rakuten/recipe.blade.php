@extends('layout')
@section('title','ブログ一覧')
@section('content')

<div class="row">
      <div class="col-md-10 col-md-offset-2">
          <h2>レシピ一覧</h2>
          @if(session('err_msg'))
            <p class="text-danger">
                {{session('err_msg')}}

            </p>
          @endif

          <table class="table table-striped">
              <tr>
                  <th>タイトル</th>
                  <th>制作者</th>
                  <th>調理時間</th>
              </tr>
              @foreach($items as $item)
              <tr>
                  <td><a href="{{route('rakuten.show',['recipeid'=>$recipeid,'id'=>$loop->index])}}">{{$item['recipeTitle']}}</a></td>

                  <td>{{$item['nickname']}}</td>

                  <td>{{$item['recipeIndication']}}</td>
              </tr>
              @endforeach   
          </table>
      </div>
    </div>
    @endsection    
   