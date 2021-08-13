@if ($tr === 'text')
    <tr>
        <th class="align-middle">{{ trans_choice($locale, $prular ?? 1)}}</th>
        <td class="{{ $data !== null? '': 'text-muted' }}">{{ $data ?? trans('messages.data.unavailable') }}</td>
    </tr>
@elseif ($tr === 'url')
<tr>
    <th class="align-middle">@lang($locale)</th>
    <td class="{{ $data !== null? '': 'text-muted' }}">
        <a href="{{ $data !== null? '': 'disabled' }}">{{ $data ?? trans('messages.data.unavailable') }}</a>
    </td>
</tr>
@else 
    <tr>
        <th class="align-start">@lang($locale)</th>
        <td class="{{ $data !== null? '': 'text-muted' }}">{!! $data ?? trans('messages.data.unavailable') !!}</td>
    </tr>
@endif