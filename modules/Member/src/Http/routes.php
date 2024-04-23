<?php


use Illuminate\Support\Facades\Route;
use Modules\Member\Http\Controllers\MemberController;

Route::controller(MemberController::class)
    ->prefix('members')
    ->name('members.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('{member_id}', 'show')->name('show');
        Route::post('', 'store')->name('store');
        Route::put('{member_id}', 'update')->name('update');
        Route::delete('{member_id}', 'destroy')->name('destroy');
        Route::post('{member_id}/member_tag/{member_tag_id}/link', 'attachMemberTag')->name('memberTag.link');
    });

