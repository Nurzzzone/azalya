<tr>
    <td colspan="2">
        <span class="lead font-weight-bold">Вход в личный кабинет</span>
    </td>
</tr>
<tr>
    <td colspan="2">
        <div class="row">
            @include('api.v1.shared.request', ['method' => 'POST', 'endpoint' => 'api/v1/auth/login', 'params' => [
                ['name' => 'phone_number', 'type' => 'string', 'required' => true, 'description' => 'Номер телефона пользователя (required if email is null)'], 
                ['name' => 'email', 'type' => 'string', 'required' => true, 'description' => 'Почта пользователя (required if phone_number is null)'],
                ['name' => 'remember', 'type' => 'bool', 'required' => true, 'description' => 'Запомнить меня (default: false)'],
                ['name' => 'password', 'type' => 'string', 'required' => true, 'description' => 'Пароль']]])
            <div class="col-6 border-left">
                @include('api.v1.shared.response', ['response' => [
                    ['name' => 'message', 'message' => '"Авторизация прошла успешно!"'],
                    ['name' => 'status', 'message' => 200]
                ]])
            </div>
        </div>
    </td>
</tr>