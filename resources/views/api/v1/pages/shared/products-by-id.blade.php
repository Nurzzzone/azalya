<tr>
    <td colspan="2">
        <span class="lead font-weight-bold">Получить список продуктов по ID</span>
    </td>
</tr>
<tr>
    <td colspan="2">
        <div class="row">
            @include('api.v1.shared.request', ['method' => 'POST', 'endpoint' => 'api/v1/products/get', 'params' => [
                ['name' => 'products', 'type' => 'array', 'required' => true, 'description' => 'ID продуктов'], 
            ]])
            <div class="col-6 border-left">
                @include('api.v1.shared.response', ['response' => [
                    ['name' => 'message', 'message' => '"Операция прошла успешно!"'],
                    ['name' => 'status', 'message' => 200]
                ]])
            </div>
        </div>
    </td>
</tr>