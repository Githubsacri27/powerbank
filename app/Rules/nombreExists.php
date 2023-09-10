<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Persona;

class nombreExists implements Rule
{
    private string $nombre;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($nombre)
    {
        $this->nombre = $nombre ?? '';
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
        return Persona::where('nombre',$value)->first();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'nombre '.($this->nombre ?? '').' no existe en la base de datos.';
    }
}
