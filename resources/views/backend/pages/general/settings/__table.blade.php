<table @class(['table-hover' => $objects->isNotEmpty(), 'table table-responsive-sm table-bordered border-top-0 mb-0'])>
    <thead>
    <tr>
        @foreach ($columns as $column)
            <th class="border-bottom-0 align-middle">@lang("fields.$column")</th>
        @endforeach
        <th class="border-bottom-0 align-middle">@lang('buttons.default')</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($objects as $object)
            <tr data-name="tableRow" data-href="{{ route("backend.$route.show", $object->id) }}">
                @foreach ($columns as $column)
                    <td>{!! $object->$column !!}</td>
                @endforeach
                <td>
                    <div class="btn-group d-flex">
                        <a href="{{ route("backend.$route.edit", $object->id) }}" class="btn btn-outline-dark">
                            @lang('buttons.edit')</a>
                        <button type="button" 
                            data-toggle="modal" 
                            data-name="deleteModalButton"
                            data-target="{{ $object->id }}"
                            class="btn btn-outline-dark">@lang('buttons.delete')</button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>