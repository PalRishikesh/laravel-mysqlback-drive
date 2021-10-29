<?php

namespace App\Jobs;

use App\Model\BackupFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class BackupSqlFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        //Store sql file to google drive
        try {
            $fileBackup  = BackupFile::find($this->id);
            $filePath = storage_path() . '/' . $fileBackup->path;
            Storage::disk("google")->putFileAs("", $filePath, $fileBackup->path);
            $fileBackup->update(["status" => 1]);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }
}
