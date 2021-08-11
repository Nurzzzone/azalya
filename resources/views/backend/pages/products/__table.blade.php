<table @class(['table-hover' => $products->isNotEmpty(), 'table table-responsive-sm table-bordered border-top-0 mb-0'])>
    <thead>
    <tr>
        <th class="border-bottom-0 align-middle">ID</th>
        <th class="border-bottom-0 align-middle">@lang('fields.name')</th>
        <th class="border-bottom-0 align-middle">@lang('fields.price')</th>
        <th class="border-bottom-0 align-middle">@lang('fields.in_stock')</th>
        <th class="border-bottom-0 align-middle">@lang('buttons.default')</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr data-name="tableRow" data-href="{{ route('backend.products.show', $product->id) }}">
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}тг</td>
                <td>{{ $product->in_stock? 'В наличии': 'Нет в наличии' }}</td>
                <td>
                    <div class="btn-group d-flex">
                        <a href="{{ route('backend.products.edit', $product->id) }}" class="btn btn-outline-dark">
                            @lang('buttons.edit')</a>
                        <button type="button" 
                            data-toggle="modal" 
                            data-name="deleteModalButton"
                            data-target="{{ $product->id }}"
                            class="btn btn-outline-dark">@lang('buttons.delete')</button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>