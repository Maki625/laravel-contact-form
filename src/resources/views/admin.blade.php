@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

<div class="container">
    <h1 class="text-center mb-4 admin-title">Admin</h1>

    {{-- 検索フォーム --}}
<div class="search-form-wrapper">
    <form method="GET" action="/admin" class="search-form">
        <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">

        <select name="gender">
            <option value="all">性別</option>
            <option value="男性" {{ request('gender') == '男性' ? 'selected' : '' }}>男性</option>
            <option value="女性" {{ request('gender') == '女性' ? 'selected' : '' }}>女性</option>
            <option value="その他" {{ request('gender') == 'その他' ? 'selected' : '' }}>その他</option>
        </select>

        <select name="type">
    <option value="">お問い合わせの種類</option>
    @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ request('type') == $category->id ? 'selected' : '' }}>
            {{ $category->content }}
        </option>
    @endforeach
</select>

        <input type="date" name="date" value="{{ request('date') }}">

        <div class="form-buttons">
            <button type="submit" class="search-form-button">検索</button>
            <a href="/admin" class="reset-btn">リセット</a>
</div>
    </form>
</div>

    {{-- エクスポート＆ページネーション --}}
<div class="export-pagination-wrapper">
    <form method="GET" action="/admin/export">
        <input type="hidden" name="keyword" value="{{ request('keyword') }}">
        <input type="hidden" name="gender" value="{{ request('gender') }}">
        <input type="hidden" name="type" value="{{ request('type') }}">
        <input type="hidden" name="date" value="{{ request('date') }}">
        <button type="submit" class="export-btn">エクスポート</button>
    </form>

    <div class="pagination-wrapper">
        {{ $contacts->appends(request()->query())->links() }}
    </div>
</div>


    {{-- テーブル --}}
    <table>
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->last_name }}{{ $contact->first_name }}</td>
                    <td>@if($contact->gender == 1)
                        男性
                        @elseif($contact->gender == 2)
                        女性
                        @else
                        その他
                        @endif
                    </td>
                    <td>{{ $contact->email }}</td>
                    <td>@foreach($categories as $category)
                          @if($category->id == 2)
                          <option value="{{ $category->id }}" selected>
                          {{ $category->content }}
                          </option>
                          @endif
                        @endforeach
                    </td>
                    <td><label for="modalToggle-{{ $contact->id }}" class="detail-btn">詳細</label></td>
                </tr>
            @endforeach
        </tbody>
    </table>

@foreach ($contacts as $contact)

<!-- チェックボックス（表示トリガー） -->
<input type="checkbox" id="modalToggle-{{ $contact->id }}" class="modal-checkbox">
    <div class="modal">
    <label for="modalToggle-{{ $contact->id }}" class="modal-overlay">&times;</label>
    <div class="modal__inner">
          <div class="modal__content">
            <label for="modalToggle-{{ $contact->id }}" class="modal__close-btn">×</label>
            <form class="modal__detail-form" action="/delete" method="post">
              @csrf
              <div class="modal-form__group">
                <label class="modal-form__label" for="">お名前</label>
                <p>{{$contact->last_name}}{{$contact->first_name}}</p>
              </div>

              <div class="modal-form__group">
                <label class="modal-form__label" for="">性別</label>
                <p>
                  @if($contact->gender == 1)
                  男性
                  @elseif($contact->gender == 2)
                  女性
                  @else
                  その他
                  @endif
                </p>
              </div>

              <div class="modal-form__group">
                <label class="modal-form__label" for="">メールアドレス</label>
                <p>{{$contact->email}}</p>
              </div>

              <div class="modal-form__group">
                <label class="modal-form__label" for="">電話番号</label>
                <p>{{$contact->tel}}</p>
              </div>

              <div class="modal-form__group">
                <label class="modal-form__label" for="">住所</label>
                <p>{{$contact->address}}</p>
              </div>

              <div class="modal-form__group">
                <label class="modal-form__label" for="">お問い合わせの種類</label>
                <p>{{$contact->category->content}}</p>
              </div>

              <div class="modal-form__group">
                <label class="modal-form__label" for="">お問い合わせ内容</label>
                <p>{{$contact->inquiry_content}}</p>
              </div>
              <input type="hidden" name="id" value="{{ $contact->id }}">
              <input class="modal-form__delete-btn btn" type="submit" value="削除">

            </form>
          </div>
        </div>
    </div>
@endforeach


@endsection
