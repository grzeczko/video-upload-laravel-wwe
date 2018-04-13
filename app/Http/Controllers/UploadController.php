<?php

namespace App\Http\Controllers;

use App\Video;
use App\Http\Requests\UploadRequest;
use Carbon\Carbon;
use FFMpeg;
use FFMpeg\FFProbe;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
  public function uploadSubmit(UploadRequest $request)
  {
    if ($request->hasFile('video')) {
          $randName = Carbon::now()->timestamp;
          $uploadDir = '/uploads/';
          $location = $randName . '.mp4';
          $fullPath = public_path() . $uploadDir . $location;

          // check if 'uploads/' directory exists. If not, create it.
          if(!File::exists(public_path() . $uploadDir)) {
            File::makeDirectory(public_path() . $uploadDir, $mode = 0777, true, true);
          }

          $file = $request->file('video');
          $file->move(public_path() . $uploadDir, $location);

          $title = $request->input('title');

          // get video thumbnail
          FFMpeg::fromDisk('upload')
            ->open($location)
            ->getFrameFromSeconds(10)
            ->export()
            ->toDisk('upload')
            ->save($randName . '.png');

          // get video duration
          $ffprobe = FFProbe::create();
          $duration = $ffprobe->format($fullPath)
            ->get('duration');
          $duration = Carbon::createFromTimestampUTC($duration)
            ->toTimeString();

          // get video filesize
          $filesize = File::size($fullPath);
          $filesize = $this->formatBytes($filesize);

          // get video bitrate
          $bitrate = $ffprobe->format($fullPath)
            ->get('bit_rate');
          $bitrate = $this->formatBytes($bitrate);

          $video = new Video();
          $video->title = $title;
          $video->filename = htmlspecialchars($file->getClientOriginalName());
          $video->location = $uploadDir . $location;
          $video->thumbnail = $uploadDir . $randName . '.png';
          $video->duration = $duration;
          $video->filesize = $filesize;
          $video->bitrate = $bitrate;
          $video->save();

          return redirect('/')
            ->withSuccess('Successfully uploaded!')
            ->with([
              'title' => $title
            ]);

      }
  }

  // private functions
  private function formatBytes($size, $precision = 2)
  {
      $base = log($size, 1024);
      $suffixes = array('', 'K', 'M', 'G', 'T');

      return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
  }
}
