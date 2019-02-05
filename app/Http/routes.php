<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home'
]);

Route::auth();

Route::get('/home', 'HomeController@index');

Route::resource('cadre', 'CadreController');

Route::resource('personnel', 'PersonnelController');

Route::resource('district', 'DistrictController');

Route::resource('subdistrict', 'SubDistrictController');

Route::resource('facility', 'FacilityController');

Route::resource('survey', 'SurveyController');

Route::post('/end_wizard', 'ApiController@endWizard');

Route::post('/save_survey_summary', 'ApiController@saveSurveySummary');

Route::post('/save_stock_management', 'ApiController@saveStockManagement');

Route::post('/get_stock_management', 'ApiController@getStockManagement');

Route::post('/save_storage_management', 'ApiController@saveStorageManagement');

Route::post('/get_storage_management', 'ApiController@getStorageManagement');

Route::post('/save_ordering', 'ApiController@saveOrdering');

Route::post('/get_ordering', 'ApiController@getOrdering');

Route::post('/save_equipment', 'ApiController@saveEquipment');

Route::post('/get_equipment', 'ApiController@getEquipment');

Route::post('/save_info_system', 'ApiController@saveLabInfoSystem');

Route::post('/get_info_system', 'ApiController@getLabInfoSystem');

Route::post('/get_indicator_scores', 'ApiController@dashboardIndicatorScores');

Route::post('/get_sub_districts', 'ApiController@getSubDistrict');

Route::post('/get_facility_list', 'ApiController@getFacilityList');

Route::post('/get_facility_info', 'ApiController@getFacilityInfo');

Route::post('/get_facility_personnel', 'ApiController@getFacilityPersonnel');

Route::get('/get_cadre_list', 'ApiController@getCadreList');

Route::get('/get_personnel_list', 'ApiController@getPersonnelList');

Route::get('/reports/visit/summary', [
    'as' => 'visit.summary', 'uses' => 'ReportsController@getSurveySummary'
]);

Route::get('/reports/visit/summaryToScreen', [
    'as' => 'visit.summary.screen', 'uses' => 'ReportsController@surveySummaryReport'
]);

Route::get('/reports/visit/summaryToExcel', [
    'as' => 'visit.summary.excel', 'uses' => 'ReportsController@surveySummaryReportToExcel'
]);

Route::get('/reports/visit/scores', [
    'as' => 'visit.scores', 'uses' => 'ReportsController@getScoreSummary'
]);

Route::get('/reports/visit/scoresToScreen', [
    'as' => 'visit.scores.screen', 'uses' => 'ReportsController@scoreSummaryReport'
]);

Route::get('/reports/visit/scoresToExcel', [
    'as' => 'visit.scores.excel', 'uses' => 'ReportsController@scoreSummaryReportToExcel'
]);

Route::get('/reports/visit/individual/summary', [
    'as' => 'visit.individual.summary', 'uses' => 'ReportsController@individualSurveySummaryReport'
]);

Route::get('/reports/extract/indicator', [
    'as' => 'reports.extract.indicator', 'uses' => 'ReportsController@extractIndicatorReport'
]);


Route::get('/reports/extract/audit', [
    'as' => 'reports.extract.audit', 'uses' => 'ReportsController@extractAuditTrailReport'
]);

Route::get('auditDTable', 'ReportsController@auditDTable');

Route::get('scoresDTable', 'ReportsController@scoresDTable');

Route::get('surveyDTable', 'ReportsController@surveyDTable');

Route::get('/reports/visit/edit/{id?}', [
    'as' => 'visit.edit', 'uses' => 'ReportsController@editVisit'
]);

Route::post('/reports/visit/update', [
    'as' => 'visit.update', 'uses' => 'ReportsController@updateSummary'
]);

Route::post('/reports/visit/delete', [
    'as' => 'visit.delete', 'uses' => 'ReportsController@deleteVisit'
]);

Route::post('/get_districts_by_region', 'ApiController@getDistrictsByRegion');

Route::post('/get_sub_districts_by_region', 'ApiController@getSubDistrictsByRegion');

Route::post('/get_ownership_by_region', 'ApiController@getOwnershipByRegion');

Route::post('/get_level_by_region', 'ApiController@getLevelByRegion');

Route::post('/get_facility_by_region', 'ApiController@getFacilityByRegion');

Route::resource('user', 'UserController');

Route::get('/user/password/{id?}', [
    'as' => 'user.password', 'uses' => 'UserController@getPassword'
]);

Route::post('updatePassword','UserController@updatePassword');

Route::post('/reports/extract/indicatorToExcel', [
    'as' => 'reports.extract.indicatorToExcel', 'uses' => 'ReportsController@extractIndicatorToExcelReport'
]);

Route::get('/performance', [
    'uses' => 'HomeController@facilityPerformance',
    'as' => 'home.performance'
]);

Route::get('/league', [
    'uses' => 'HomeController@leagueTable',
    'as' => 'home.league'
]);


Route::get('/survey/partial/{id?}', [
    'as' => 'survey.partial', 'uses' => 'SurveyController@editPartial'
]);

Route::get('/survey/transfer/{id?}', [
    'as' => 'survey.transfer', 'uses' => 'SurveyController@getTransfer'
]);

Route::post('/saveTransfer', [
    'as' => 'survey.saveTransfer', 'uses' => 'SurveyController@saveTransfer'
]);