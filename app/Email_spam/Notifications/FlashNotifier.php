<?php


namespace App\Email_spam\Notifications;


use Illuminate\Session\Store;

class FlashNotifier {

    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function message($message,  $level = 'info')
    {
        $this->session->flash('flash_notification.message', $message);
        $this->session->flash('flash_notification.level', $level);
    }

    public function success($message)
    {
        $this->message($message, 'success');
    }

    public function error($message)
    {
        $this->message($message, 'danger');
    }

    public function warning($message)
    {
        $this->message($message, 'warning');
    }
}