<h4 class="mt-4">Получатель</h4>
<table class="table table-striped table-bordered datatable mb-0">
    <tbody>
        @include('backend.pages.partials.tr-text', ['data' => $object->reciever->name, 'locale' => 'fields.fullname', 'tr' => 'text'])
        @include('backend.pages.partials.tr-text', ['data' => $object->reciever->phone_number, 'locale' => 'fields.phone_number', 'tr' => 'text'])
        @include('backend.pages.partials.tr-text', ['data' => $object->reciever->email, 'locale' => 'fields.email_address', 'tr' => 'text'])
        @include('backend.pages.partials.tr-text', ['data' => $object->reciever->comment, 'locale' => 'fields.order.comment', 'tr' => 'textarea'])
    </tbody>
</table>