<?php

namespace App\Listeners;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\PermissionException;

class ModelChangeListener
{
    public function handle(Model $model)
    {
        if (!auth()->user()->can('update', $model)) {
            throw new PermissionException('Insufficient permissions to update the model.');
        }

        $model->active = false;
        $model->save();
    }
}
