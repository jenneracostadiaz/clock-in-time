<?php

namespace App\Support\Settings;

enum Translation: string
{
    case SIGN_IN = 'Sign in';
    case SIGN_UP = 'Sign up';
    case EMAIL_ADDRESS = 'Email Address';
    case PASSWORD = 'Password';
    case CONFIRM_PASSWORD = 'Confirm Password';
    case FORGOT_PASSWORD = 'Forgot your password?';
}
