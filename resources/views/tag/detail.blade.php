@extends('layout')
@section('title','タグ詳細')
@section('content')
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

          <h2>{{$tag->title}}のレシピ </h2>
          
          <table class="table table-striped">
              <tr>
                  <th>記事番号</th>
                  <th>タイトル</th>
                  <th>日付</th>
                  <th></th>
                  <th></th>
              </tr>
              @foreach($blogs as $blog)
              <tr>
                  <td>{{$blog->id}}</td>

                  <td><a href="{{route('blog.show',$blog->id)}}">{{$blog->title}}</a></td>

                  <td>{{$blog->updated_at}}</td>

                  <td><button type="button" class="btn btn-primary" onclick="location.href='/blog/edit/{{$blog->id}}'">編集</button></td>

                  <form method="POST" action="{{ route('blog.delete',$blog->id) }}" onSubmit="return checkDelete()">
                 @csrf  
                    <td><button type="submit" class="btn btn-primary" onclick=>削除</button></td>
                  </form>
 
              </tr>
              @endforeach   
          </table>
          
      </div>
    </div>
@endsection    
    