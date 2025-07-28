<?php

namespace App\Jobs;

use FFMpeg\FFMpeg;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Intervention\Image\Drivers\Imagick\Driver;

class MediaUpload implements ShouldQueue
{
    use  Queueable, Dispatchable,  SerializesModels, SerializesModels, InteractsWithQueue;
    protected string  $extension;
    protected string $filename;
    protected string   $relativepath;

    /**
     * Create a new job instance.
     */
    public function __construct(string $extension, string $filename, string   $relativepath)
    {
        $this->extension = $extension;
        $this->filename = $filename;
        $this->relativepath = $relativepath;
        Log::info('Job construit', [
            'filename' => $filename,
            'relat' =>  $relativepath
        ]);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {


        try {
            $absolutepath = storage_path('app/public/' . $this->relativepath);


            if (in_array($this->extension, ['jpg', 'jpeg', 'png',])) {

                $manager = new ImageManager(new Driver());
                $Image = $manager->read($absolutepath);


                $Image->resize(1000, 750, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $Image->save($absolutepath, 90);
            } elseif (in_array($this->extension, ['mp4', 'webm'])) {

                if (!file_exists($absolutepath)) {
                    mkdir($absolutepath, 0755, true);
                }

                $ffmpeg = FFMpeg::create(
                    [
                        'ffmpeg.binaries'  => '/usr/bin/ffmpeg',
                        'ffprobe.binaries' => '/usr/bin/ffprobe',
                        'timeout' => 3600,
                        'log_level' => 'debug',
                    ]
                );
                $video = $ffmpeg->open($absolutepath);
                $video->filters()->resize(new \FFMpeg\Coordinate\Dimension(854, 480))
                    ->synchronize();
                $thumbnaildir = storage_path('app/public/thumbnails');

                if (!file_exists($thumbnaildir)) {
                    mkdir($thumbnaildir, 0755, true);
                }

                $thumbnailpath = $thumbnaildir . '/' . pathinfo($this->filename, PATHINFO_FILENAME) . '.jpg';
                $frame = $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(30));
                $frame->save($thumbnailpath);

                $format = new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264');
                $format->setKiloBitrate(1000);

                $encodePath = str_replace('.' . $this->extension, '_convert.mp4', $absolutepath);

                $video->save($format, $encodePath);
            }
        } catch (\Throwable $e) {
            Log::error('Erreur dans handle MediaUpload', [
                'message' => $e->getMessage(),
                'race' => $e->getTraceAsString(),

            ]);
        }
    }
}
