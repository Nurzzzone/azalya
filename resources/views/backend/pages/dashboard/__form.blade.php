<table class="table table-bordered datatable">
    <tbody>
        @include('backend.pages.partials.input', ['disabled' => true, 'input' => 'email', $current_value = Auth::user()->email, 'locale' => 'fields.email_address', 'field' => 'email', 'required' => false])
        @include('backend.pages.partials.password', ['locale' => 'fields.password.old'])
        @include('backend.pages.partials.password', ['input' => 'text', 'locale' => 'fields.password.new', 'field' => 'new_password'])
    </tbody>
</table>