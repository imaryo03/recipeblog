@extends('layout')
@section('title','ブログ一覧')
@section('content')
    <div class="row">
      <div class="col-md-10 col-md-offset-2">
          <div class="main_head">
            <h2>レシピ一覧</h2>
            <form action="{{route('blog.search')}}" method="POST">
                @csrf
                <input type="text" name="input" value="{{old('input')}}">
                <input type="submit" value="find">
            </form>

          </div>
          @if(session('err_msg'))
            <p class="text-danger">
                {{session('err_msg')}}
            </p>
          @endif

         
            <div class="recipes">

                @foreach($blogs as $blog)
                <div class="each_recipe">
                @if($blog->recipe_img)
                  <img src="/uploads/{{$blog->recipe_img}}" alt="">
                @endif
                @if($blog->recipe_img_rakuten)
                  <img src="{{$blog->recipe_img_rakuten}}" alt="" >
                @endif
                  <p><a href="{{route('blog.show',$blog->id)}}">{{$blog->title}}</a></p>
                  <p>コメント{{$blog->comments->count()}}件</p>    
                </div>
                
                @endforeach   
            </div>
        
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
    