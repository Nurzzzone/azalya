<table class="table table-striped table-bordered datatable">
    <tbody>
        @include('backend.pages.partials.input', ['input' => 'text', 'field' => "name", 'current_value' => $object->name,'locale' => 'fields.name'])
        @include('backend.pages.partials.active', ['field' => 'in_homepage', 'locale' => 'fields.in_homepage', 'on' => 'in_homepage', 'off' => 'not_in_homepage'])
    </tbody>
</table>