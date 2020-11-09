@extends('layout')
@section('title', 'ブログ編集')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>ブログ編集フォーム</h2>
        <form method="POST" action="{{ route('blog.update') }}" onSubmit="return checkSubmit()">
        @csrf  
            <input type = "hidden" name = "id" value="{{$blog->id}}">
            <div class="form-group">
                
                <label for="title">
                    タイトル
                </label>
                <input
                    id="title"
                    name="title"
                    class="form-control"
                    value="{{ $blog->title }}"
                    type="text"
                >
                @error('title')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="content">
                    レシピ説明
                </label>
                <textarea
                    id="content"
                    name="content"
                    class="form-control"
                    rows="4"
                >{{ $blog->content}}</textarea>
                @error('content')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputTag">
                    タグ
                </label>
                @foreach($tags as $key=>$tag)
                    <div class="form-check form-check-inline">
                        <input 
                            type="checkbox"
                            @if (isset($blog -> tags) && $blog->tags->contains($key))
                            checked
                            @endif
                            name="tags[]"
                            value="{{$key}}"
                            id="tag{{$key}}"    
                        >
                        
                        <lavel for="tag{{$key}}" class="form-check-lavel">
                            {{$tag}}
                        </lavel>
                    </div>
                            
                @endforeach            
            </div>
            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('blog.index') }}">
                    キャンセル
                </a>
                <button type="submit" class="btn btn-primary">
                    更新する
                </button>
            </div>
        </form>
    </div>
</div>
<script>
function checkSubmit(){
if(window.confirm('更新してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection