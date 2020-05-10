<?php
Route::group([
    'prefix'     => 'reg_team',
    'namespace' => 'MasterData',
], function()
{
    Route::resource('reg_team', 'TeamController');
    Route::get('getData_teams', 'TeamController@getData_teams')->name('reg_team.getData_teams');
});
