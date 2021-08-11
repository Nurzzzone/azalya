<tr>
    <th class="align-middle">@lang($locale ?? 'fields.title')
        @isset($required)
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        @endisset
    </th>
    @php
        $options = [
            'class'       => ['form-control', $errors->has($field)? 'border-danger' : ''],
            'required'    => $required ?? false,
            'placeholder' => trans($locale ?? 'title')
        ];
    @endphp
    <td>{{ Form::$input($field, $current_value ?? old($field), $options) }}</td>
</tr>
