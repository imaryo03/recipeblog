@extends('layout')
@section('title', 'タグ投稿')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2'タグ投稿フォーム</h2>
        <form method="POST" action="{{ route('tag.store') }}" onSubmit="return checkSubmit()">
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
                    value="{{ old('title') }}"
                    type="text"
                >
                @error('title')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            
            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('tag.index') }}">
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