<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $configs = [
            [
                'name' => 'allow_login',
                'value' => 'true',
                'model' => null,
                'seeds' => 'true,false',
                'field_type' => 'select'
            ],
            [
                'name' => 'allow_registration',
                'value' => 'true',
                'model' => null,
                'seeds' => 'true,false',
                'field_type' => 'select'
            ],
            [
                'name' => 'allow_deposit',
                'value' => 'true',
                'model' => null,
                'seeds' => 'true,false',
                'field_type' => 'select'
            ],
            [
                'name' => 'allow_withdrawal',
                'value' => 'true',
                'model' => null,
                'seeds' => 'true,false',
                'field_type' => 'select'
            ],
            [
                'name' => 'referral_commission',
                'value' => '10',
                'model' => null,
                'seeds' => null,
                'field_type' => 'input:number'
            ],
            [
                'name' => 'referral_type',
                'value' => 'percentage',
                'model' => null,
                'seeds' => 'percentage,fixed',
                'field_type' => 'select'
            ],
            [
                'name' => 'contact_number',
                'value' => '08033003300',
                'model' => null,
                'seeds' => null,
                'field_type' => 'input:number'
            ],
            [
                'name' => 'contact_email',
                'value' => 'user@example.com',
                'model' => null,
                'seeds' => null,
                'field_type' => 'input:email'
            ],
            [
                'name' => 'min_withdrawal_amount_activity',
                'value' => 5000,
                'model' => null,
                'seeds' => null,
                'field_type' => 'input:number'
            ],
            [
                'name' => 'min_withdrawal_amount_referral',
                'value' => 500,
                'model' => null,
                'seeds' => null,
                'field_type' => 'input:number'
            ],
            [
                'name' => 'registration_course',
                'value' => 1,
                'model' => 'App\Models\Course',
                'seeds' => null,
                'field_type' => 'select'
            ],
            [
                'name' => 'sub_referral_commission',
                'value' => 5,
                'model' => null,
                'seeds' => null,
                'field_type' => 'input:number'
            ],
            [
                'name' => 'allow_cashback',
                'value' => 'true',
                'model' => null,
                'seeds' => 'true,false',
                'field_type' => 'select'
            ],
            [
                'name' => 'cashbback_amount',
                'value' => '50',
                'model' => null,
                'seeds' => null,
                'field_type' => 'input:number'
            ],
            [
                'name' => 'cashback_type',
                'value' => 'percentage',
                'model' => null,
                'seeds' => 'percentage,fixed',
                'field_type' => 'select'
            ],
        ];
        Config::insert($configs);
    }
}
