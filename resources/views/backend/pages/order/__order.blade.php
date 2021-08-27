<h4>Информация о заказе</h4>
<table class="table table-striped table-bordered datatable mb-0">
    <tbody>
        @include('backend.pages.partials.tr-text', ['data' => "№$object->code", 'locale' => 'fields.code', 'tr' => 'text'])
        @include('backend.pages.partials.tr-text', ['data' => "$object->city", 'locale' => 'fields.city', 'tr' => 'text'])
        @include('backend.pages.partials.tr-text', ['data' => $object->date, 'locale' => 'fields.date', 'tr' => 'text'])
        @include('backend.pages.partials.tr-text', ['data' => $object->time, 'locale' => 'fields.time', 'tr' => 'text'])
        @include('backend.pages.partials.tr-text', ['data' => $object->delivery, 'locale' => 'fields.delivery', 'tr' => 'text'])
        <tr>
            <th class="align-middle">@lang('fields.status')</th>
            <td>
                {!! Form::select('status', $statuses, $object->status ?? old('status'), ['class' => 'form-control', 'id' => 'delivery-status', 'data-id' => $object->id]) !!}
            </td>
        </tr>
    </tbody>
</table>
