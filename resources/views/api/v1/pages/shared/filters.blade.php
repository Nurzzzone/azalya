<tr>
    <td colspan="2">
        <span class="lead font-weight-bold">Список фильтров</span>
    </td>
</tr>
<tr>
    <td colspan="2">
        <div class="row">
            @include('api.v1.shared.request', ['method' => 'GET', 'endpoint' => 'api/v1/products/filter'])
            <div class="col-6 border-left">
                @include('api.v1.shared.response', ['response' => [
                    ['name' => 'message', 'message' => '"Операция прошла успешно!"'],
                    ['name' => 'status', 'message' => 200]
                ]])
            </div>
        </div>
    </td>
</tr>