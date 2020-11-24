@extends('layout')
@section('title','ブログ詳細')
@section('content')
    <div lass="row detail">
      <div class="left pl-0 col-md-8 col-md-offset-2">
        <h1 class="title">{{$blog->title}} </h1>
        @foreach($tags as $tag)   
        <a href="{{route('tag.show',$tag->id)}}">{{$tag->title}}</a>
        @endforeach
        @if($blog->recipe_img)
        <img class="recipe-img" src="/uploads/{{$blog->recipe_img}}">
        @endif
        @if($blog->recipe_img_rakuten)
        <img class="recipe-img" src="{{$blog->recipe_img_rakuten}}" >
        @endif
        <div class="recipe-introduce">
          <h2>レシピの説明</h2>
          <div class="recipe-introduce_inner">
              <p>{{$blog->content}}</p>
          </div>
        </div>
      </div>
      <div class="right col-md-6 mb-5">
        <table class="mb-5">
            <tbody>
                <tr>
                    <th>時間</th>
                    <td>{{$blog->recipe_time}}分</td>
                </tr>
                <tr>
                    <th>費用</th>
                    <td>{{$blog->recipe_cost}}円</td>
                </tr>
            </tbody>
        </table>
        <form  method="POST" action="{{ route('comment.store') }}">
        @csrf
    
            <input
               name="blog_id"
               type="hidden"
               value="{{ $blog->id }}"
            >
    
            <div class="form-group">
                <label for="name">
                コメント
                </label>

                <input
                    id="name"
                    name="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    type="text"
                >
                @if ($errors->has('name'))
                 <div class="text-danger">
                 {{ $errors->first('name') }}
                 </div>
                @endif
            </div>
    
            <div class="form-group">
                <textarea
                    id="comment"
                    name="comment"
                    class="form-control"
                    rows="10"
                >{{ old('comment') }}</textarea>
                @if ($errors->has('comment'))
                 <div class="text-danger">
                 {{ $errors->first('comment') }}
                 </div>
                @endif
            </div>

            <div class="mt-4">
             <button type="submit" class="btn btn-primary">
             コメントする
             </button>
            </div>
        </form>
      </div>

      <div class="left pl-0 col-md-8 col-md-offset-2">
          <h2>コメント</h2>
          @forelse($comments as $comment)
            <div class="border-top p-4">
                 <p class="mt-2">{{$comment->name}}</p>
                 <p class="mt-2">
                    {!! nl2br(e($comment->comment)) !!}
                </p>
            </div>
          @empty
            <p>コメントはまだありません。</p>
          @endforelse
      </div>
    </div>
@endsection    
    
     