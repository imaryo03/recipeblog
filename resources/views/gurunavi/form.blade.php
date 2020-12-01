@extends('layout')
@section('title', 'ブログ投稿')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>ブログ投稿フォーム</h2>
        <form method="POST" action="{{ route('gurunavi.store') }}"  enctype="multipart/form-data"  onSubmit="return checkSubmit()">
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
                    value="{{$item['name']}}"
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
                    id="recipe_img_gurunavi"
                    name="recipe_img_gurunavi"
                    type="text"
                    value="{{$item['image_url']['shop_image1']}}"
                >
                @error('recipe_img_gurunavi')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
                
            </div>
            <div class="form-group">
                <label for="content">
                   お店についてコメント
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
                    お店URL
                </label>
                <input
                    id="recipe_url"
                    name="recipe_url"
                    class="form-control"
                    value="{{$item['url']}}"
                    type="text"
                >
                @error('recipe_url')
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