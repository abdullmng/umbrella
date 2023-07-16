<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'model',
        'seeds',
        'field_type'
    ];

    public function title(): Attribute
    {
        return Attribute::make(get: fn ($val, $att) => str_replace('_', ' ', $att['name']));
    }

    public function data(): Attribute
    {
        return Attribute::make(get: function ($val, $att) {
            if (!is_null($att['seeds']))
            {
                $seeds = explode(',', $att['seeds']);
                $data = [];
                foreach ($seeds as $seed)
                {
                    $data[] = ['id' => $seed, 'name' => $seed];
                }
                return $data;
            }

            if (!is_null($att['model']))
            {
                return $att['model']::get(['id', 'name'])->toArray();
            }

            return [];
        });
    }

    public function trueValue(): Attribute
    {
        return Attribute::make(get: function ($val, $att) {
            if (!is_null($att['model']))
            {
                return $att["model"]::where("id", $att['value'])->first()?->name;
            }
            else
            {
                return $att["value"];
            }
        });
    }
}
