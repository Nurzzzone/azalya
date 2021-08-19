<tr>
    <td colspan="2">
        <span class="lead font-weight-bold">Фильтрация продуктов</span>
    </td>
</tr>
<tr>
    <td colspan="2">
        <div class="row">
            @include('api.v1.shared.request', ['method' => 'POST', 'endpoint' => 'api/v1/products/filter', 'params' => [
                ['name' => 'category', 'type' => 'string', 'required' => true, 'description' => 'Имя категорий(slug)'], 
                ['name' => 'price_from', 'type' => 'int', 'required' => false, 'description' => 'Цена от'], 
                ['name' => 'price_to', 'type' => 'int', 'required' => false, 'description' => 'Цена до'], 
                ['name' => 'type', 'type' => 'string', 'required' => false, 'description' => 'Название типа(slug)'], 
                ['name' => 'format', 'type' => 'string', 'required' => false, 'description' => 'Название офромления(slug)'], 
                ['name' => 'size', 'type' => 'string', 'required' => false, 'description' => 'Название размера(slug)'], 
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