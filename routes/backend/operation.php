<?php
Route::group([
    'prefix'     => 'operation',
    'namespace' => 'MasterData',
], function()
{

    Route::resource('operation', 'OperationController');
    Route::get('generateSchedule', 'OperationController@generateSchedule')->name('operation.generateSchedule');
    Route::get('matchScheduleView', 'OperationController@matchScheduleView')->name('operation.matchScheduleView');
    Route::get('getData_matchSchedule', 'OperationController@getData_matchSchedule')->name('operation.getData_matchSchedule');
    Route::get('addPointsView/{id}', 'OperationController@addPointsView')->name('operation.addPointsView');
    Route::post('addPoints', 'OperationController@addPoints')->name('operation.addPoints');

});
