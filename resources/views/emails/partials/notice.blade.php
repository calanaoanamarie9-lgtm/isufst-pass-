<div style="margin-top:22px;padding:16px 18px;border-radius:10px;background-color:{{ $bg }};border-left:4px solid {{ $border }};">
    <div style="font-size:11px;font-weight:bold;letter-spacing:1.5px;color:{{ $title }};margin-bottom:8px;">
        {{ $titleText }}
    </div>
    <div style="font-size:13px;line-height:1.8;color:#374151;">
        {!! $slot !!}
    </div>
</div>
