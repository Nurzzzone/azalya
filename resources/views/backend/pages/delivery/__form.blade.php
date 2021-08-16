<table class="table table-striped table-bordered datatable">
    <tbody>
        @include('backend.pages.partials.input', ['input' => 'text', 'field' => "title", 'current_value' => $object->title,'locale' => 'fields.title'])
        @include('backend.pages.partials.image-field', ['current_image' => $object->image])
        @include('backend.pages.partials.input', ['input' => 'text', 'field' => "description_title", 'current_value' => $object->description_title,'locale' => 'fields.description_title'])
        @include('backend.pages.partials.textarea', ['field' => "description",'current_value' => $object->description])
        @include('backend.pages.partials.input', ['input' => 'text', 'field' => "price_title", 'current_value' => $object->price_title, 'locale' => 'fields.payment_title'])
        @include('backend.pages.partials.textarea', ['field' => "price", 'current_value' => $object->price, 'locale' => 'fields.payment'])
    </tbody>
</table>