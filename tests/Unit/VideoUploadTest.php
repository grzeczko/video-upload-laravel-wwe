<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class VideoUploadTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testVideoUpload()
    {
        $user = factory(Video::class)->create([
          'title' => 'Video Test',
        ]);

        $this->assertDatabaseHas('videos', ['title' => 'Video Test']);
    }
}
