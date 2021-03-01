<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\GoogleClient;
use Google_Service_Drive;

class DriveController extends Controller
{
    protected $client;

    public function __construct(GoogleClient $client)
    {
        $this->client = $client->getClient();
    }

    public function index()
    {
        return view('blog');
    }
}
