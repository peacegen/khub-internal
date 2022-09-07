<?php

if(!function_exists('banner')) {
    function banner($message, $type = 'success')
    {
        session()->flash('banner', [
            'message' => $message,
            'type' => $type,
        ]);
    }
}
