<tr>
    <!-- Transasction template for table listing  -->

    <td scope="row" data-label="ID">
        <div class="truncate"><a class="link" href="{{ $tx['path'] }}" title="{{ $tx['id']}}">{{ $tx['id'] }}</a></div>
    </td>

    <td scope="row" data-label="Timestamp">
        <div class="truncate">{{ $tx['timestamp'] }}</div>
    </td>

    <td scope="row" data-label="Sender">
        <div class="truncate"><a class="link" href="{{ $tx['senderPath'] }}" title="{{ $tx['senderAddress']}}">{{ $tx['senderAddress'] }}</a></div>
    </td>

    <td scope="row" data-label="Recipient">
        <div class="truncate"><a class="link" href="{{ $tx['recipientPath'] }}" title="{{ $tx['recipientAddress']}}">{{ $tx['recipientAddress'] }}</a></div>
    </td>

    <td scope="row" data-label="SmartBridge" class="text-right">
        <div class="truncate">{{ $tx['vendorField'] }}</div>
    </td>

    <td scope="row" data-label="Amount" class="text-right">
        <div class="truncate">
            {{ $tx['amount'] }}
            <span>Ѧ</span>
        </div>
    </td>

    <td scope="row" data-label="Fee" class="text-right">
        <div class="truncate">
            {{ $tx['fee'] }}
            <span>Ѧ</span>
        </div>
    </td>

</tr>
