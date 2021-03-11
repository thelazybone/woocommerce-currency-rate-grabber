<?php 


require_once 'includes/phpQuery-onefile.php';


// register hook
add_action( 'wp', 'curency_cron_activation' );


function curency_cron_activation() {
    if ( ! wp_next_scheduled( 'curency_upd_cron' ) )
        wp_schedule_event( time(), 'hourly', 'curency_upd_cron' );
}

add_action( 'curency_upd_cron', 'available_currencies' );

function available_currencies(){
    //$currency_numbers = get_option('alg_wc_cpp_total_number');
    // 4 curencies

$daily_exchange_json = file_get_contents('http://www.floatrates.com/daily/qar.json');
$daily_exchange = json_decode($daily_exchange_json, true);

		$currency_arr = $daily_exchange[$currency_symb_key];
        $currency_rate = round($currency_arr['inverseRate'], 2);




            // set rates to option
            update_option('alg_wc_cpp_exchange_rate_' . $i, $currency_rate);

echo '<pre>';
	var_dump($daily_exchange['usd']);
echo '</pre>';
/*
    for($i = 0; $i < 4; $i++ ){
        $currency_symb = get_option('alg_wc_cpp_currency_' . $i);



        if($currency_symb != 'USD'){
            $currency_symb_key = strtolower($currency_symb);

            $currency_arr = $daily_exchange[$currency_symb_key];
            $currency_rate = round($currency_arr['inverseRate'], 2);




            // set rates to option
            update_option('alg_wc_cpp_exchange_rate_' . $i, $currency_rate);


        }

    }
*/

}
available_currencies();
/*
$pq = phpQuery::newDocument($daily_exchange);


$currency_container = $pq->find('#GridView1');
$currency_html = $currency_container->html();

echo 'good connection';

echo '<pre>';
	var_dump($currency_container);
echo '</pre>';

*/