<?php

namespace App\Traits;

trait HasFlashMessage
{
    public function flashSuccessMessage($request, $route, $message = null)
    {
        $request->session()->flash('message', $message ?? "Операция выполнена успешно!");
        return redirect()
            ->route($route);
    }

    public function flashErrorMessage($request, $exception, $message = null)
    {
        if (!config('app.debug')) {
            $request->session()->flash('message', "Произошла ошибка!");
            return redirect()
                ->back();
        }
        throw new \Exception($exception->getMessage());
    }
}
