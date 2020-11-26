@extends('layout')
@section('title','お店一覧')
@section('content')

<div class="row">
      <div class="col-md-10 col-md-offset-2">
          <h2>お店一覧</h2>
          @if(session('err_msg'))
            <p class="text-danger">
                {{session('err_msg')}}

            </p>
          @endif

          <table class="table table-striped">
              <tr>
                  <th>店名</th>
                  <th>カテゴリー</th>
                  <th>定休日</th>
              </tr>
              @foreach($items as $item)
              <tr>
                  <td><a href="{{route('gurunavi.show',['areacode'=>$areacode,'id'=>$loop->index])}}">{{$item['name']}}</a></td>

                  <td>{{$item['category']}}</td>

                  <td>{{$item['holiday']}}</td>
              </tr>
              @endforeach   
          </table>
      </div>
    </div>
    @endsection    
   