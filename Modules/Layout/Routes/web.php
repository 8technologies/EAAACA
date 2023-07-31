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

Route::prefix('layout')->group(function() {
    Route::get('/', 'LayoutController@index');
});

Route::middleware(['auth', 'verified', 'activity'])->prefix('dashboard/layout')->name('dashboard.')->group(function() {
	Route::get('/', 'LayoutController@index')->name('layout');
    Route::resource('layout_rows', 'LayoutRowController');
    Route::resource('layout_columns', 'LayoutColumnController');
    Route::resource('layout_sections', 'LayoutSectionController');
    Route::resource('layout_section_tops', 'LayoutSectionTopController');
    // Layout sections
    Route::post('pages/{id}/addpagesection', 'LayoutSectionController@addPageSection')->name('pages.addpagesection');
    Route::post('pages/{id}/updatepagesections', 'LayoutSectionController@updatePageSections')->name('pages.updatepagesections');
    Route::post('services/{id}/addpagesection', 'LayoutSectionController@addServiceSection')->name('services.addpagesection');
    Route::post('services/{id}/updatepagesections', 'LayoutSectionController@updateServiceSections')->name('services.updatepagesections');
    Route::post('our_work/{id}/addpagesection', 'LayoutSectionController@addOurWorkSection')->name('our_work.addpagesection');
    Route::post('our_work/{id}/updateourwosections', 'LayoutSectionController@updateOurWorkSections')->name('our_work.updatepagesections');
    Route::post('layout_sections/{id}/addrow', 'LayoutSectionController@addRow')->name('layout_sections.addrow');
    Route::post('layout_sections/{id}/updaterows', 'LayoutSectionController@updateRows')->name('layout_sections.updaterows');

    Route::get('layout_sections/{id}/createfieldblock', 'LayoutSectionController@createFieldBlock')->name('layout_sections.createfieldblock');
    Route::post('layout_sections/{id}/storefieldblock', 'LayoutSectionController@storeFieldBlock')->name('layout_sections.storefieldblock');

    // Layout section tops
    Route::post('pages/{id}/addpagesectiontop', 'LayoutSectionTopController@addPageSectionTop')->name('pages.addpagesectiontop');
    Route::post('pages/{id}/updatepagesectiontops', 'LayoutSectionTopController@updatePageSectionTops')->name('pages.updatepagesectiontops');
    Route::post('services/{id}/addpagesectiontop', 'LayoutSectionTopController@addServiceSectionTop')->name('services.addpagesectiontop');
    Route::post('services/{id}/updatepagesectiontops', 'LayoutSectionTopController@updateServiceSectionTops')->name('services.updatepagesectiontops');
    Route::post('our_work/{id}/addpagesectiontop', 'LayoutSectionTopController@addOurWorkSectionTop')->name('our_work.addpagesectiontop');
    Route::post('our_work/{id}/updatepagesectiontops', 'LayoutSectionTopController@updateOurWorkSectionTops')->name('our_work.updatepagesectiontops');
    Route::post('layout_section_tops/{id}/addrow', 'LayoutSectionTopController@addRow')->name('layout_section_tops.addrow');
    Route::post('layout_section_tops/{id}/updaterows', 'LayoutSectionTopController@updateRows')->name('layout_section_tops.updaterows');
    
    Route::get('layout_section_tops/{id}/createfieldblock', 'LayoutSectionTopController@createFieldBlock')->name('layout_section_tops.createfieldblock');
    Route::post('layout_section_tops/{id}/storefieldblock', 'LayoutSectionTopController@storeFieldBlock')->name('layout_section_tops.storefieldblock');
    
    // Layout rows
    Route::post('layout_rows/{id}/addcolumn', 'LayoutRowController@addColumn')->name('layout_rows.addcolumn');
    Route::post('layout_rows/{id}/updatecolumns', 'LayoutRowController@updateColumns')->name('layout_rows.updatecolumns');

    // Layout columns
    Route::post('layout_columns/{id}/updatecolumnfields', 'LayoutColumnController@updateColumnFields')->name('layout_columns.updatecolumnfields');
    // Column Title Field
    Route::get('layout_columns/{id}/createfieldtitle', 'LayoutColumnController@createFieldTitle')->name('layout_columns.createfieldtitle');
    Route::post('layout_columns/{id}/storefieldtitle', 'LayoutColumnController@storeFieldTitle')->name('layout_columns.storefieldtitle');
    // Column Text Field
    Route::get('layout_columns/{id}/createfieldtext', 'LayoutColumnController@createFieldText')->name('layout_columns.createfieldtext');
    Route::post('layout_columns/{id}/storefieldtext', 'LayoutColumnController@storeFieldText')->name('layout_columns.storefieldtext');
    // Column Link Field
    Route::get('layout_columns/{id}/createfieldlink', 'LayoutColumnController@createFieldLink')->name('layout_columns.createfieldlink');
    Route::post('layout_columns/{id}/storefieldlink', 'LayoutColumnController@storeFieldLink')->name('layout_columns.storefieldlink');
    // Column Image Field
    Route::get('layout_columns/{id}/createfieldimage', 'LayoutColumnController@createFieldImage')->name('layout_columns.createfieldimage');
    Route::post('layout_columns/{id}/storefieldimage', 'LayoutColumnController@storeFieldImage')->name('layout_columns.storefieldimage');
    // Column Html Field
    Route::get('layout_columns/{id}/createfieldhtml', 'LayoutColumnController@createFieldHtml')->name('layout_columns.createfieldhtml');
    Route::post('layout_columns/{id}/storefieldhtml', 'LayoutColumnController@storeFieldHtml')->name('layout_columns.storefieldhtml');
    // Column Block Field
    Route::get('layout_columns/{id}/createfieldblock', 'LayoutColumnController@createFieldBlock')->name('layout_columns.createfieldblock');
    Route::post('layout_columns/{id}/storefieldblock', 'LayoutColumnController@storeFieldBlock')->name('layout_columns.storefieldblock');

});
