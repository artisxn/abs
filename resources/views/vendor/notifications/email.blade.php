@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# Whoops!
@else
# Hello!
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@endif

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
"{{ $actionText }}" ボタンから表示できない場合は以下のURLをコピー＆ペーストしてください。：
[{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent

@component('mail::subcopy')
メール送信の解除は設定ページからできます：
[{{ route('settings.index') }}]({{ route('settings.index') }})
@endcomponent

@endisset
@endcomponent
