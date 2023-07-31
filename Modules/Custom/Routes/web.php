<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::prefix('custom')->group(function() {
    Route::get('/', 'CustomController@index');
});

Route::middleware(['auth', 'verified', 'activity'])->prefix('dashboard')->name('dashboard.')->group(function() {
    Route::resource('cases', 'CaseController');
    Route::get('cases/{id}/information-requests', 'CaseController@getInformationRequests')->name('cases.information-requests');
    Route::get('cases/{id}/case-contributors', 'CaseController@getCaseContributors')->name('cases.case-contributors');
    Route::get('cases/{id}/case-coordinators', 'CaseController@getCaseCoordinators')->name('cases.case-coordinators');

    Route::resource('case-management', 'CaseController');

    Route::resource('case-contributors', 'CaseContributorController');
    Route::resource('case-coordinators', 'CaseCoordinatorController');
    Route::resource('case-findings', 'CaseFindingController');
    Route::resource('case-investigations', 'CaseInvestigationController');

    Route::resource('organizations', 'OrganizationController');
    Route::get('organizations/{id}/cases', 'OrganizationController@getCases')->name('organizations.cases');
    Route::get('organizations/{id}/information-requests', 'OrganizationController@getInformationRequests')->name('organizations.information-requests');
    Route::get('organizations/{id}/contact-points', 'OrganizationController@getContactPoints')->name('organizations.contact-points');

    Route::resource('member-states', 'MemberStateController');

    Route::resource('countries', 'CountryController');
    Route::resource('emails', 'EmailController');
    // Route::resource('forum-categories', 'ForumCategoryController');
    Route::resource('forum-topics', 'ForumTopicController');

    Route::get('/information-requests/new', 'InformationRequestStatsController@indexNew')->name('information-requests.new');
    Route::get('/information-requests/pending', 'InformationRequestStatsController@indexNew')->name('information-requests.new');
    Route::get('/information-requests/pending', 'InformationRequestStatsController@indexNew')->name('information-requests.pending');
    Route::get('/information-requests/awaitingresponse', 'InformationRequestStatsController@indexNew')->name('information-requests.awaitingresponse');
    Route::get('/information-requests/awaitingfeedback', 'InformationRequestStatsController@indexNew')->name('information-requests.awaitingfeedback');
    Route::get('/information-requests/moreinformation', 'InformationRequestStatsController@indexNew')->name('information-requests.moreinformation');
    Route::get('/information-requests/completed', 'InformationRequestStatsController@indexNew')->name('information-requests.completed');


    Route::resource('information-requests', 'InformationRequestController');
    Route::get('information-requests/{id}/responses', 'InformationRequestController@getResponses')->name('information-requests.responses');
    Route::get('information-requests/{id}/getreview', 'InformationRequestController@getReview')->name('information-requests.getreview');
    Route::put('information-requests/{id}/addreview', 'InformationRequestController@addReview')->name('information-requests.addreview');

    Route::resource('request-responses', 'RequestResponseController');
    Route::get('request-responses/{id}/getfeedback', 'RequestResponseController@getFeedback')->name('request-responses.getfeedback');
    Route::put('request-responses/{id}/addfeedback', 'RequestResponseController@addFeedback')->name('request-responses.addfeedback');
    
    Route::resource('internal-communications', 'InternalCommunicationController');
    Route::resource('job-adverts', 'JobAdvertController');
    // Route::resource('statuses', 'StatusController');
});

Route::middleware(['auth', 'verified', 'activity'])->prefix('dashboard/settings')->name('dashboard.')->group(function() {
    Route::resource('information-restrictions', 'InformationRestrictionController');
    Route::resource('nature-of-offences', 'NatureOfOffenceController');
    
    Route::resource('case-types', 'CaseTypeController');
    Route::resource('forum-categories', 'ForumCategoryController');
    Route::resource('statuses', 'StatusController');
});


Route::middleware(['activity'])->group(function() {
    Route::get('job-adverts', 'CustomController@jobAdverts')->name('job-adverts');
    Route::get('job-adverts/{slug}', 'CustomController@showJobAdvert')->name('job-adverts.show');
});
