<table class="table table-striped table-bordered datatable">
    <tbody>
        @include('backend.pages.partials.input', ['input' => 'text', 'field' => "name", 'current_value' => $object->name,'locale' => 'fields.name'])
        @include('backend.pages.partials.image-field', ['current_image' => $object->image])
        @include('backend.pages.partials.textarea', ['field' => "value",'current_value' => $object->value])
    </tbody>
</table>