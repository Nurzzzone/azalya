<table class="table table-striped table-bordered datatable">
    <tbody>
        @include('backend.pages.partials.input', ['input' => 'text', 'field' => "name", 'current_value' => $product->name,'locale' => 'fields.name'])
        @include('backend.pages.partials.input', ['input' => 'number', 'field' => "price", 'current_value' => $product->price, 'locale' => 'fields.price'])
        @include('backend.pages.partials.input', ['input' => 'number', 'field' => "discount", 'current_value' => $product->discount, 'locale' => 'fields.discount'])
        @include('backend.pages.partials.select', ['field' => 'category_id', 'select_options' => $categories, 'default' => $product->category->id ?? null, 'locale' => 'fields.category'])
        @include('backend.pages.partials.image-field', ['current_image' => $product->image])
        @include('backend.pages.partials.textarea', ['field' => "description",'current_value' => $product->description])
        @include('backend.pages.partials.checkbox', ['field' => 'format', 'locale' => 'fields.format', 'chosen' => $product->formats, 'items' => $formats])
        @include('backend.pages.partials.checkbox', ['field' => "size", 'locale' => 'fields.size', 'chosen' => $product->sizes, 'items' => $sizes])
        @include('backend.pages.partials.active')
        @include('backend.pages.partials.active', ['field' => 'in_stock', 'locale' => 'fields.in_stock', 'on' => 'in_stock', 'off' => 'not_in_stock'])
        @include('backend.pages.partials.active', ['field' => 'is_popular', 'locale' => 'fields.is_popular', 'on' => 'is_popular', 'off' => 'not_is_popular'])
        @include('backend.pages.partials.active', ['field' => 'in_homepage', 'locale' => 'fields.in_homepage', 'on' => 'in_homepage', 'off' => 'not_in_homepage'])
    </tbody>
</table>