<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdatePasswordRequest;

class UserController extends Controller
{
    use HasFlashMessage;

    protected const PASSWORD_UPDATED = 'Пароль успешно обновлен!';

    /**
     * @param User $user
     * @param UpdatePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $user, UpdatePasswordRequest $request)
    {
        try {
            $user->update($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, null, self::PASSWORD_UPDATED);
    }
}
