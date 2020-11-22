@extends('layout')
@section('title', 'ブログ投稿')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>ブログ投稿フォーム</h2>
        <form method="POST" action="{{ route('rakuten.store') }}"  enctype="multipart/form-data"  onSubmit="return checkSubmit()">
        @csrf  
            <input type = "hidden" name = "user_id" value="{{$user_id}}">
            <div class="form-group">
                <label for="title">
                    タイトル
                </label>
                <input
                    id="title"
                    name="title"
                    class="form-control"
                    value="{{$item['recipeTitle']}}"
                    type="text"
                >
                @error('title')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="recipe_img_rakuten">
                    レシピ・料理写真
                </label>
                <input
                    id="recipe_img_rakuten"
                    name="recipe_img_rakuten"
                    type="text"
                    value="{{$item['foodImageUrl']}}"
                >
                @error('recipe_img_rakuten')
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
                >{{ old('content') }}</textarea>
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
                @foreach($tags as $tag)
                    <div class="form-check form-check-inline">
                        <input 
                            type="checkbox"
                            name="tags"
                            value="{{$tag->id}}"
                            id="tag{{$tag->id}}" 
                        >
                        <lavel for="tag{{$tag->id}}" class="form-check-lavel">
                            {{$tag->title}}
                        </lavel>
                    </div>
                            
                @endforeach            
            </div>
            <div class="form-group">
                <label for="recipe_url">
                    レシピURL
                </label>
                <input
                    id="recipe_url"
                    name="recipe_url"
                    class="form-control"
                    value="{{$item['recipeUrl']}}"
                    type="text"
                >
                @error('recipe_url')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="recipe_cost">
                    費用
                </label>
                <input
                    id="recipe_cost"
                    name="recipe_cost"
                    class="form-control"
                    value="{{$item['recipeCost']}}"
                    type="text"
                >
                @error('recipe_cost')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="recipe_time">
                    かかる時間
                </label>
                <input
                    id="recipe_time"
                    name="recipe_time"
                    class="form-control"
                    value="{{$item['recipeIndication']}}"
                    type="text"
                >
                @error('recipe_time')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('blog.index') }}">
                    キャンセル
                </a>
                <button type="submit" class="btn btn-primary">
                    投稿する
                </button>

            </div>
        </form>
    </div>
   
</div>

                            
                            
                            
                            

                
            
            
<script>
function checkSubmit(){
if(window.confirm('送信してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection