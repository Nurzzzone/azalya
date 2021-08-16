<table class="table table-striped table-bordered datatable">
    <tbody>
        @include('backend.pages.partials.input', ['input' => 'text', 'field' => "name", 'current_value' => $object->name,'locale' => 'fields.name'])
        @include('backend.pages.partials.image-field', ['current_image' => $object->image])
        @include('backend.pages.partials.active', ['field' => 'in_homepage', 'locale' => 'fields.in_homepage', 'on' => 'in_homepage', 'off' => 'not_in_homepage'])
        @include('backend.pages.partials.active', ['field' => 'in_about', 'locale' => 'fields.in_about', 'on' => 'in_about', 'off' => 'not_in_about'])
        @include('backend.pages.partials.active', ['field' => 'in_product', 'locale' => 'fields.in_product', 'on' => 'in_product', 'off' => 'not_in_in_product'])
    </tbody>
</table>