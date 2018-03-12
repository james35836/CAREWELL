<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Developer : James Omosora
| Author 	: James Omosora
| 
|
*/
Route::get('/importExport', 'TestController@importExport');
Route::get('/downloadExcel/{type}', 'TestController@downloadExcel');
Route::post('/importExcel', 'TestController@importExcel');

Route::get('/testing', 					    			'TestController@testing');
Route::get('/testing_excel', 			    			'TestController@testing_excel');
Route::get('/testing_excel2', 			    			'TestController@testing_excel2');
Route::get('/sample',									'TestController@sample');	
Route::post('/samples',									'TestController@sample_submit');

Route::get('/export_pdf',								'TestController@export_pdf');

/*LOGIN*/
Route::get('/', 										'FrontController@login');
Route::get('/login', 									'FrontController@login');
Route::post('/login_submit', 							'FrontController@login_submit');
Route::get('/logout', 									'FrontController@logout');

Route::get('/reset/password', 							'FrontController@reset_password');

Route::post('/reset/password/submit', 					'FrontController@reset_password_submit');

/*STATIC CONTROLLER*/

Route::any('/get/company_info', 						'StaticFunctionController@getCompanyInfo');
Route::any('/get/provider_info', 						'StaticFunctionController@getProviderInfo');
Route::any('/get/availment_info', 						'StaticFunctionController@getAvailmentInfo');
Route::any('/get/doctor_specialty', 					'StaticFunctionController@getDoctorSpecialty');

/*FILETERING*/

Route::post('/page/filtering', 							'SearchController@pageFiltering');
Route::post('/page/searching', 							'SearchController@pageSearching');


/*USER*/
Route::get('/user/view_profile', 						'UserController@user_view_profile');

Route::POST('/user/save_profile', 						'UserController@user_save_profile');

Route::get('/user/change_password', 					'UserController@user_change_password');
Route::POST('/user/change_password/submit', 			'UserController@user_change_password_submit');


/*ADMIN*/
Route::get('/settings/admin', 							'AdminController@admin_center');
Route::get('/admin/create_user', 						'AdminController@admin_create_user');
Route::POST('/admin/create_user/submit', 				'AdminController@admin_create_user_submit');


Route::get('/settings/developer', 				    	'AdminController@settings_developer');
Route::get('/settings/developer_modal', 				'AdminController@settings_developer_modal');
Route::post('/settings/developer_modal_submit', 		'AdminController@settings_developer_modal_submit');


Route::get('/admin/view_user_deatils/{user_id}', 		'AdminController@admin_view_user_deatils');


/*DASHBOARD*/
Route::get('/dashboard', 								'CarewellController@dashboard');

/*COMPANY*/
Route::get('/company', 									'CarewellController@company');
Route::get('/company/company_details/{company_id}', 	'CarewellController@company_details');
Route::get('/company/create_company', 					'CarewellController@company_create_company');
Route::post('/company/create_company/submit', 			'CarewellController@company_create_company_submit');





/*MEMBER*/
Route::get('/member', 									'CarewellController@member');
Route::get('/member/create_member', 					'CarewellController@member_create_member');
Route::post('/member/create_member/submit', 			'CarewellController@member_create_member_submit');

Route::get('/member/view_member_details/{member_id}', 	'CarewellController@member_details');
Route::get('/member/transaction_details/{member_id}',   'CarewellController@member_transaction_details');
Route::get('/member/download_template/{company_id}/{number}', 	'CarewellController@member_download_template');
Route::get('/member/import_member', 					'CarewellController@member_import_member');
Route::post('/member/import_member/submit', 			'CarewellController@member_import_member_submit');

Route::get('/member/member_adjustment/{member_id}', 	'CarewellController@member_adjustment');
Route::post('/member/member_adjustment/submit', 		'CarewellController@member_adjustment_submit');



/*PROVIDER*/
Route::get('/provider', 								'CarewellController@provider');
Route::get('/provider/create_provider', 				'CarewellController@provider_create');
Route::post('/provider/create_provider/submit', 		'CarewellController@provider_create_submit');

Route::get('/provider/provider_details/{provider_id}', 	'CarewellController@provider_details');


/*DOCTOR*/
Route::get('/doctor', 									'CarewellController@doctor');
Route::get('/doctor/add_doctor', 					'CarewellController@add_doctor');
Route::get('/doctor/import_doctor', 					'CarewellController@import_doctor');
Route::post('/doctor/add_doctor/submit', 			'CarewellController@add_doctor_submit');
Route::get('/doctor/view_doctor_details/{doctor_id}', 	'CarewellController@doctor_view_details');

Route::get('/doctor/download_template/{provider_id}/{number}', 	'CarewellController@doctor_download_template');
Route::post('/doctor/import_doctor/submit', 			'CarewellController@doctor_import_doctor_submit');





/*BILLING*/
Route::get('/billing', 									'CarewellController@billing');
Route::get('/billing/create_cal', 						'CarewellController@billing_create_cal');
Route::post('/billing/create_cal/sumbit', 				'CarewellController@billing_create_cal_submit');
Route::get('/billing/cal_details/{cal_id}', 						'CarewellController@billing_cal_details');
Route::get('/billing/import_cal_members/{cal_id}/{company_id}', 				'CarewellController@billing_import_cal_members');
Route::get('/billing/cal_download_template/{cal_id}/{company_id}', 		    'CarewellController@billing_cal_download_template');
Route::post('/billing/cal_import_template_submit', 		'CarewellController@billing_cal_import_template');



Route::get('/billing/billing/statement', 			    'CarewellController@billing_billing_statement');

Route::post('/billing/cal_member/remove', 				'CarewellController@billing_cal_member_remove');

Route::get('/billing/cal_close/{cal_id}', 				'CarewellController@billing_cal_close');
Route::post('/billing/cal_close/sumbit',				'CarewellController@billing_cal_close_submit');



/*MEDICAL*/
Route::get('/availment', 									'CarewellController@availment');
Route::get('/availment/create_approval', 					'CarewellController@availment_create_approval');
Route::post('/availment/get_member_info',		'CarewellController@availment_get_member_info');
Route::get('/availment/get_member_procedure/{availment_id}','CarewellController@availment_get_member_procedure');
Route::get('/availment/get_provider_doctor/{provider_id}','CarewellController@availment_get_provider_doctor');
Route::post('/availment/create_approval/submit',			'CarewellController@availment_create_approval_submit');
Route::get('/availment/approval_details/{approval_id}','CarewellController@availment_view_approval_details');



/*PAYABLE*/
Route::get('/payable', 									'CarewellController@payable');
Route::get('/payable/create_payable', 					'CarewellController@payable_create');
Route::get('/payable/get_approval/{provider_id}', 		'CarewellController@payable_create_get_approval');
Route::post('/payable/create_payable/submit', 			'CarewellController@payable_create_submit');
Route::get('/payable/payable_details/{payable_id}', 	'CarewellController@payable_details');



/*REPORTS*/
Route::get('/reports', 									'CarewellController@reports');
Route::get('/reports/availment', 					    'CarewellController@reports_availment');


/*SETTINGS*/

Route::get('/settings/coverage', 				    	'CarewellController@settings_coverage_plan');
Route::get('/settings/coverage/create_plan', 			'CarewellController@settings_coverage_plan_create');
Route::post('/settings/coverage/create_plan_submit', 	'CarewellController@settings_coverage_plan_create_submit');
Route::get('/settings/coverage/plan_details/{coverage_plan_id}', 			'CarewellController@settings_coverage_plan_details');


/*ARCHIVED*/
Route::POST('/archived/submit', 						'CarewellController@archived_submit');
/*RESTORE*/
Route::POST('/restore/submit', 							'CarewellController@restore_submit');

/*MAINTENANCE*/
Route::get('/developer/maintenance', 				    'MaintenanceController@developer_maintenance');
Route::get('/developer/truncate', 				    	'MaintenanceController@developer_truncate');
Route::get('/developer/credential', 				    'MaintenanceController@developer_credential');



