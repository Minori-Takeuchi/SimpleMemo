@extends('layouts.app')

@section('content')
<div class="container">
  <form action="/store" method="post">
    @csrf
    <input type="text" name="text">
    <button type="submit">登録</button>
  </form>
  @if ($errors->has('text'))
    @foreach($errors->get('text') as $message)
      <p>{{ $message }}</p>
    @endforeach
  @endif
  <Table>
    <tr>
      <th>No.</th>
      <th>メモ内容</th>
      <th>作成日時</th>
      <th>更新日時</th>
    </tr>
    @foreach($memos as $memo)
    <tr>
      <td>{{ $memo->id }}</td>
      <td>{{ $memo->text }}</td>
      <td>{{ $memo->formated_created_at }}</td>
      <td>{{ $memo->formated_updated_at }}</td>
      <td>
        <form action="/edit/{{ $memo->id }}" method="get">
          @csrf
          <button type="submit">編集</button>
        </form>
      </td>
      <td>
        <form action="/delete/{{ $memo->id }}" method="post">
          @csrf
          <button type="submit">削除</button>
        </form>
      </td>
    </tr>
    @endforeach
  </Table>
</div>
@endsection