<table class="table table-striped table-bordered datatable">
    <tbody>
        @include('backend.pages.partials.input', ['input' => 'text', 'field' => "fullname", 'current_value' => $object->fullname,'locale' => 'fields.fullname'])
        @include('backend.pages.partials.input', ['input' => 'text', 'field' => "position", 'current_value' => $object->position,'locale' => 'fields.position'])
        @include('backend.pages.partials.image-field', ['current_image' => $object->image])
        @include('backend.pages.partials.active')
    </tbody>
</table>