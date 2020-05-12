<div>
    <span wire:init="fetchWallet">
        @if ($status === 'Loading')
            <a class="link" href="/wallet/{{ $publicKey }}" title="{{ $publicKey }}"><span class="skeleton" style="display: inline-block; width:40px"></span></a>
        @else
            @if (isset($username))
                <a class="link" href="/wallet/{{ $publicKey }}" title="{{ $publicKey }}">{{ $username}}</a>
            @else
                <a class="link" href="/wallet/{{ $publicKey }}" title="{{ $publicKey }}"> {{ $publicKey }}</a>
            @endif
        @endif
    </span>
</div>
