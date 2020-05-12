<tr>
    <!-- Wallet template for wallet listing  -->

    <td scope="row" data-label="Address">
        <div class="truncate"><a class="link" href="{{ $formatted['path'] }}" title="{{ $formatted['address']}}">{{ $formatted['address'] }}</a></div>
    </td>

    <td scope="row" data-label="Public Key">
        <div class="truncate">
            <a class="link" href="{{ $formatted['path'] }}" title="{{ $formatted['publicKey']}}">{{ $formatted['publicKey'] }}</a>
        </div>
    </td>

    <td scope="row" data-label="Balance" class="text-right">
        <div class="truncate">
            {{ $formatted['balance'] }}
            <span>Ѧ</span>
        </div>
    </td>

</tr>
