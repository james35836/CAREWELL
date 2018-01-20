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

/*LOGIN*/
Route::get('/', 										'FrontController@login');
Route::get('/login', 									'FrontController@login');
Route::post('/login_submit', 							'FrontController@login_submit');
Route::get('/logout', 									'FrontController@logout');




Route::get('/register', 								'FrontController@register');


/*USER*/
Route::get('/user/view_profile', 						'UserController@user_view_profile');
/*DASHBOARD*/
Route::get('/dashboard', 								'CarewellController@dashboard');
/*ADMIN*/
Route::get('/admin', 								    'AdminController@admin_center');
Route::get('/admin/create_user', 						'AdminController@admin_create_user');
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
Route::get('/member/view_member_details/{member_id}', 	'CarewellController@member_view_details');
Route::get('/member/transaction_details/{member_id}',   'CarewellController@member_transaction_details');
Route::get('/member/download_template/{company_id}', 	'CarewellController@member_download_template');
Route::get('/member/import_member', 					'CarewellController@member_import_member');
Route::post('/member/import_member/submit', 			'CarewellController@member_import_member_submit');






/*BILLING*/
Route::get('/billing', 									'CarewellController@billing');
Route::get('/billing/create_cal', 						'CarewellController@billing_create_cal');
Route::post('/billing/create_cal/sumbit', 				'CarewellController@billing_create_cal_submit');
Route::get('/billing/member/view/{cal_id}/{company_id}', 						'CarewellController@billing_member_view');
Route::get('/billing/import_cal_members/{cal_id}/{company_id}', 				'CarewellController@billing_import_cal_members');
Route::get('/billing/cal_download_template/{cal_id}/{company_id}', 		    'CarewellController@billing_cal_download_template');
Route::post('/billing/cal_import_template_submit', 		'CarewellController@billing_cal_import_template');



Route::get('/billing/billing/statement', 			    'CarewellController@billing_billing_statement');


/*MEDICAL*/
Route::get('/medical', 									'CarewellController@medical');
Route::get('/medical/create_approval', 					'CarewellController@medical_create_approval');
Route::get('/medical/create_approval/{member_id}', 		'CarewellController@medical_create_approval_get_info');


Route::get('/medical/approval/details', 				'CarewellController@medical_approval_details');

/*HOSPITAL*/
Route::get('/hospital', 								'CarewellController@hospital');
/*PAYABLE*/
Route::get('/payable', 									'CarewellController@payable');
/*REPORTS*/
Route::get('/reports', 									'CarewellController@reports');
/*SETTINGS*/
Route::get('/settings/plan', 				    		'CarewellController@settings_plan');
Route::get('/settings/plan/create_plan', 				'CarewellController@settings_plan_create_plan');
Route::post('/settings/plan/create_plan/submit', 		'CarewellController@settings_plan_create_plan_submit');
Route::get('/settings/plan/plan_details/{availment_plan_id}', 	'CarewellController@settings_plan_details');



/*MAINTENANCE*/
Route::get('/developer/maintenance', 				    'MaintenanceController@developer_maintenance');
Route::get('/developer/truncate', 				    'MaintenanceController@developer_truncate');



