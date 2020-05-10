<?php
Route::group([
    'prefix'     => 'tournament',
    'namespace' => 'MasterData',
], function()
{

    Route::resource('tournament', 'TournamentController');
    Route::get('getData_tournaments', 'TournamentController@getData_tournaments')->name('tournament.getData_tournaments');

});
