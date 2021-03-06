@extends('layout')
@section('title','タグ一覧')

@section('content')
<div class="row">
      <div class="col-md-10 col-md-offset-2">
          <h2>カテゴリー一覧</h2>
          @if(session('err_msg'))
            <p class="text-danger">
                {{session('err_msg')}}

            </p>
          @endif

          <table class="table table-striped">
              <tr>
                  <th>タイトル</th>
                  <th>レシピID</th>
              </tr>
              @foreach($items as $item)
              <tr>
                  <td><a href="{{route('rakuten.recipe',$item['categoryId'])}}">{{$item['categoryName']}}</a></td>

                  <td>{{$item['categoryId']}}</td>
 
              </tr>
              @endforeach   
          </table>
         
      </div>
    </div>
    @endsection  
           