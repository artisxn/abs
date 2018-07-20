<footer>
    <nav class="uk-navbar-container" uk-navbar>
        <div class="uk-navbar-left">
            <a href="{{ route('index') }}" class="uk-navbar-item uk-logo">{{ config('app.name') }}</a>

            <ul class="uk-navbar-nav">
                <li><a href="{{ route('index') }}">ホーム</a></li>
                <li><a href="{{ route('browselist') }}">ブラウズリスト</a></li>
                <li><a href="{{ route('docs.api') }}">API</a></li>
                @feature('privacy')
                <li><a href="{{ route('privacy') }}">プライバシーポリシー</a></li>
                @endfeature
                {{--<li><a href="https://goo.gl/forms/PPiy2lJ55F9r5VI92" target="_blank" rel="noopener nofollow">問い合わせフォーム</a></li>--}}
            </ul>
        </div>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <li>
                    <a href="#" uk-totop uk-scroll></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="uk-text-center uk-margin-bottom">
        <a href="https://abs.kawax.biz/" class="uk-button uk-button-text" target="_blank" rel="noopener">©ABS</a>
    </div>
</footer>
