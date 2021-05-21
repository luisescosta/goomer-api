<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Hours implements Rule
{


    public $messageError;
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
        if(!is_array($value)){
            return false;
        }

        foreach ($value as $v){
            if(!array_key_exists('day', $v) || !$this->isDay($v['day'])){
                $this->messageError = "day não é valido";
                return false;
            }

            if(!array_key_exists('from', $v) || !$this->isHour($v['from'])){
                $this->messageError = "from não é valido";
                return false;
            }

            if(!array_key_exists('to', $v) || !$this->isHour($v['to'])){
                $this->messageError = "to não é valido";
                return false;
            }
        }

        if(!$this->isMinuteValid($value)){
            $this->messageError = 'Os horários devem possuir intervalo mínimo de 15 minutos';
            return false;
        }
        return true;
    }

    public function isDay($value): bool {
        if(!is_numeric($value)){
            return false;
        }

        if($value >= 1 && $value <= 7){
            return true;
        }
        return false;

    }

    public function isHour($hour): bool {

        $hour = explode(':', $hour);

        if(count($hour) > 2 || count($hour) < 2){
            return false;
        }

        foreach ($hour as $h){

            if(!is_numeric($h)){
                return false;
            }

            if($h < 0 && $h < 24){
                return false;
            }

            if(strlen($h) !== 2){
                return false;
            }
        }
        return true;
    }

    public function isMinuteValid($hours): bool {
        foreach ($hours as $hour){
            $now        = date('Y-m-d');
            $to         = explode(':', $hour['to']);
            $from       = explode(':', $hour['from']);
            $start      = date_create("$now $from[0]:$from[1]:00");
            $end        = date_create("$now $to[0]:$to[1]:00");
            $diff       = date_diff($end,$start);
            $minutes    = $diff->days * 24 * 60 * 60;
            $minutes    += $diff->h * 60;
            $minutes    += $diff->i;
            if($minutes < 15){
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->messageError;
    }
}
