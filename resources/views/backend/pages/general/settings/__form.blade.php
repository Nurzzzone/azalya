<table class="table table-striped table-bordered datatable">
    <tbody>
        @include('backend.pages.partials.image-field', ['current_image' => $object->image])
        @include('backend.pages.partials.input', ['input' => 'text', 'field' => "name", 'current_value' => $object->name,'locale' => 'fields.name'])
        @include('backend.pages.partials.input', ['input' => 'text', 'field' => "phone_number", 'current_value' => $object->phone_number,'locale' => 'fields.phone_number'])
        @include('backend.pages.partials.input', ['input' => 'url', 'field' => "whatsapp", 'current_value' => $object->whatsapp,'locale' => 'fields.whatsapp'])
        @include('backend.pages.partials.input', ['input' => 'url', 'field' => "facebook", 'current_value' => $object->facebook,'locale' => 'fields.facebook'])
        @include('backend.pages.partials.input', ['input' => 'url', 'field' => "instagram", 'current_value' => $object->instagram,'locale' => 'fields.instagram'])
    </tbody>
</table>