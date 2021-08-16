<tr>
    <td colspan="2">
        <span class="lead d-block">Регистрация</span>
    </td>
</tr>
<tr>
    <td colspan="2">
        <div class="row">
            @include('api.v1.shared.request', ['method' => 'POST', 'endpoint' => 'api/v1/auth/register', 'params' => [
                ['name' => 'name', 'type' => 'string', 'required' => true, 'description' => 'ФИО пользователя'], 
                ['name' => 'phone_number', 'type' => 'string', 'required' => true, 'description' => 'Номер телефона пользователя (required if email is null)'], 
                ['name' => 'email', 'type' => 'string', 'required' => true, 'description' => 'Почта пользователя (required if phone_number is null)'],
                ['name' => 'password', 'type' => 'string', 'required' => true, 'description' => 'Пароль который придумал пользователь']]])
            <div class="col-6 border-left">
                @include('api.v1.shared.response', ['response' => [
                    ['name' => 'message', 'message' => '"Регистрация прошла успешно!"'],
                    ['name' => 'status', 'message' => 200]
                ]])
            </div>
        </div>
    </td>
</tr>