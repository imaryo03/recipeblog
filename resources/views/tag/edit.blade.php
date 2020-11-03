@extends('layout')
@section('title', 'タグ編集')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>タグ編集フォーム</h2>
        <form method="POST" action="{{ route('tag.update') }}" onSubmit="return checkSubmit()">
        @csrf  
            <input type = "hidden" name = "id" value="{{$tag->id}}">
            <div class="form-group">
                
                <label for="title">
                    タイトル
                </label>
                <input
                    id="title"
                    name="title"
                    class="form-control"
                    value="{{ $tag->title }}"
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