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
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->gender }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->type }}</td>
                    <td><button type="button" class="detail-btn" data-id="{{ $contact->id }}">詳細</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

@foreach ($contacts as $contact)
    <div id="modal-{{ $contact->id }}" class="modal hidden">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="modal-body">
                <p><strong>お名前：</strong> {{ $contact->name }}</p>
                <p><strong>性別：</strong> {{ $contact->gender }}</p>
                <p><strong>メールアドレス：</strong> {{ $contact->email }}</p>
                <p><strong>お問い合わせの種類：</strong> {{ $contact->type }}</p>
                <p><strong>お問い合わせ内容：</strong> {{ $contact->content }}</p>
                <form method="POST" action="/admin/delete/{{ $contact->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">削除</button>
                </form>
            </div>
        </div>
    </div>
@endforeach


@endsection

<script>
    // 全ての「詳細を見る」ボタンにイベントをつける
    document.querySelectorAll('.detail-btn').forEach(function(button) {
        button.addEventListener('click', function () {
            // data属性からIDを取得
            const contactId = button.getAttribute('data-id');
            const modal = document.getElementById('modal-' + contactId);
            if (modal) {
                modal.style.display = 'block';
            }
        });
    });

    // 全てのモーダルの×ボタンを動かす
    document.querySelectorAll('.modal .close').forEach(function(closeBtn) {
        closeBtn.addEventListener('click', function () {
            const modal = closeBtn.closest('.modal');
            modal.style.display = 'none';
        });
    });

    // モーダルの外をクリックしたら閉じる
    window.addEventListener('click', function (event) {
        document.querySelectorAll('.modal').forEach(function(modal) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
</script>

