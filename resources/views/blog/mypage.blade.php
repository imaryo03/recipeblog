@extends('layout')
@section('title','マイページ')
@section('content')
    <div class="row">
      <div class="main_inner">
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
                  <div class="each_recipe_text">
                    <nav class="recipe-navbar navbar navbar-light bg-light">
                      <button class="recipe-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent{{$blog->id}}" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                        
                      <div class="collapse recipe-navbar-collapse navbar-collapse justify-content-center" id="navbarSupportedContent{{$blog->id}}">
                        <ul class="navbar-nav d-flex flex-row">
                          <li class="recipe_edit">
                          <form method="POST" action="{{ route('blog.delete',$blog->id) }}" onSubmit="return checkDelete()">
                          @csrf  
                            <button type="submit" class="btn btn-primary" onclick=>削除</button>
                          </form>
                          </li>
                          <li class="recipe_edit">
                          <button type="button" class="btn btn-primary" onclick="location.href='/blog/edit/{{$blog->id}}'">編集</button>
                          </li>
                        </ul>
                      </div>
                    </nav>
                    <p class="each_recipe_title"><a href="{{route('blog.show',$blog->id)}}">{{$blog->title}}</a></p>
                    <p class="each_recipe_comment">コメント{{$blog->comments->count()}}件</p>    
                  </div>
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
    