<link href="{{ asset('css/confirm.css') }}" rel="stylesheet">

<header class="header">
    <div class="header__inner">
      <div class="header-utilities">
        <a class="header__logo" href="/register">
          FashionablyLate
        </a>
      </div>
    </div>
  </header>

<body>
<div class="form-container">
    <h2 class="form-title">Confirm</h2>

    <div class="form-box">
        <!-- 入力内容を表形式で表示 -->
        <table class="form-table">
            <tbody>
                <tr>
                    <th>お名前</th>
                    <td>{{ $data['last_name'] }} {{ $data['first_name'] }}</td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>
                        @if ($data['gender'] == '男性') 男性
                        @elseif ($data['gender'] == '女性') 女性
                        @else その他
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>{{ $data['email'] }}</td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>{{ $data['tel1'] }} - {{ $data['tel2'] }} - {{ $data['tel3'] }}</td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>{{ $data['address'] }}</td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td>{{ $data['building'] }}</td>
                </tr>
                <tr>
                    <th>お問合せの種類</th>
                    <td>{{ $data['inquiry_type_name'] }}</td>
                </tr>
                <tr>
                    <th>お問合せ内容</th>
                    <td>{{ $data['inquiry_content'] }}</td>
                </tr>
            </tbody>
        </table>

        <!-- 送信ボタン -->
        <form action="/submit" method="POST" class="mt-3">
            @csrf
            <input type="hidden" name="first_name" value="{{ $data['first_name'] }}">
    <input type="hidden" name="last_name" value="{{ $data['last_name'] }}">
    <input type="hidden" name="gender" value="{{ $data['gender'] }}">
    <input type="hidden" name="email" value="{{ $data['email'] }}">
    <input type="hidden" name="tel1" value="{{ $data['tel1'] }}">
    <input type="hidden" name="tel2" value="{{ $data['tel2'] }}">
    <input type="hidden" name="tel3" value="{{ $data['tel3'] }}">
    <input type="hidden" name="address" value="{{ $data['address'] }}">
    <input type="hidden" name="building" value="{{ $data['building'] }}">
    <input type="hidden" name="inquiry_type" value="{{ $data['inquiry_type'] }}">
    <input type="hidden" name="inquiry_content" value="{{ $data['inquiry_content'] }}">
            <button type="submit" name="send" class="form-btn" value="1">送信</button>
            <button type="submit" name="return" class="form-btn" value="1">修正</button>
        </form>

    </div>
</div>
</body>