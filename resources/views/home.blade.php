@extends('layouts.app')

@section('title','新規登録')

@section('content')
<div class="py-auto h-75 mt-6">
  <div class="row justify-content-center">
    <div>
      <div class="col-md-8 text-center">
        <form action="/store" method="post" class="d-flex justify-content-around mt-5">
          @csrf
          <div class="text-center d-flex flex-wrap w-100">
            <input type="text" name="text" class="form-control w-100 mr-2">
            @if ($errors->has('text'))
            @foreach($errors->get('text') as $message)
            <span class="text-danger mt-2">{{ $message }}</span>
            @endforeach
            @endif
          </div>
          <div>
            <button type="submit" class="btn btn-outline-primary button">登録</button>
          </div>
        </form>
      </div>
      <Table class="table table-hover mt-5">
        <tr class="table-light">
          <th>No.</th>
          <th>メモ内容</th>
          <th>作成日時</th>
          <th>更新日時</th>
          <th></th>
          <th></th>
        </tr>
        @foreach($memos as $memo)
        <tr class="table-light">
          <td>{{ $memo->id }}</td>
          <td>{{ $memo->text }}</td>
          <td>{{ $memo->formated_created_at }}</td>
          <td>{{ $memo->formated_updated_at }}</td>
          <td>
            <form action="/edit/{{ $memo->id }}" method="get">
              @csrf
              <button type="submit" class="btn btn-outline-success button">編集</button>
            </form>
          </td>
          <td>
            <button type="button" class="btn btn-outline-danger button" data-toggle="modal" data-target="#exampleModal">削除</button>
            <form action="/delete/{{ $memo->id }}" method="post">
              @csrf
              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">本当に削除してもよろしいですか？</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">閉じる</button>
                      <button type="submit" class="btn btn-outline-primary">削除する</button>
                    </div>
                  </div>
                </div>
              </div>
              
            </form>
          </td>
          @endforeach
        </tr>
      </Table>


    </div>
  </div>
</div>
@endsection
