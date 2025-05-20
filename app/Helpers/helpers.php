<?php

// if (!function_exists('formatCurrency')) {
//     /**
//      * Format the given amount as currency.
//      *
//      * @param float|int $amount The amount to be formatted
//      * @param string $currency The currency symbol (default is USD)
//      * @return string The formatted currency string
//      */
//     function formatCurrency($amount, $currency = 'USD') {
//         // Format the amount to two decimal places
//         return number_format($amount, 2) . ' ' . $currency;
//     }
// }

// optional two

// if (!function_exists('formatCurrency')) {
//     /**
//      * Format the given amount as currency.
//      *
//      * @param float|int $amount The amount to be formatted
//      * @param string $currency The currency symbol (default is USD)
//      * @return string The formatted currency string
//      */
//     function formatCurrency($amount, $currency = 'USD') {
//         // Format the amount to two decimal places and append the currency symbol
//         return number_format($amount, 2) . ' ' . $currency;
//     }
// }


// optional three


// if (!function_exists('formatCurrency')) {
//     function formatCurrency($amount, $currency = null) {
//         // Get the default currency from config if not passed
//         $currency = $currency ?? config('app.currency', 'USD');
//         return number_format($amount, 2) . ' ' . $currency;
//     }
// }

if (!function_exists('formatCurrency')) {
    /**
     * Format the given amount as currency.
     *
     * @param float|int $amount The amount to be formatted
     * @param string|null $currency The currency symbol (optional)
     * @return string The formatted currency string
     */
    function formatCurrency($amount, $currency = null) {
        // Get the default currency from config if not passed
        $currency = $currency ?? config('app.currency', 'USD');
        // Return the formatted string with currency before the amount
        return $currency . ' ' . number_format($amount, 2);
    }




}
