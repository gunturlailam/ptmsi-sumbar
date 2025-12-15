<?php

use App\Models\UserModel;

if (!function_exists('is_email_registered')) {
    function is_email_registered($email)
    {
        $userModel = new UserModel();
        return $userModel->where('email', $email)->first() !== null;
    }
}
