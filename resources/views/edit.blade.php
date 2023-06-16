@extends('layouts.app')

@section('title','No.'. $memo->id .'　メモ編集')

@section('content')
<div class="container">
  <form action="/update" method="post" class="mt-5 d-flex justify-content-center flex-wrap">
    @csrf
    <div class="w-75">
      <input type="hidden" name="id" value="{{ $memo->id }}">
      <input type="text" name="text" value="{{ $memo->text }}" class="form-control mb-2">
      @if ($errors->has('text'))
      @foreach($errors->get('text') as $message)
        <span class="text-danger">{{ $message }}</span>
      @endforeach
      @endif
    </div>
    <div class="d-flex justify-content-between mt-5 w-75">
      <button type="submit" name="back" value="back" class="btn btn-outline-success">戻る</button>
      <button type="submit" name="action" value="submit" class="btn btn-outline-primary">登録</button>
    </div>
    </form>
</div>
@endsection