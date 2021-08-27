<h4 class="mt-4">Товары ({{ $order->count }})</h4>
@foreach ($order->products as $product)
<table @class(['mt-2' => !$loop->first, 'table table-striped table-bordered datatable mb-0'])>
    <tbody>
        @include('backend.pages.partials.tr-text', ['data' => $product->id, 'locale' => 'fields.id', 'tr' => 'text'])
        @include('backend.pages.partials.tr-image', ['image' => $product->image])
        @include('backend.pages.partials.tr-text', ['data' => $product->name, 'locale' => 'fields.name', 'tr' => 'text'])
        @include('backend.pages.partials.tr-text', ['data' => $product->category->name, 'locale' => 'fields.category', 'tr' => 'text'])
        @include('backend.pages.partials.tr-text', ['data' => "$product->price тг", 'locale' => 'fields.price', 'tr' => 'text'])
        @include('backend.pages.partials.tr-text', ['data' => $product->discount, 'locale' => 'fields.discount', 'tr' => 'text'])
        @include('backend.pages.partials.tr-text', ['data' => $product->count, 'locale' => 'fields.count', 'tr' => 'text'])
        @include('backend.pages.partials.tr-text', ['data' => $product->size, 'locale' => 'fields.size', 'tr' => 'text'])
        @include('backend.pages.partials.tr-text', ['data' => $product->format, 'locale' => 'fields.format', 'tr' => 'text'])
        @include('backend.pages.partials.tr-text', ['data' => $product->type->name, 'locale' => 'fields.type', 'tr' => 'text'])
        @include('backend.pages.partials.tr-route', ['name' => __('fields.product.link'), 
            'route' => route('backend.products.show', $product->id),
            'colspan' => 2
        ])
    </tbody>
</table>
@if (!$loop->last)
    <hr>
@endif
@endforeach