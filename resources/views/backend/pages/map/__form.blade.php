<table class="table table-striped table-bordered datatable">
    <tbody>
        <tr>
            <th class="align-start">{{ trans('fields.map')}}</th>
            <td class="{{ $object->value !== null? '': 'text-muted' }}">
                {!! Form::textarea('value', $object->value ?? old('value'), ['class' => 'form-control',]) !!}
            </td>
        </tr>
    </tbody>
</table>