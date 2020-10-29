@extends('layout')
@section('title','タグ一覧')

@section('content')
    <div class="row">
      <div class="col-md-10 col-md-offset-2">
          <h2>タグ一覧</h2>
          @if(session('err_msg'))
            <p class="text-danger">
                {{session('err_msg')}}

            </p>
          @endif

          <table class="table table-striped">
              <tr>
                  <th>タグ番号</th>
                  <th>タイトル</th>
                  <th>日付</th>
                  <th></th>
                  <th></th>
              </tr>
              @foreach($tags as $tag)
              <tr>
                  <td>{{$tag->id}}</td>

                  <td><a href="{{route('tag.show',$tag->id)}}">{{$tag->title}}</a></td>

                  <td>{{$tag->updated_at}}</td>

                  <td><button type="button" class="btn btn-primary" onclick="location.href='/tag/edit/{{$tag->id}}'">編集</button></td>

                  <form method="POST" action="{{ route('tag.delete',$tag->id) }}" onSubmit="return checkDelete()">
                 @csrf  
                    <td><button type="submit" class="btn btn-primary" onclick=>削除</button></td>
                  </form>
 
              </tr>
              @endforeach   
          </table>
          {{$tags->links()}}
      </div>
    </div>
    <script>
function checkDelete(){
if(window.confirm('削除してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection    
    