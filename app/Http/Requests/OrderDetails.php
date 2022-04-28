<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderDetails extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'name' => 'required|max:100|min:3',
          'network' => 'required|in:Jazz,Telenor,Ufone,Zong',
          'number' => "required",
          'cnic' => 'required|min:15|max:15|regex:/^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/',
          'receipt' => 'nullable|required_if:paymentMethod,IBFT|file|mimes:jpg,png,jpeg,pdf,bmp'
        ];
    }
    public function messages(){
      return [
        'name.required' => 'Please provide your name',
        'name.max' => 'Name can only be 100 characters long',
        'name.min' => 'Name must atleast contain 3 characters',
        'network.required' => 'Please select network',
        'network.in' => 'Network not found',
        'number.required' => 'Please provide your number',
        'cnic.required' => 'Please provide your cnic number as per pattern',
        'cnic.min' => 'Wrong Cnic',
        'cnic.max' => 'Wrong Cnic ',
        'cnic.regex' => 'Incorrect Cnic',
        'receipt.required_if' => 'Please upload receipt',
      ];
    }
}
