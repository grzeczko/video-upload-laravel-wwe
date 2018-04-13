# video-upload-laravel-wwe

#### Run the following commands
```bash
composer install
```
```bash
npm install
```
```bash
php artisan migrate
```

In your environment file (.env), change the `FFMPEG_BINARIES` and `FFPROBE_BINARIES` to the appropriate directories where `FFMPEG` and `FFPROBE` are located on your machine.
```bash
FFMPEG_BINARIES=C:\ffmpeg\bin\ffmpeg.exe
FFPROBE_BINARIES=C:\ffmpeg\bin\ffprobe.exe
```
