<?php
return array(
    // set your paypal credential
    'client_id' => 'AUZllmRNxz6esN3eSzPMdOGY9n_aiwkpzNHxCs97pqbnQyr3OM3dZhngzXktPrHbmx8aH1i11uaXYkVs',
    'secret' => 'ELSkok8yasadmT5KuUM2hRjZYh5uvujh-9Zn-mF7lZWqVZblyEvv9DO-ylxZBXw9pfti7b1c0PDbACSs',

    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
         'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);