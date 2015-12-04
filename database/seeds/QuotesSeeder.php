<?php

use App\Quote;
use Illuminate\Database\Seeder;
use Unirest\Request as HTTPRequest;
class QuotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HTTPRequest::verifyPeer(env('UNIREST_VERIFYPEER'));
        //Get 10 quotes, from a Mashape API
        for($i = 0;$i < 10;$i++) {
            $response = HTTPRequest::post("https://andruxnet-random-famous-quotes.p.mashape.com/cat=famous",
                array(
                    "X-Mashape-Key" => env('MASHAPE_KEY'),
                    "Content-Type" => "application/x-www-form-urlencoded",
                    "Accept" => "application/json"
                )
            );

            Quote::create([
                "content" => $response->body->quote,
                "author" => $response->body->author,
                "source" => "https://andruxnet-random-famous-quotes.p.mashape.com/cat=famous"
            ]);

        }
    }
}
