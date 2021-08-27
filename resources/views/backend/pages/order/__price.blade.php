<table class="table table-striped table-bordered datatable mb-0 mt-4">
    <tbody>
        @include('backend.pages.partials.tr-text', ['data' => "$object->total_price тг", 'locale' => 'fields.total_price', 'tr' => 'text'])
    </tbody>
</table>