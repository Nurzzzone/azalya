<tr>
    <td colspan="2">
        <span class="lead d-block">Смена категории</span>
    </td>
</tr>
<tr>
    <td colspan="2">
        <div class="row">
            @include('api.v1.shared.request', ['method' => 'GET', 'endpoint' => 'api/v1/categories/:category_slug'])
            <div class="col-6 border-left">
                @include('api.v1.shared.response', ['response' => [
                    ['name' => 'message', 'message' => '"Операция прошла успешно!"'],
                    ['name' => 'status', 'message' => 200],
                    ['name' => 'products', 'message' => '[...]']
                ]])
            </div>
        </div>
    </td>
</tr>