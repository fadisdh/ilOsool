<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/



Route::group(array('prefix' => in_array(Request::segment(1), array('en', 'ar')) ? Request::segment(1) : null, 'before' => 'localization'), function()
{
	Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));

	Route::get('language/switch', array('as' => 'lang.switch', 'uses' => 'HomeController@languageSwitch'));

	/*Login*/
	Route::get('/login', array('as' => 'login', 'uses' => 'LoginController@index'))->before('guest');
	Route::post('/login', array('as' => 'login.post', 'uses' => 'LoginController@login'))->before('csrf|guest');
	Route::get('/logout', array( 'as' => 'logout', 'uses' => 'LoginController@logout'))->before('auth');
	Route::get('/linkedin/login', array('as' => 'linkedin_login', 'uses' => 'LinkedinController@login'))->before('guest');
	Route::get('/linkedin/logout', array('as' => 'linkedin_logout', 'uses' => 'LinkedinController@logout'))->before('auth');

	Route::post('password/remind', array('as' => 'passreminder.post', 'uses' => 'RemindersController@postRemind'))->before('guest');
	Route::get('password/remind', array('as' => 'passreminder', 'uses' => 'RemindersController@getRemind'))->before('guest');
	Route::post('password/reset', array('as' => 'passreset.post', 'uses' => 'RemindersController@postReset'))->before('guest');
	Route::get('password/reset/{token}', array('as' => 'passreset', 'uses' => 'RemindersController@getReset'))->before('guest');

	/*Profile*/
	Route::get('profile',array('as' => 'profile', 'uses' => 'ProfileController@index'))->before('auth');
	Route::get('profile/view/{id}',array('as' => 'profile.view', 'uses' => 'ProfileController@view'))->before('auth');
	Route::get('profile/contact',array('as' => 'profile.contact', 'uses' => 'ProfileController@contact'))->before('auth');
	Route::get('profile/investment',array('as' => 'profile.investment', 'uses' => 'ProfileController@investment'))->before('auth');
	Route::get('profile/files',array('as' => 'profile.files', 'uses' => 'ProfileController@files'))->before('auth');
	Route::get('profile/orders',array('as' => 'profile.orders', 'uses' => 'ProfileController@orders'))->before('auth');
	Route::get('profile/listings',array('as' => 'profile.companies', 'uses' => 'ProfileController@companies'))->before('auth');
	Route::get('profile/requests',array('as' => 'profile.requests', 'uses' => 'ProfileController@requests'))->before('auth');

	Route::get('profile/notifications',array('as' => 'profile.notifications', 'uses' => 'ProfileController@notifications'))->before('auth');
	Route::post('profile/notificationsswitch',array('as' => 'profile.notifications.switch', 'uses' => 'ProfileController@notificationsSwitch'))->before('auth');
	//Route::get('profile/grantAccess/{messageId}', array('as' => 'profile.grant.access', 'uses' => 'ProfileController@grant_access'))->before('auth');
	Route::get('home',array('as' => 'user.home', 'uses' => 'ProfileController@home'))->before('auth');

	//Route::get('user/investments',array('as' => 'user.investments', 'uses' => 'ProfileController@investments'))->before('auth');
	Route::get('profile/edit',array('as' => 'profile.edit', 'uses' => 'ProfileController@edit'))->before('auth');
	Route::get('profile/listing/delete/{id}',array('as' => 'profile.company.delete', 'uses' => 'ProfileController@delete'))->before('auth');
	Route::post('profile/info/edit',array('as' => 'profile.info.edit.post', 'uses' => 'ProfileController@edit_info_post'))->before('auth');
	Route::get('profile/info/edit',array('as' => 'profile.info.edit', 'uses' => 'ProfileController@edit_info'))->before('auth');
	Route::post('profile/contact/edit',array('as' => 'profile.contact.edit.post', 'uses' => 'ProfileController@edit_contact_post'))->before('auth');
	Route::get('profile/contact/edit',array('as' => 'profile.contact.edit', 'uses' => 'ProfileController@edit_contact'))->before('auth');
	Route::post('profile/password/edit',array('as' => 'profile.password.edit.post', 'uses' => 'ProfileController@edit_password_post'))->before('auth');
	Route::get('profile/password/edit',array('as' => 'profile.password.edit', 'uses' => 'ProfileController@edit_password'))->before('auth');

	Route::post('profile/investment/pe/edit',array('as' => 'profile.pe.investment.edit.post', 'uses' => 'ProfileController@edit_pe_investment_post'))->before('auth');
	Route::post('profile/investment/vc/edit',array('as' => 'profile.vc.investment.edit.post', 'uses' => 'ProfileController@edit_vc_investment_post'))->before('auth');
	Route::post('profile/investment/re/edit',array('as' => 'profile.re.investment.edit.post', 'uses' => 'ProfileController@edit_re_investment_post'))->before('auth');
	Route::get('profile/investment/edit',array('as' => 'profile.investment.edit', 'uses' => 'ProfileController@edit_investment'))->before('auth');
	Route::get('profile/acceptInvest/{messageId}', array('as' => 'profile.accept.investment', 'uses' => 'ProfileController@accept_investment'))->before('auth');
	Route::get('profile/rejectInvest/{messageId}', array('as' => 'profile.reject.investment', 'uses' => 'ProfileController@reject_investment'))->before('auth');
	Route::get('profile/investors/{company_id}',array('as' => 'profile.investors', 'uses' => 'ProfileController@investors'))->before('auth');
	Route::get('profile/investment/changestatus/{id}/{status}',array('as' => 'profile.investment.changeStatus', 'uses' => 'ProfileController@investmentChangeStatus'))->before('auth');

	Route::get('profile/investment/pe',array('as' => 'profile.investment.pe', 'uses' => 'ProfileController@investment_pe'))->before('auth');
	Route::get('profile/investment/vc',array('as' => 'profile.investment.vc', 'uses' => 'ProfileController@investment_vc'))->before('auth');
	Route::get('profile/investment/re',array('as' => 'profile.investment.re', 'uses' => 'ProfileController@investment_re'))->before('auth');

	Route::post('profile/request/confirm/{companyId}/{senderId}',array('as' => 'request.confirm', 'uses' => 'ProfileController@requestConfirm'))->before('auth');
	Route::get('profile/grantAccess/{reqId}/{action}', array('as' => 'company.grant.access', 'uses' => 'ProfileController@grant_access'))->before('auth');
	Route::get('profile/request/{id}',array('as' => 'request.popup', 'uses' => 'ProfileController@requestInfo'));//->before('auth');

	Route::get('profile/wishlist',array('as' => 'profile.wishlist', 'uses' => 'ProfileController@wishlist'))->before('auth');

	Route::get('profile/bookmarks',array('as' => 'profile.bookmarks', 'uses' => 'ProfileController@bookmarks'))->before('auth');
	Route::get('profile/bookmarks/{action}/{folderId}', array('as' => 'profile.folder.action', 'uses' => 'ProfileController@folder_action'))->before('auth');
	Route::get('profile/bookmarks/delete/folder/{folderId}', array('as' => 'profile.folder.delete', 'uses' => 'ProfileController@folder_delete'))->before('auth');
	Route::post('profile/bookmarks/folder/{action}/{folderId}',array('as' => 'profile.folder.action.post', 'uses' => 'ProfileController@folder_action_post'))->before('auth');

	Route::get('profile/notification/{id}/view',array('as' => 'notification.view', 'uses' => 'ProfileController@notification_view'))->before('auth');
	//Route::get('profile/myrequests',array('as' => 'profile.myrequests', 'uses' => 'ProfileController@notification_view'))->before('auth');

	Route::get('listing/statistics', array('as' => 'company.statistics', 'uses' => 'CompanyController@statistics'))->before('auth');


	/*Route::get('profile', array('as' => 'profile', function(){
	  return View::make('profile.index');
	}))->before('auth');*/

	/*register*/
	Route::get('register', array('as' => 'register', 'uses' => 'RegisterController@register'));
	Route::post('register', array('as' => 'register.post', 'uses' => 'RegisterController@register_post'))->before('csrf');

	Route::get('require/register/popup', array('as' => 'require.register.popup', 'uses' => 'RegisterController@require_register_popup'))->before('guest');

	Route::get('/register/complete/{type}/skip', array('as' => 'register.complete.skip', 'uses' => 'RegisterController@register_complete_skip'))->before('auth');
	Route::get('/register/complete/{type}', array('as' => 'register.investor', 'uses' => 'RegisterController@investor'))->before('auth')->before('can:register_investor.view');
	Route::post('/register/complete/{type}', array('as' => 'register.investor.post', 'uses' => 'RegisterController@investor_post'))->before('csrf');
	Route::get('/register/listing', array('as' => 'register.lister', 'uses' => 'RegisterController@lister'))->before('auth')->before('can:register_lister.view');
	Route::get('/register/listing/post', array('as' => 'register.lister.post', 'uses' => 'RegisterController@lister_post'));
	Route::get('/register/both', array('as' => 'register.both', 'uses' => 'RegisterController@both'))->before('auth')->before('can:register_both.view');
	Route::post('/register/both', array('as' => 'register.both.post', 'uses' => 'RegisterController@both_post'))->before('csrf');

	Route::get('/register/popup', array('as' => 'register.popup', 'uses' => 'RegisterController@registerPopup'));
	Route::get('/register/success', array('as' => 'register.success', 'uses' => 'RegisterController@registerSuccess'));
	Route::get('register/confirm', array('as' => 'register.confirm', 'uses' => 'RegisterController@registerConfirm'));
	Route::get('register/resendcode', array('as' => 'register.resend.code', 'uses' => 'RegisterController@resendCode'));
	Route::get('register/linkedin/{type}', array('as' => 'register.linkedin', 'uses' => 'RegisterController@linkedinRegister'));

	Route::get('/register/user_type', array('as' => 'register.user_type', 'uses' => 'RegisterController@registerUserType'))->before('auth')->before('can:register_usertype.view');

	/*Company*/
	Route::get('listings', array('as' => 'companies', 'uses' => 'CompanyController@index'))->before('auth');
	Route::get('listing/view/{id}', array('as' => 'company.view', 'uses' => 'CompanyController@view'));
	Route::get('listing_type', array('as' => 'company.type', 'uses' => 'CompanyController@company_type'))->before('auth');
	Route::get('listing', array('as' => 'company.add', 'uses' => 'CompanyController@add'))->before('auth');
	Route::post('listing/{companyId}/post', array('as' => 'company.add.post', 'uses' => 'CompanyController@add_post'))->before('auth|csrf');

	Route::get('listing/pe', array('as' => 'company.pe.add', 'uses' => 'CompanyController@pe_add'))->before('auth');
	Route::post('listing/pe/{companyId}/post', array('as' => 'company.pe.add.post', 'uses' => 'CompanyController@pe_add_post'))->before('auth|csrf');
	Route::get('listing/vc', array('as' => 'company.vc.add', 'uses' => 'CompanyController@vc_add'))->before('auth');
	Route::post('listing/vc/{companyId}/post', array('as' => 'company.vc.add.post', 'uses' => 'CompanyController@vc_add_post'))->before('auth|csrf');
	Route::get('listing/re', array('as' => 'company.re.add', 'uses' => 'CompanyController@re_add'))->before('auth');
	Route::post('listing/re/{companyId}/post', array('as' => 'company.re.add.post', 'uses' => 'CompanyController@re_add_post'))->before('auth|csrf');

	Route::get('listing/{companyId}/success', array('as' => 'company.success', 'uses' => 'CompanyController@success'))->before('auth');

	Route::get('listing/edit/{id}', array('as' => 'company.edit', 'uses' => 'CompanyController@edit'))->before('auth');
	Route::post('listing/edit/{id}/post', array('as' => 'company.edit.post', 'uses' => 'CompanyController@edit_post'))->before('auth|csrf');
	Route::get('listing/delete/{id}', array('as' => 'company.delete', 'uses' => 'CompanyController@delete'))->before('auth');
	Route::get('listing/staff/view/{company_id}/{staff_id}', array('as' => 'staff.view', 'uses' => 'CompanyController@staffView'))->before('auth');

	Route::get('listing/update_investment/{company_id}', array('as' => 'company.update_investment', 'uses' => 'CompanyController@updateInvestment'))->before('auth');
	Route::post('listing/update_investment/{company_id}/post', array('as' => 'company.update_investment.post', 'uses' => 'CompanyController@updateInvestment_post'))->before('auth');

	Route::get('listing/update_status/{company_id}', array('as' => 'company.update_status', 'uses' => 'CompanyController@updateStatus'))->before('auth');
	Route::post('listing/update_status/{company_id}/post', array('as' => 'company.update_status.post', 'uses' => 'CompanyController@updateStatus_post'))->before('auth');

	Route::get('listing/bookmark/delete/{bookmarkId}', array('as' => 'bookmark.delete.popup', 'uses' => 'CompanyController@bookmark_delete'))->before('auth');
	Route::get('listing/bookmark/{company_id}/{action}', array('as' => 'bookmark.popup', 'uses' => 'CompanyController@bookmark'));//->before('auth');
	Route::post('listing/bookmark/{company_id}/post', array('as' => 'add.bookmark.post', 'uses' => 'CompanyController@bookmark_post'))->before('auth');
	Route::get('listing/bookmark/move/{company_id}/{folder_id}',array('as' => 'bookmark.move.popup', 'uses' => 'CompanyController@bookmark_move'))->before('auth');

	Route::post('listing/invest/confirm/{companyId}/{investorId}', array('as' => 'invest.confirm', 'uses' => 'CompanyController@investConfirm'))->before('csrf');
	Route::get('listing/invest/{id}', array('as' => 'invest.popup', 'uses' => 'CompanyController@invest'))->before('auth');

	Route::get('listing/{company_id}/requests', array('as' => 'company.requests', 'uses' => 'CompanyController@requests'))->before('auth');
	/* Staff */
	Route::get('listing/staff/{staffId}/delete', array('as' => 'staff.delete', 'uses' => 'StaffController@staffDelete'))->before('auth');
	Route::post('listing/{company_id}/staff/add/post', array('as' => 'staff.add.post', 'uses' => 'StaffController@staffAddPost'))->before('auth');
	Route::get('listing/{company_id}/staff/add', array('as' => 'staff.add', 'uses' => 'StaffController@staffAdd'))->before('auth');
	Route::post('listing/{company_id}/staff/{staffId}/edit/post', array('as' => 'staff.edit.post', 'uses' => 'StaffController@staffEditPost'))->before('auth');
	Route::get('listing/{company_id}/staff/{staffId}/edit', array('as' => 'staff.edit', 'uses' => 'StaffController@staffEdit'))->before('auth');
	Route::get('listing/{company_id}/staff', array('as' => 'staff', 'uses' => 'StaffController@staff'))->before('auth');


	/* Attachment */
	Route::post('listing/attachment/{company_id}/edit/post', array('as' => 'attachment.edit.post', 'uses' => 'AttachmentController@attachmentEditPost'))->before('auth|csrf');
	Route::get('listing/attachment/{company_id}/edit', array('as' => 'attachment.edit', 'uses' => 'AttachmentController@attachmentEdit'));
	Route::post('listing/{company_id}/attachment/add/post', array('as' => 'attachment.add.post', 'uses' => 'AttachmentController@attachmentAddPost'));
	Route::get('listing/{company_id}/attachment/add', array('as' => 'attachment.add', 'uses' => 'AttachmentController@attachmentAdd'));
	Route::get('listing/attachment/{company_id}/delete', array('as' => 'attachment.delete', 'uses' => 'AttachmentController@attachmentDelete'));
	Route::get('listing/{company_id}/attachments', array('as' => 'attachments', 'uses' => 'AttachmentController@attachments'));
	Route::get('listing/{company_id}/attachment/download/{id}',array('as' => 'attachment.download', 'uses' => 'AttachmentController@attachmentDownload'));

	Route::get('listing/request/{company_id}/{request}', array('as' => 'listing.request.popup', 'uses' => 'CompanyController@request'))->before('auth');
	Route::post('listing/request/confirm/{company_id}/{request}', array('as' => 'listing.request.confirm', 'uses' => 'CompanyController@requestConfirm'))->before('auth');



	/* Posts */
	Route::get('posts/{type}',array('as' => 'posts','uses' => 'PostController@index'));
	Route::get('post/{type}/{id}', array('as' => 'post','uses' => 'PostController@view'));

	/* Pages */
	Route::get('page/partners', array('as' => 'page.partners', 'uses' => 'PageController@partners'));
	Route::get('page/error', array('as' => 'page.error', 'uses' => 'PageController@error'));
	Route::get('page/contact', array('as' => 'page.contact','uses' => 'PageController@contact'));
	
	Route::get('page/{slug}', array('as' => 'page','uses' => 'PageController@view'));
	Route::get('pages', array('as' => 'pages','uses' => 'PageController@searchPage'));

	/*Enquiries */
	Route::post('enquiry/submit', array('as' => 'enquiry.submit','uses' => 'EnquiryController@submit'));
	Route::get('earlyaccess', array('as' => 'earlyaccess','uses' => 'EnquiryController@viewEarlyAccess'));

	/*Request Deal*/
	Route::get('requested/deals', array('as' => 'requested.deals', 'uses' => 'RequestController@requested_deals'))->before('auth');
	Route::get('request/deal', array('as' => 'request.deal', 'uses' => 'RequestController@request_deal'))->before('auth');
	Route::get('request/deal/add/{type}', array('as' => 'request.deal.add', 'uses' => 'RequestController@request_deal_add'))->before('auth');
	Route::get('request/deal/edit/{id}', array('as' => 'request.deal.edit', 'uses' => 'RequestController@request_deal_edit'))->before('auth');
	Route::post('request/deal/{id}/{type}/post', array('as' => 'request.deal.post', 'uses' => 'RequestController@request_deal_post'))->before('auth');
	Route::get('request/view/{id}', array('as' => 'request.view', 'uses' => 'RequestController@view'));

	/*Messages */
	Route::post('message/send/post/{id}/{type}', array('as' => 'send.message.post', 'uses' => 'MessageController@send_message_post'));//->before('auth');
	Route::get('message/send/{id}/{type}', array('as' => 'send.message.popup', 'uses' => 'MessageController@send_message'));//->before('auth');
	Route::get('profile/messages',array('as' => 'messages', 'uses' => 'MessageController@messages'))->before('auth');
	Route::get('profile/message/{id}',array('as' => 'message.view', 'uses' => 'MessageController@message_view'))->before('auth');
	Route::post('profile/message/{messageId}/reply/post',array('as' => 'message.reply.post', 'uses' => 'MessageController@messageReply_post'))->before('auth');

	//Route::get('profile/message/{id}/reply',array('as' => 'message.reply', 'uses' => 'MessageController@messageReply'))->before('auth');
	//Route::get('profile/sent/messages',array('as' => 'profile.sent.messages', 'uses' => 'MessageController@sentMessages'))->before('auth');
	//Route::post('profile/mesagesswitch',array('as' => 'profile.messages.switch', 'uses' => 'ProfileController@messagesSwitch'))->before('auth');


	/*Admin Panel*/
	Route::get('admin',array('as' => 'admin', 'uses' => 'AdminController@index'))->before('can:admin.view');

	/*Admin Pages*/
	Route::get('admin/pages',array('as' => 'admin.pages', 'uses' => 'AdminPageController@index'))->before('can:page.view');
	Route::get('admin/page/view/{id}',array('as' => 'admin.page.view', 'uses' => 'AdminPageController@view'))->before('can:page.view');
	Route::get('admin/page',array('as' => 'admin.page.add', 'uses' => 'AdminPageController@add'))->before('can:page.add');
	Route::get('admin/page/edit/{id}',array('as' => 'admin.page.edit', 'uses' => 'AdminPageController@edit'))->before('can:page.edit');
	Route::get('admin/page/delete/{id}',array('as' => 'admin.page.delete', 'uses' => 'AdminPageController@delete'))->before('can:page.delete');
	Route::post('admin/page',array('as' => 'admin.page.add.post', 'uses' => 'AdminPageController@add_post'))->before('csrf|can:page.add');
	Route::post('admin/page/edit/{id}',array('as' => 'admin.page.edit.post', 'uses' => 'AdminPageController@edit_post'))->before('csrf|can:page.edit');

	/*Admin Posts*/
	Route::get('admin/posts',array('as' => 'admin.posts', 'uses' => 'AdminPostController@index'))->before('can:post.view');
	Route::get('admin/post/view/{id}',array('as' => 'admin.post.view', 'uses' => 'AdminPostController@view'))->before('can:post.view');
	Route::get('admin/post',array('as' => 'admin.post.add', 'uses' => 'AdminPostController@add'))->before('can:post.add');
	Route::get('admin/post/edit/{id}',array('as' => 'admin.post.edit', 'uses' => 'AdminPostController@edit'))->before('can:post.edit');
	Route::get('admin/post/delete/{id}',array('as' => 'admin.post.delete', 'uses' => 'AdminPostController@delete'))->before('can:post.delete');
	Route::post('admin/post', array('as' => 'admin.post.add.post', 'uses' => 'AdminPostController@add_post'))->before('csrf|can:post.edit');
	Route::post('admin/post/edit/{id}',array('as' => 'admin.post.edit.post', 'uses' => 'AdminPostController@edit_post'))->before('csrf|can:post.edit');

	/*Admin Rules*/
	Route::get('admin/rules',array('as' => 'admin.rules', 'uses' => 'AdminRuleController@index'))->before('can:rule.view');
	Route::get('admin/rule/view/{id}',array('as' => 'admin.rule.view', 'uses' => 'AdminRuleController@view'))->before('can:rule.view');
	Route::get('admin/rule',array('as' => 'admin.rule.add', 'uses' => 'AdminRuleController@add'))->before('can:rule.add');
	Route::get('admin/rule/edit/{id}',array('as' => 'admin.rule.edit', 'uses' => 'AdminRuleController@edit'))->before('can:rule.edit');
	Route::get('admin/rule/delete/{id}',array('as' => 'admin.rule.delete', 'uses' => 'AdminRuleController@delete'))->before('can:rule.delete');
	Route::post('admin/rule',array('as' => 'admin.rule.add.post', 'uses' => 'AdminRuleController@add_post'))->before('csrf|can:rule.add');
	Route::post('admin/rule/edit/{id}',array('as' => 'admin.rule.edit.post', 'uses' => 'AdminRuleController@edit_post'))->before('csrf|can:rule.edit');

	/*Admin Users*/
	Route::get('admin/users',array('as' => 'admin.users', 'uses' => 'AdminUserController@index'))->before('can:user.view');
	Route::get('admin/user/view/{id}',array('as' => 'admin.user.view', 'uses' => 'AdminUserController@view'))->before('can:user.view');
	Route::get('admin/user',array('as' => 'admin.user.add', 'uses' => 'AdminUserController@add'))->before('can:user.add');
	Route::get('admin/user/edit/{id}',array('as' => 'admin.user.edit', 'uses' => 'AdminUserController@edit'))->before('can:user.edit');
	Route::get('admin/user/delete/{id}',array('as' => 'admin.user.delete', 'uses' => 'AdminUserController@delete'))->before('can:user.delete');
	Route::post('admin/user',array('as' => 'admin.user.add.post', 'uses' => 'AdminUserController@add_post'))->before('csrf|can:user.add');
	Route::post('admin/user/edit/{id}',array('as' => 'admin.user.edit.post', 'uses' => 'AdminUserController@edit_post'))->before('csrf|can:user.edit');
	Route::get('admin/users/autocomplete/{type}',array('as' => 'admin.users.autocomplete', 'uses' => 'AdminUserController@autoComplete'));
	Route::get('admin/download/users',array('as' => 'admin.users.get', 'uses' => 'AdminUserController@getUsers'))->before('can:user.view');

	/*Admin Messages*/
	Route::get('admin/user/{id}/messages/{messageType}',array('as' => 'admin.messages.view', 'uses' => 'AdminMessageController@index'))->before('can:message.view_sent');
	//Route::get('admin/user/{id}/messages/sent',array('as' => 'admin.messages.view.received', 'uses' => 'AdminMessageController@viewReceived'))->before('can:message.view-sent');
	Route::get('admin/user/{id}/messages/{messageType}/{messageId}/view',array('as' => 'admin.message.view', 'uses' => 'AdminMessageController@viewMessage'))->before('can:message.view_sent');

	/*Admin Companies*/
	Route::get('admin/companies',array('as' => 'admin.companies', 'uses' => 'AdminCompanyController@index'))->before('can:company.view');
	Route::get('admin/company/view/{id}',array('as' => 'admin.company.view', 'uses' => 'AdminCompanyController@view'))->before('can:company.view');
	Route::get('admin/company/delete/{id}',array('as' => 'admin.company.delete', 'uses' => 'AdminCompanyController@delete'))->before('can:company.delete');
	Route::get('admin/company/{id}/trash/{action}',array('as' => 'admin.company.trash', 'uses' => 'AdminCompanyController@trash'))->before('can:company.edit');

	Route::get('admin/company/{id}/aprove/{action}',array('as' => 'admin.company.approve', 'uses' => 'AdminCompanyController@approve'))->before('can:company.edit');
	Route::get('admin/company/{id}/status/{action}',array('as' => 'admin.company.status', 'uses' => 'AdminCompanyController@status'))->before('can:company.edit');
	Route::get('admin/company/{id}/featured/{action}',array('as' => 'admin.company.featured', 'uses' => 'AdminCompanyController@featured'))->before('can:company.edit');

	Route::get('admin/company/edit/{id}',array('as' => 'admin.company.edit', 'uses' => 'AdminCompanyController@edit'))->before('can:company.edit');
	Route::post('admin/company/edit/pe/{id}',array('as' => 'admin.company.pe.edit.post', 'uses' => 'AdminCompanyController@pe_edit_post'))->before('csrf|can:company.edit');
	Route::post('admin/company/edit/vc/{id}',array('as' => 'admin.company.vc.edit.post', 'uses' => 'AdminCompanyController@vc_edit_post'))->before('csrf|can:company.edit');
	Route::post('admin/company/edit/re/{id}',array('as' => 'admin.company.re.edit.post', 'uses' => 'AdminCompanyController@re_edit_post'))->before('csrf|can:company.edit');

	Route::get('admin/company/{type}', array('as' => 'admin.company.add', 'uses' => 'AdminCompanyController@add'))->before('can:company.add');
	Route::post('admin/company/pe/post', array('as' => 'admin.company.pe.add.post', 'uses' => 'AdminCompanyController@pe_add_post'))->before('csrf|can:company.add');
	Route::post('admin/company/vc/post', array('as' => 'admin.company.vc.add.post', 'uses' => 'AdminCompanyController@vc_add_post'))->before('csrf|can:company.add');
	Route::post('admin/company/re/post', array('as' => 'admin.company.re.add.post', 'uses' => 'AdminCompanyController@re_add_post'))->before('csrf|can:company.add');

	Route::get('admin/companies/autocomplete/{type}',array('as' => 'admin.companies.autocomplete', 'uses' => 'AdminCompanyController@autoComplete'))->before('can:company.view');;

	/*Admin Company Staff*/
	Route::get('admin/company/{id}/staff', array('as' => 'admin.company.staff', 'uses' => 'AdminStaffController@index'))->before('can:staff.view');
	Route::get('admin/company/{company_id}/staff/view/{id}', array('as' => 'admin.company.staff.view', 'uses' => 'AdminStaffController@view'))->before('can:staff.view');
	Route::get('admin/company/{company_id}/staff/add', array('as' => 'admin.company.staff.add', 'uses' => 'AdminStaffController@add'))->before('can:staff.add');
	Route::get('admin/company/{company_id}/staff/edit/{id}', array('as' => 'admin.company.staff.edit', 'uses' => 'AdminStaffController@edit'))->before('can:staff.edit');
	Route::get('admin/company/{company_id}/staff/delete/{id}', array('as' => 'admin.company.staff.delete', 'uses' => 'AdminStaffController@delete'))->before('can:staff.delete');
	Route::post('admin/company/{company_id}/staff/add', array('as' => 'admin.company.staff.add.post', 'uses' => 'AdminStaffController@add_post'))->before('csrf|can:staff.add');
	Route::post('admin/company/{company_id}/staff/edit/{id}', array('as' => 'admin.company.staff.edit.post', 'uses' => 'AdminStaffController@edit_post'))->before('csrf|can:staff.edit');

	/*Admin Company investments*/
	Route::get('admin/company/{id}/investments', array('as' => 'admin.company.investments', 'uses' => 'AdminInvestmentController@index'))->before('can:investment.view');
	Route::get('admin/company/{company_id}/investment/view/{id}', array('as' => 'admin.company.investment.view', 'uses' => 'AdminInvestmentController@view'))->before('can:investment.view');
	Route::get('admin/company/{company_id}/investment/add', array('as' => 'admin.company.investment.add', 'uses' => 'AdminInvestmentController@add'))->before('can:investment.add');
	Route::get('admin/company/{company_id}/investment/edit/{id}', array('as' => 'admin.company.investment.edit', 'uses' => 'AdminInvestmentController@edit'))->before('can:investment.edit');
	Route::get('admin/company/{company_id}/investment/delete/{id}', array('as' => 'admin.company.investment.delete', 'uses' => 'AdminInvestmentController@delete'))->before('can:investment.delete');
	Route::post('admin/company/{company_id}/investment/add', array('as' => 'admin.company.investment.add.post', 'uses' => 'AdminInvestmentController@add_post'))->before('csrf|can:investment.add');
	Route::post('admin/company/{company_id}/investment/edit/{id}', array('as' => 'admin.company.investment.edit.post', 'uses' => 'AdminInvestmentController@edit_post'))->before('csrf|can:investment.edit');

	/*Admin Company Attachments*/
	Route::get('admin/company/{id}/attachments', array('as' => 'admin.company.attachments', 'uses' => 'AdminAttachmentController@index'))->before('can:attachment.view');
	Route::get('admin/company/{company_id}/attachment/add', array('as' => 'admin.company.attachment.add', 'uses' => 'AdminAttachmentController@add'))->before('can:attachment.add');
	Route::get('admin/company/{company_id}/attachment/delete/{id}',array('as' => 'admin.company.attachment.delete', 'uses' => 'AdminAttachmentController@delete'))->before('can:attachment.delete');
	Route::get('admin/company/{company_id}/attachment/edit/{id}',array('as' => 'admin.company.attachment.edit', 'uses' => 'AdminAttachmentController@edit'))->before('can:attachment.edit');
	Route::post('admin/company/{company_id}/attachment/add', array('as' => 'admin.company.attachment.add.post', 'uses' => 'AdminAttachmentController@add_post'))->before('csrf|can:attachment.add');
	Route::post('admin/company/{company_id}/attachment/edit/{id}',array('as' => 'admin.company.attachment.edit.post', 'uses' => 'AdminAttachmentController@edit_post'))->before('csrf|can:attachment.edit');


	/*Admin Deals*/
	Route::get('admin/deals',array('as' => 'admin.deals', 'uses' => 'AdminDealController@index'))->before('can:deal.view');
	Route::get('admin/deal/view/{id}',array('as' => 'admin.deal.view', 'uses' => 'AdminDealController@view'))->before('can:deal.view');
	Route::get('admin/deal/delete/{id}',array('as' => 'admin.deal.delete', 'uses' => 'AdminDealController@delete'))->before('can:deal.delete');

	/*Admin Vouchers*/
	Route::get('admin/vouchers',array('as' => 'admin.vouchers', 'uses' => 'AdminVoucherController@index'))->before('can:voucher.view');
	Route::get('admin/voucher/view/{id}',array('as' => 'admin.voucher.view', 'uses' => 'AdminVoucherController@view'))->before('can:voucher.view');
	Route::get('admin/voucher',array('as' => 'admin.voucher.add', 'uses' => 'AdminVoucherController@add'))->before('can:voucher.add');
	Route::get('admin/voucher/edit/{id}',array('as' => 'admin.voucher.edit', 'uses' => 'AdminVoucherController@edit'))->before('can:voucher.edit');
	Route::get('admin/voucher/delete/{id}',array('as' => 'admin.voucher.delete', 'uses' => 'AdminVoucherController@delete'))->before('can:voucher.delete');
	Route::post('admin/voucher',array('as' => 'admin.voucher.add.post', 'uses' => 'AdminVoucherController@add_post'))->before('csrf|can:voucher.add');
	Route::post('admin/voucher/edit/{id}',array('as' => 'admin.voucher.edit.post', 'uses' => 'AdminVoucherController@edit_post'))->before('csrf|can:voucher.edit');

	/*Admin Options*/
	Route::get('admin/options',array('as' => 'admin.options', 'uses' => 'AdminOptionsController@index'))->before('can:options.view');
	Route::post('admin/options/edit',array('as' => 'admin.options.edit', 'uses' => 'AdminOptionsController@edit_options'))->before('csrf|can:options.edit');

	/*Admin Enquiry*/
	Route::get('admin/enquiries',array('as' => 'admin.enquiries', 'uses' => 'AdminEnquiryController@index'))->before('can:enquiry.view');
	Route::get('admin/enquiry/delete/{id}',array('as' => 'admin.enquiry.delete', 'uses' => 'AdminEnquiryController@delete'))->before('can:enquiry.delete');
	Route::get('admin/enquiry/{id}',array('as' => 'admin.enquiry.view', 'uses' => 'AdminEnquiryController@view'))->before('can:enquiry.view');

	/*Admin Newsletters*/
	Route::get('admin/newsletters',array('as' => 'admin.newsletters', 'uses' => 'AdminNewsletterController@index'))->before('can:newsletter.view');
	Route::get('admin/newsletter/view/{id}',array('as' => 'admin.newsletter.view', 'uses' => 'AdminNewsletterController@view'))->before('can:newsletter.view');
	Route::get('admin/newsletter',array('as' => 'admin.newsletter.add', 'uses' => 'AdminNewsletterController@add'))->before('can:newsletter.add');
	Route::get('admin/newsletter/edit/{id}',array('as' => 'admin.newsletter.edit', 'uses' => 'AdminNewsletterController@edit'))->before('can:newsletter.edit');
	Route::get('admin/newsletter/delete/{id}',array('as' => 'admin.newsletter.delete', 'uses' => 'AdminNewsletterController@delete'))->before('can:newsletter.delete');
	Route::post('admin/newsletter',array('as' => 'admin.newsletter.add.post', 'uses' => 'AdminNewsletterController@add_post'))->before('csrf|can:newsletter.add');
	Route::post('admin/newsletter/edit/{id}',array('as' => 'admin.newsletter.edit.post', 'uses' => 'AdminNewsletterController@edit_post'))->before('csrf|can:newsletter.edit');
	Route::get('admin/newsletter/use/{id}',array('as' => 'admin.newsletter.use', 'uses' => 'AdminNewsletterController@newsletterUse'))->before('can:newsletter.use');
	Route::post('admin/newsletter/submit/{id}',array('as' => 'admin.newsletter.submit', 'uses' => 'AdminNewsletterController@submit'))->before('csrf|can:newsletter.use');

	/*Admin Notifications*/
	Route::get('admin/notifications',array('as' => 'admin.notifications', 'uses' => 'AdminNotificationController@index'))->before('can:notification.view');

	/*Admin Requests*/
	Route::get('admin/requests',array('as' => 'admin.requests', 'uses' => 'AdminRequestController@index'))->before('can:request.view');
	Route::get('admin/request/view/{id}',array('as' => 'admin.request.view', 'uses' => 'AdminRequestController@view'))->before('can:request.view');
	Route::get('admin/request/approve/{id}/{status}',array('as' => 'admin.request.approve', 'uses' => 'AdminRequestController@approve'))->before('can:request.edit');

	//Mail Notification
	Route::get('mail/notification',array('as' => 'mail.notification.view', 'uses' => 'NotificationController@view_notification_mail'));
});