@extends('layouts.app')

@section('content')
<div class="container">
  <form action="/update" method="post">
    @csrf
    <input type="text" name="text" value="{{ $memo->text }}">
    <input type="hidden" name="id" value="{{ $memo->id }}">
    <button type="submit">登録</button>
  </form>
  @if ($errors->has('text'))
    @foreach($errors->get('text') as $message)
      <p>{{ $message }}</p>
    @endforeach
  @endif
</div>
@endsection