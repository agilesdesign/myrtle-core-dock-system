<?php

Route::get('system/information', [
    'uses' => \Myrtle\Core\System\Http\Controllers\Administrator\SystemInformationController::class . '@index',
    'as' => 'system.information.index'
]);