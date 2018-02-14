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

Route::get('/export_pdf',									'TestController@export_pdf');

/*LOGIN*/
Route::get('/', 										'FrontController@login');
Route::get('/login', 									'FrontController@login');
Route::post('/login_submit', 							'FrontController@login_submit');
Route::get('/logout', 									'FrontController@logout');




Route::get('/register', 								'FrontController@register');
/*STATIC CONTROLLER*/

Route::any('/get/company_coverage_plan', 				'StaticFunctionController@getCompanyCoveragePlan');
Route::any('/get/company_jobsite', 						'StaticFunctionController@getCompanyJobsite');
Route::any('/get/procedure_amount', 					'StaticFunctionController@getProcedureAmount');
Route::any('/get/doctor_specialty', 					'StaticFunctionController@getDoctorSpecialty');


/*USER*/
Route::get('/user/view_profile', 						'UserController@user_view_profile');
/*DASHBOARD*/
Route::get('/dashboard', 								'CarewellController@dashboard');
/*ADMIN*/
Route::get('/settings/admin', 							'AdminController@admin_center');
Route::get('/admin/create_user', 						'AdminController@admin_create_user');
Route::POST('/admin/create_user/submit', 				'AdminController@admin_create_user_submit');


Route::get('/admin/view_user_deatils/{user_id}', 		'AdminController@admin_view_user_deatils');


// Route::get('/admin', 								    'AdminController@admin');
// Route::get('/admin', 								    'AdminController@admin');
/*COMPANY*/
Route::get('/company', 									'CarewellController@company');
Route::get('/company/company_details/{company_id}', 	'CarewellController@company_details');
Route::get('/company/create_company', 					'CarewellController@company_create_company');
Route::post('/company/create_company/submit', 			'CarewellController@company_create_company_submit');





/*MEMBER*/
Route::get('/member', 									'CarewellController@member');
Route::get('/member/create_member', 					'CarewellController@member_create_member');
Route::post('/member/create_member/submit', 			'CarewellController@member_create_member_submit');

Route::get('/member/view_member_details/{member_id}', 	'CarewellController@member_view_details');
Route::get('/member/transaction_details/{member_id}',   'CarewellController@member_transaction_details');
Route::get('/member/download_template/{company_id}/{number}', 	'CarewellController@member_download_template');
Route::get('/member/import_member', 					'CarewellController@member_import_member');
Route::post('/member/import_member/submit', 			'CarewellController@member_import_member_submit');

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


/*MEDICAL*/
Route::get('/availment', 									'CarewellController@availment');
Route::get('/availment/create_approval', 					'CarewellController@availment_create_approval');
Route::get('/availment/get_member_info/{member_id}',		'CarewellController@availment_get_member_info');
Route::get('/availment/get_member_procedure/{availment_id}','CarewellController@availment_get_member_procedure');
Route::get('/availment/get_provider_doctor/{provider_id}','CarewellController@availment_get_provider_doctor');
Route::post('/availment/create_approval/submit',			'CarewellController@availment_create_approval_submit');
Route::get('/availment/approval_details/{approval_id}','CarewellController@availment_view_approval_details');



/*PAYABLE*/
Route::get('/payable', 									'CarewellController@payable');
Route::get('/payable/create_payable', 					'CarewellController@payable_create');
Route::get('/payable/get_approval/{provider_id}', 		'CarewellController@payable_create_get_approval');



/*REPORTS*/
Route::get('/reports', 									'CarewellController@reports');
/*SETTINGS*/

Route::get('/settings/coverage', 				    	'CarewellController@settings_coverage_plan');
Route::get('/settings/coverage/create_plan', 			'CarewellController@settings_coverage_plan_create');
Route::post('/settings/coverage/create_plan_submit', 	'CarewellController@settings_coverage_plan_create_submit');
Route::get('/settings/coverage/plan_details/{coverage_plan_id}', 			'CarewellController@settings_coverage_plan_details');



/*MAINTENANCE*/
Route::get('/developer/maintenance', 				    'MaintenanceController@developer_maintenance');
Route::get('/developer/truncate', 				    	'MaintenanceController@developer_truncate');
Route::get('/developer/credential', 				    'MaintenanceController@developer_credential');



