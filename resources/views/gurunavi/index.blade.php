@extends('layout')
@section('title','エリア一覧')

@section('content')
<div class="row">
      <div class="col-md-10 col-md-offset-2">
          <h2>エリア一覧</h2>
          @if(session('err_msg'))
            <p class="text-danger">
                {{session('err_msg')}}

            </p>
          @endif

          <table class="table table-striped">
              <tr>
                  <th>エリア名</th>
              </tr>
              @foreach($items as $item)
              <tr>
                  
                  <td><a href="{{route('gurunavi.shop',['id'=>$item['areacode_l'], 'page_id'=>1])}}">{{$item['areaname_l']}}</a></td>

 
              </tr>
              @endforeach   
          </table>
         
      </div>
    </div>
    @endsection  
           