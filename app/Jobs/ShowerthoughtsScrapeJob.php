<?php

namespace App\Jobs;

use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Unirest\Request as HTTPRequest;
use App\Quote;

class ShowerthoughtsScrapeJob extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create a new job instance.
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        HTTPRequest::verifyPeer(env('UNIREST_VERIFYPEER'));
        $response = HTTPRequest::get($this->url);

        $posts = $response->body->data->children;
        foreach($posts as $post){
//            dd($post->data->stickied);
            if (!$post->data->stickied){
                Quote::firstorCreate([
                    "content" => $post->data->title,
                    "author" => $post->data->author,
                    "source" => 'https://www.reddit.com'.$post->data->permalink
                ]);
            }

        }
    }
}
