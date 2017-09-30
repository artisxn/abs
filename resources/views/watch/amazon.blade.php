<div class="uk-alert-danger" uk-alert>
  <p>
    <a href="{{ route('login') }}" rel="nofollow">
      <i class="fa fa-amazon" aria-hidden="true"></i>
      Amazonアカウントでログイン</a>するとウォッチリストに追加等の機能が使えます。
  </p>
  <p>
    <a href="{{ route('login') }}" rel="nofollow">
      <img src="{{ config('amazon.login_button_img') }}"
           height="46"
           width="195"
           alt="Login with Amazon">
    </a>
  </p>
</div>
