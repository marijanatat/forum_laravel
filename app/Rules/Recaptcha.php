<?php

namespace App\Rules;

use Zttp\Zttp;
use Illuminate\Contracts\Validation\Rule;

class Recaptcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $response=Zttp::asFormParams()->post('https://google.com/recaptcha/api/siteverify',[
            'secret'=>config('services.recaptcha.secret'),
            //'response'=>$request->input('g-recaptcha-response'),-ubaceno u validaciju Thread controllera store metod
            'response'=>$value,
           // 'remoteip'=>$_SERVER['REMOTE_ADDR']
           'remoteip'=>request()->ip()
        ]);

       return  $response->json()['success'];
           
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The recaptcha verification failed';
    }
}
