<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category' => 'exists:categories,name',
            'price'    => 'numeric',
            'limit'    => 'in:lt,gt,eq', // Lower than, greater than
        ];
    }

    public function passedValidation()
    {
        if($this->exists('category'))
        {
            $this->merge(['category' => Category::where('name', $this->category)->first()]);
        }

        if ($this->exists('price')) {
            if (!is_integer($this->price)) {
                $price = (int) round($this->price * 100);
            } else {
                $price = ((int) $this->price) * 100;
            }

            $price = abs($price);
            $limit = '<';

            if ($this->exists('limit')) {
                $limit = match ($this->limit) {
                    'gt'    => '>',
                    'eq'    => '=',
                    default => '<',
                };
            }

            $this->merge(['price' => $price, 'limit' => $limit]);
        }
    }
}
