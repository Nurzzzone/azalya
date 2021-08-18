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
                    <td>{{ $object->$column }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>