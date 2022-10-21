<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Browsershot\Browsershot;
use Wnx\SidecarBrowsershot\BrowsershotLambda;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $content = view('welcome', [])->render();

        $browsershotPdf = Browsershot::html($content)
            ->margins(10, 18, 18, 10)
            ->format('A4')
            ->scale(0.8)
            ->showBackground()
            ->base64pdf();

        $browsershotDecode = base64_decode($browsershotPdf);

        $this->assertEquals($browsershotPdf, base64_encode($browsershotDecode));

        $lambdaPdf = BrowsershotLambda::html($content)
            ->margins(10, 18, 18, 10)
            ->format('A4')
            ->scale(0.8)
            ->showBackground()
            ->base64pdf();

        $lambdaDecode = base64_decode($lambdaPdf);

        $this->assertEquals($lambdaPdf, base64_encode($lambdaDecode));
    }
}
