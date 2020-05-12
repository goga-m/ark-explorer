<tr>
    <td scope="row" data-label="Rank">
        <div class="truncate">{{ $formatted['rank'] }}</div>
    </td>

    <td scope="row" data-label="Username">
        <div class="truncate"><a class="link" href="{{ $formatted['path'] }}" title="{{ $formatted['address']}}">{{ $formatted['username'] }}</a></div>
    </td>

    <td scope="row" data-label="Forged blocks">
        <div class="truncate">{{ $formatted['forgedBlocks'] }}</div>
    </td>

    <td scope="row" data-label="Last forged">
        <div class="truncate">{{ $formatted['lastForged'] }}</div>
    </td>

    <td scope="row" data-label="Status">
        <div class="truncate">{{ $formatted['status'] }}</div>
    </td>

    <td scope="row" data-label="Votes" class="text-right">
        <div class="whitespace-no-wrap">{{ $formatted['votes'] }} Ѧ</div>
    </td>

</tr>
