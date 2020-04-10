<?php

namespace App\Domain\Source;

class ThirdPartyServiceProvider extends Provider
{
    public function fetch(): void
    {
        // I will describe rather than using actual 3rd party library implementation.
        // On first stage, I will use curl to fetch the data from the 3rd party
        // end point, after that W will process the json or xml response from it
        // and iterate over the response data with main purpose to parse it as appropriate
        // format for our application.
    }
}