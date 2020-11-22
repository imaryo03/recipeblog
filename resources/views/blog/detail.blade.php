@extends('layout')
@section('title','ブログ詳細')
@section('content')
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

          <h2>{{$blog->title}} </h2>
          
          <span>作成日{{$blog->created_at}}</span>
          <span>更新日{{$blog->updated_at}}</span>
          <span>時間：{{$blog->recipe_time}}分</span>
          <span>費用：{{$blog->recipe_cost}}円</span>
          <span>レシピURL：{{$blog->recipe_url}}</span>

          <p>{{$blog->content}}</p> 
          @foreach($tags as $tag)   
          <a href="{{route('tag.show',$tag->id)}}">{{$tag->title}}</a>
          @endforeach
          @if($blog->recipe_img)
          <img src="/uploads/{{$blog->recipe_img}}" alt="" width="200px" height="200px">
          @endif
          @if($blog->recipe_img_rakuten)
          <img src="{{$blog->recipe_img_rakuten}}" alt="" width="200px" height="200px">
          @endif
      </div>
      
      <div class="mb-4">
        <form  method="POST" action="{{ route('comment.store') }}">
        @csrf
    
            <input
               name="blog_id"
               type="hidden"
               value="{{ $blog->id }}"
            >
    
            <div class="form-group">
                <label for="name">
                名前
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
             <label for="comment">
             本文
             </label>

                <textarea
                    id="comment"
                    name="comment"
                    class="form-control"
                    rows="4"
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
      <div class="col-md-8 col-md-offset-2">
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
    