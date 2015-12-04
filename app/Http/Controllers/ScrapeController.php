<?php

namespace App\Http\Controllers;

use App\Quote;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jobs\ShowerthoughtsScrapeJob;

class ScrapeController extends Controller
{
    public function scrape() {
        $job = new ShowerthoughtsScrapeJob('https://www.reddit.com/r/Showerthoughts.json?limit=100');
        $this->dispatch($job);
        return Quote::all();
    }
}
