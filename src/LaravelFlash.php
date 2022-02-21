<?php

namespace Jambasangsang\Flash;



class LaravelFlash
{

    const SUCCESS = 'success';
    const INFO = 'info';
    const WARNING = 'warning';
    const ERROR = 'error';

    public function message(String $icon = 'information', String $type = '#2cbcff', String $message = null)
    {
        if (session()->has('messages')) {
            $messages = session()->pull('messages');
        }

        $messages[] = $message = ['icon' => $icon, 'type' => $type, 'message' => $message];

        session()->flash('messages', $messages);

        return $message;
    }

    public function messages()
    {
        return self::hasMessages() ? session()->pull('messages') : [];
    }

    public function hasMessages()
    {
        return session()->has('messages');
    }

    public function withSuccess($message)
    {
        return self::message($icon = 'checked', '#26d68a', $message);
    }

    public function withInfo($message)
    {
        return self::message($icon = 'information','#2cbcff', $message);
    }

    public function withWarning($message)
    {
        return self::message($icon = 'complain','#ffa533', $message);
    }

    public function withError($message)
    {
        return self::message($icon = 'cancel','#f44336', $message);
    }

    public function render()
    {
        return view('vendor.flash.flash')->with('messages', self::messages());
    }
}
