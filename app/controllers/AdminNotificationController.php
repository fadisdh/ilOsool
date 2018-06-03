<?php

class AdminNotificationController extends BaseController {

	public function index()
    {
    	$notifications = AdminNotification::orderBy('created_at', 'desc')->paginate(Config::get('ilosool.rows_default'));

        return View::make('admin.notification.index')->with('notifications', $notifications);
    }
}