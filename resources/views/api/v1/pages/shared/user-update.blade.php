<tr>
    <td colspan="2">
        <span class="lead font-weight-bold">Обноваление пользователя</span>
    </td>
</tr>
<tr>
    <td colspan="2">
        <div class="row">
            @include('api.v1.shared.request', ['method' => 'POST', 'endpoint' => 'api/v1/user', 'params' => [
                ['name' => 'name', 'type' => 'string', 'required' => true, 'description' => 'ФИО пользователя'], 
                ['name' => 'phone_number', 'type' => 'string', 'required' => true, 'description' => 'Номер телефона пользователя'], 
                ['name' => 'email', 'type' => 'string', 'required' => true, 'description' => 'Почта пользователя'],
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