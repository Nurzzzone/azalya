<table @class(['table-hover' => $objects->isNotEmpty(), 'table table-responsive-sm table-bordered border-top-0 mb-0'])>
    <thead>
    <tr>
        @foreach ($columns as $column)
            <th class="border-bottom-0 align-middle">@lang("fields.$column")</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach ($objects as $object)
            <tr data-name="tableRow" data-href="{{ route("backend.{$route}s.show", $object->id) }}">
                @foreach ($columns as $column)
                @if ($column == 'status')
                    @php
                        switch($object->$column) {
                            case 'Оформлен':    $textColor = 'text-primary'; break;
                            case 'В обработке': $textColor = 'text-info';    break;
                            case 'Отправлен':   $textColor = 'text-warning'; break;
                            case 'Доставлено':  $textColor = 'text-success'; break;
                            default: $textColor = null;
                        }
                    @endphp
                    <td class="{{ $textColor  }}">{{ $object->$column }}</td>
                @else 
                    <td>{{ $object->$column }}</td>
                @endif
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>