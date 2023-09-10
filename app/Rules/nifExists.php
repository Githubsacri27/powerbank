<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Persona;

class nifExists implements Rule
{
    private string $nif;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($nif)
    {
        $this->nif = $nif ?? '';
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
        return Persona::where('nif',$value)->first();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute '.($this->nif ?? '').' no existe en la base de datos.';
    }
}
