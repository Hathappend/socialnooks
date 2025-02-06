<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = [
            'Credit Card',
            'Debit Card',
            'Cash',
            'PayPal',
            'Apple Pay',
            'Google Pay',
            'Bank Transfer',
            'Cash on Delivery',
            'Bitcoin',
            'Stripe',
            'Alipay',
            'WeChat Pay',
            'Samsung Pay',
            'Venmo',
            'Square',
            'Zelle',
            'Amazon Pay',
            'Shopify Payments',
            'Razorpay',
            'TransferWise',
            'Klarna',
            'Afterpay',
            'Paytm',
            'Ideal',
            'Giropay',
            'SEPA Direct Debit',
            'Boleto Bancário',
            'Swish',
            'Mobile Payment',
            'Gift Cards'
        ];

        foreach ($payments as $payment) {
            Payment::create([
                'name' => $payment,
            ]);
        }
    }
}
