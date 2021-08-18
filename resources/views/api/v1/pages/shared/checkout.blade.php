<tr>
    <td colspan="2">
        <span class="lead d-block">Оформление заказа</span>
    </td>
</tr>
<tr>
    <td colspan="2">
        <div class="row">
            @include('api.v1.shared.request', ['method' => 'POST', 'endpoint' => 'api/v1/checkout', 'params' => [
                ['name' => 'city', 'type' => 'string', 'required' => true, 'description' => 'Город'], 
                ['name' => 'date', 'type' => 'date', 'required' => true, 'description' => 'Дата доставки'], 
                ['name' => 'time', 'type' => 'string', 'required' => true, 'description' => 'Время доставки'], 
                ['name' => 'delivery', 'type' => 'string', 'required' => true, 'description' => 'Способ доставки'], 
                ['name' => 'comment', 'type' => 'string', 'required' => true, 'description' => 'Комментарий к заказу'], 
                ['name' => 'total_price', 'type' => 'int', 'required' => true, 'description' => 'Общая сумма'],
                ['name' => 'reciever[name]', 'type' => 'string', 'required' => true, 'description' => 'Имя получателя'], 
                ['name' => 'reciever[phone_number]', 'type' => 'string', 'required' => true, 'description' => 'Номер телефона получателя'], 
                ['name' => 'reciever[email]', 'type' => 'string', 'required' => true, 'description' => 'Почта получателя'], 
                ['name' => 'products[*][id]', 'type' => 'int', 'required' => true, 'description' => 'ID продукта'], 
                ['name' => 'products[*][count]', 'type' => 'int', 'required' => true, 'description' => 'Кол-во продукта'], 
                ['name' => 'products[*][size]', 'type' => 'string', 'required' => true, 'description' => 'Размер продукта'], 
                ['name' => 'products[*][format]', 'type' => 'string', 'required' => true, 'description' => 'Оформление продукта'], 
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