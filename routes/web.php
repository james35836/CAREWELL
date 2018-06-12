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
Route::get('/testing_excel', 			    				'TestController@testing_excel');
Route::get('/testing_excel2', 			    			'TestController@testing_excel2');
Route::get('/sample',								'TestController@sample');	
Route::post('/samples',								'TestController@sample_submit');

Route::get('/export_pdf',							'TestController@export_pdf');

/*LOGIN*/
Route::get('/', 									'FrontController@login');
Route::get('/login', 								'FrontController@login');
Route::post('/login_submit', 							'FrontController@login_submit');
Route::get('/logout', 								'FrontController@logout');

Route::get('/reset/password', 						'FrontController@reset_password');

Route::post('/reset/password/submit', 					'FrontController@reset_password_submit');

/*STATIC CONTROLLER*/

Route::any('/get/company_info', 						'StaticFunctionController@getCompanyInfo');
Route::any('/get/provider_info', 						'StaticFunctionController@getProviderInfo');
Route::any('/get/availment_info', 						'StaticFunctionController@getAvailmentInfo');
Route::any('/get/check_procedure_amount', 				'StaticFunctionController@getCheckProcedureAmount');




Route::any('/get/doctor_specialty', 					'StaticFunctionController@getDoctorSpecialty');
Route::any('/get/export/warning',                           'StaticFunctionController@getExportWarning');


Route::post('/forgetSession',                                 'StaticFunctionController@forgetSession');
/*FILETERING*/

Route::post('/page/filtering', 						'SearchController@pageFiltering');
Route::post('/page/searching', 						'SearchController@pageSearching');


/*USER*/
Route::get('/user/view_profile', 						'UserController@user_view_profile');

Route::POST('/user/save_profile', 						'UserController@user_save_profile');

Route::get('/user/change_password', 					'UserController@user_change_password');
Route::POST('/user/change_password/submit', 				'UserController@user_change_password_submit');


/*ADMIN*/
Route::get('/settings/admin', 						'AdminController@admin_center');
Route::get('/admin/create_user', 						'AdminController@admin_create_user');
Route::POST('/admin/create_user/submit', 				'AdminController@admin_create_user_submit');
Route::get('/admin/view_user_details/{user_id}', 			'AdminController@admin_view_user_details');

Route::get('/settings/maintenance', 				    'AdminController@settings_maintenance');
Route::get('/settings/maintenance_modal', 				'AdminController@settings_maintenance_modal');
Route::post('/settings/maintenance_modal_submit', 		'AdminController@settings_maintenance_modal_submit');

/*DASHBOARD*/
Route::get('/dashboard', 						     'CarewellController@dashboard');

/*COMPANY*/
Route::get('/company', 							     'CarewellController@company');
Route::get('/company/company_details/{company_id}', 	     'CarewellController@company_details');
Route::get('/company/create_company', 					'CarewellController@company_create_company');
Route::post('/company/create_company/submit', 			'CarewellController@company_create_company_submit');
Route::post('/company/update_company/submit', 			'CarewellController@company_update_company_submit');

Route::get('/company/add_coverage_plan/{company_id}', 	     'CarewellController@company_add_coverage_plan');
Route::post('/company/add_coverage_plan/submit', 		     'CarewellController@company_add_coverage_plan_submit');
Route::get('/company/add_deployment/{company_id}', 		'CarewellController@company_add_deployment');
Route::post('/company/add_deployment/submit', 			'CarewellController@company_add_deployment_submit');


/*MEMBER*/
Route::get('/member', 								'CarewellController@member');
Route::get('/member/create_member', 					'CarewellController@member_create_member');
Route::post('/member/create_member/submit', 				'CarewellController@member_create_member_submit');

Route::get('/member/view_member_details/{member_id}', 		'CarewellController@member_details');
Route::get('/member/transaction_details/{member_id}',   	'CarewellController@member_transaction_details');
Route::get('/member/download_template/{company_id}/{number}', 	'CarewellController@member_download_template');
Route::get('/member/import_member', 					'CarewellController@member_import_member');
Route::post('/member/import_member/submit', 				'CarewellController@member_import_member_submit');

Route::get('/member/member_adjustment/{member_id}', 		'CarewellController@member_adjustment');
Route::post('/member/member_adjustment/submit', 			'CarewellController@member_adjustment_submit');

Route::post('/member/update_member/submit', 				'CarewellController@member_update_member_submit');




/*PROVIDER*/
Route::get('/provider', 								'CarewellController@provider');
Route::get('/provider/create_provider', 				'CarewellController@provider_create');
Route::post('/provider/create_provider/submit', 			'CarewellController@provider_create_submit');
Route::get('/provider/provider_details/{provider_id}', 	'CarewellController@provider_details');
Route::get('/provider/import_provider', 				'CarewellController@provider_import');
Route::post('/provider/import_provider/submit', 			'CarewellController@provider_import_submit');
Route::get('/provider/export_template', 				'CarewellController@provider_export_template');

Route::post('/provider/update_provider/submit', 'CarewellController@provider_update_provider_submit');

/*DOCTOR*/
Route::get('/doctor', 								'CarewellController@doctor');
Route::get('/doctor/add_doctor', 					    	'CarewellController@add_doctor');
Route::get('/doctor/import_doctor', 					'CarewellController@import_doctor');
Route::post('/doctor/add_doctor/submit', 			    	'CarewellController@add_doctor_submit');
Route::get('/doctor/view_doctor_details/{doctor_id}', 		'CarewellController@doctor_view_details');
Route::get('/doctor/download_template/{provider_id}/{number}', 	'CarewellController@doctor_download_template');
Route::post('/doctor/import_doctor/submit', 				'CarewellController@doctor_import_doctor_submit');
Route::post('/doctor/update_doctor/submit', 				'CarewellController@doctor_update_submit');

Route::get('/doctor/add_doctor_provider/{doctor_id}', 		'CarewellController@doctor_add_doctor_provider');
Route::post('/doctor/add_doctor_provider/submit', 		'CarewellController@doctor_add_doctor_provider_submit');



/*BILLING*/
Route::get('/billing', 									'CarewellController@billing');
Route::get('/billing/create_cal', 						'CarewellController@billing_create_cal');
Route::post('/billing/create_cal/sumbit', 				'CarewellController@billing_create_cal_submit');
Route::get('/billing/cal_details/{cal_id}', 				'CarewellController@billing_cal_details');

Route::post('/billing/update_cal_details/sumbit', 		'CarewellController@billing_update_cal_details_submit');


Route::get('/billing/import_cal_members/{cal_id}/{company_id}',    'CarewellController@billing_import_cal_members');
Route::get('/billing/cal_download_template/{cal_id}/{company_id}', 'CarewellController@billing_cal_download_template');
Route::post('/billing/cal_import_template_submit', 		'CarewellController@billing_cal_import_template');
Route::get('/billing/payment_breakdown/{cal_member_id}/{ref}', 	'CarewellController@billing_payment_breakdown');
Route::post('/billing/payment_breakdown/update_payment_date', 	'CarewellController@billing_update_payment_date');
Route::get('/billing/last_ten_payments/{member_id}', 	'CarewellController@billing_last_ten_payments');
Route::post('/billing/cal_member/remove', 				'CarewellController@billing_cal_member_remove');
Route::post('/billing/cal_member/restore', 				'CarewellController@billing_cal_member_restore');
Route::post('/billing/cal_pending_submit', 				'CarewellController@billing_cal_pending_submit');
Route::get('/billing/cal_close/{cal_id}', 				'CarewellController@billing_cal_close');
Route::post('/billing/cal_close/sumbit',				'CarewellController@billing_cal_close_submit');

/*MEDICAL*/
Route::get('/availment', 							'CarewellController@availment');
Route::get('/availment/create_approval', 				'CarewellController@availment_create_approval');
Route::post('/availment/get_member_info',				'CarewellController@availment_get_member_info');

Route::post('/availment/create_approval/submit',		'CarewellController@availment_create_approval_submit');
Route::get('/availment/approval_details/{approval_id}', 'CarewellController@availment_view_approval_details');
Route::get('/availment/approval_export_pdf/{approval_id}', 'CarewellController@approval_export_pdf');
Route::post('/availment/update_approval/submit',		'CarewellController@availment_update_approval_submit');
Route::post('/availment/approval/remove_procedure',		'CarewellController@availment_approval_remove_procedure_submit');

Route::post('/availment/approval/remove_doctor',		'CarewellController@availment_approval_remove_doctor_submit');
Route::post('/availment/approval/remove_doctor_payee',		'CarewellController@availment_approval_remove_doctor_payee_submit');

Route::post('/availment/approval/remove_approval_details',		'CarewellController@availment_approval_remove_details_submit');






/*PAYABLE*/
Route::get('/payable', 								'CarewellController@payable');
Route::get('/payable/create_payable', 					'CarewellController@payable_create');
Route::get('/payable/get_approval/{provider_id}', 		'CarewellController@payable_create_get_approval');
Route::post('/payable/search_approval', 				'CarewellController@payable_search_approval');

Route::post('/payable/create_payable/submit', 			'CarewellController@payable_create_submit');
Route::get('/payable/payable_details/{payable_id}', 		'CarewellController@payable_details');

Route::get('/payable/payable_details/export_excel/{payable_id}', 'CarewellController@payable_details_export_excel');

Route::post('/payable/update_payable/submit', 			'CarewellController@payable_update_submit');

Route::get('/payable/payee_details/{payable_id}', 		'CarewellController@payable_view_payee_details');

Route::get('/payable/payable_export_pdf/{approval_id}', 'CarewellController@payable_export_pdf');



/*REPORTS*/
Route::get('/reports', 								'CarewellController@reports');
Route::get('/reports/availment', 					    	'CarewellController@reports_availment');
Route::get('/reports/ending_number_per_month', 			'CarewellController@reports_monitoring_end_per_month');
Route::get('/reports/breakdown', 						'CarewellController@reports_breakdown');
Route::get('/reports/consolidation', 					'CarewellController@reports_consolidation');

Route::get('/reports/payment_report', 					'CarewellController@reports_payment_report');
Route::get('/reports/payment_report/{member_id}', 		'CarewellController@reports_payment_report_member');


Route::get('/reports/payment_report/excel/{new_year}/{payment_mode}/{member_id}', 'CarewellController@reports_payment_member_excel');




Route::get('/reports/member_cal',						'CarewellController@reports_member_cal');
Route::get('/reports/member_cal/{ref}/{member_id}',		'CarewellController@reports_member_cal_detail');

Route::post('/reports/member_cal/date_filter/{ref}',		'CarewellController@reports_member_cal_month_filter_date');

Route::get('/reports/member_cal/excel_report/{ref}/{val_key}/{member_id}', 'CarewellController@reports_export_excel');

Route::get('/reports/ending_number_per_reports/export_excel', 'CarewellController@reports_end_per_month_export_excel');

Route::get('/reports/availment_per_month',  'CarewellController@reports_availment_per_month');

Route::get('/reports/availment_per_month_summary/export_excel', 'CarewellController@reports_availment_per_month_export_excel');

Route::get('/reports/availment_monitoring', 'CarewellController@reports_availment_monitoring');
Route::get('/reports/availment_monitoring/export_excel', 'CarewellController@reports_availment_monitoring_export_excel');




Route::post('/reports/member_cal/get_report', 'TestController@test_search');

/*SETTINGS*/

Route::get('/settings/coverage', 				    		'CarewellController@settings_coverage_plan');
Route::get('/settings/coverage/create_plan', 			'CarewellController@settings_coverage_plan_create');

Route::get('/settings/coverage/items/{availment_id}/{session_name}/{identifier}','CarewellController@settings_coverage_items');
Route::post('/settings/coverage/items_submit', 			'CarewellController@settings_coverage_items_submit');


Route::post('/settings/coverage/create_plan_submit', 		'CarewellController@settings_coverage_plan_create_submit');
Route::get('/settings/coverage/plan_details/{coverage_plan_id}', 			'CarewellController@settings_coverage_plan_details');


Route::post('/settings/coverage/mark_new_submit', 		'CarewellController@settings_coverage_plan_mark_new_submit');


/*ARCHIVED*/
Route::POST('/archived/submit', 						'CarewellController@archived_submit');
/*RESTORE*/
Route::POST('/restore/submit', 						'CarewellController@restore_submit');

/*MAINTENANCE*/
Route::get('/developer/maintenance', 				    	'MaintenanceController@developer_maintenance');
Route::get('/developer/truncate', 				    		'MaintenanceController@developer_truncate');
Route::get('/developer/credential', 				    	'MaintenanceController@developer_credential');



