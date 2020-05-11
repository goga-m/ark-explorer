<div>
    <table class="table table-fixed">
        <thead>
            <tr>
                @foreach ($columnLabels as $label => $classes)
                    <th scope="col" class="{{ $classes }}">{{ $label }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < $limit; $i++)
                <tr>
                @foreach ($columnLabels as $label => $classes)
                        <td scope="row" data-label="{{ $label }}"><div class="skeleton"></div></td>
                    @endforeach
                </tr>
            @endfor
        </tbody>
    </table>
</div>
