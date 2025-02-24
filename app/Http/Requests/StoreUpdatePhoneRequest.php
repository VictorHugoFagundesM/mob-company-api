<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreUpdatePhoneRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        $method = $request->method();

		// Obtém o método da requisição para diferenciar inserções de atualizações
		$request->merge([
			"_method" => $method
		]);

        return [
            "id" => ["nullable", "required_if:_method,PUT", "integer", "exists:phones,id"],
            "monthly_price" => ["required", "numeric"],
            "setup_price" => ["required", "numeric"],
            "currency" => ["required", "string", "max:5"],
            "phone" => ["required", "string", "max:50", Rule::unique('phones', 'phone')->ignore($this->id)],
        ];
    }

    protected function failedValidation(Validator $validator)
	{
		throw new ValidationException($validator, response()->json(
			'Não foi possível completar a requisição: '.$validator->errors()->first()
		, Response::HTTP_BAD_REQUEST));
	}

}
