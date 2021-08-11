<table class="table table-striped table-bordered datatable">
    <tbody>
        @include('backend.pages.partials.input', ['input' => 'text', 'field' => "name", 'current_value' => $object->name,'locale' => 'fields.name'])
    </tbody>
</table>