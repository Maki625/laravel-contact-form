
<link href="{{ asset('css/index.css') }}" rel="stylesheet">

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
    <div class="container">
        <h2 class="page-title">Contact</h2>

        <form method="POST" action="/confirm">
            @csrf

            <!-- お名前 -->
            <div class="form-group">
                <label>お名前 <span class="required">※</span></label>
                <div class="name-inputs">
                    <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                    <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}"></div>
                    <div class="error-message">
                    @error('last_name') <p class="error">{{ $message }}</p> @enderror
                    @error('first_name') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- 性別 -->
            <div class="form-group">
                <label>性別 <span class="required">※</span></label>
                <div class="gender-inputs">
                    <label><input type="radio" name="gender" value="男性" {{ old('gender') === '男性' ? 'checked' : '' }}> 男性</label>
                    <label><input type="radio" name="gender" value="女性" {{ old('gender') === '女性' ? 'checked' : '' }}> 女性</label>
                    <label><input type="radio" name="gender" value="その他" {{ old('gender') === 'その他' ? 'checked' : '' }}> その他</label>
                </div>
                <div class="error-message">
                @error('gender') <p class="error">{{ $message }}</p> @enderror
            </div>
</div>

            <!-- メール -->
            <div class="form-group">
                <label>メールアドレス <span class="required">※</span></label>
                <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
            <div class="error-message">
            @error('email') <p class="error">{{ $message }}</p> @enderror
</div>
</div>

            <!-- 電話番号 -->
            <div class="form-group">
                <label>電話番号 <span class="required">※</span></label>
                <div class="phone-inputs">
                    <input type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}">
                    <span class="dash">-</span>
                    <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}">
                    <span class="dash">-</span>
                    <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
                <div class="error-message">
                    @error('tel1') <p class="error">{{ $message }}</p> @enderror
                    @error('tel2') <p class="error">{{ $message }}</p> @enderror
                    @error('tel3') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- 住所 -->
            <div class="form-group">
                <label>住所 <span class="required">※</span></label>
                <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                <div class="error-message">
                @error('address') <p class="error">{{ $message }}</p> @enderror
            </div>
</div>

            <!-- 建物名 -->
            <div class="form-group">
                <label>建物名</label>
                <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
</div>
</div>

        <!-- お問い合わせの種類 -->
<div class="form-group">
        <label>お問い合わせの種類 <span class="required">※</span></label>
        <select name="inquiry_type">
            <option value="">選択してください</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->content }}</option>
            @endforeach
        </select>
    <div class="error-message">
        @error('inquiry_type') 
            <p class="error">{{ $message }}</p> 
        @enderror
    </div>
</div>

            <!-- お問い合わせ内容 -->
<div class="form-group">
        <label>お問い合わせ内容 <span class="required">※</span></label>
        <textarea name="inquiry_content" placeholder="お問い合わせ内容をご記載ください">{{ old('content') }}</textarea>
    <div class="error-message">
        @error('content') 
            <p class="error">{{ $message }}</p> 
        @enderror
    </div>
</div>

            <!-- 確認画面へ -->
            <div class="form-group">
                <button type="submit">確認画面</button>
            </div>
        </form>
    </div>
</body>
