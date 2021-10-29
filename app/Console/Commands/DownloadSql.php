<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Storage;
use App\Model\BackupFile;
use App\Comment;
use App\Jobs\BackupSqlFile;

use Illuminate\Console\Command;

class DownloadSql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mysql:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command help to download mysql back';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $storagePath = storage_path();
            $dbUserName = env('DB_USERNAME');
            $dbDatabase = env('DB_DATABASE');
            $dbHost = env('DB_HOST');
            $date = date('Y_m_d');
            $fileName =  $dbDatabase . '_' . $date . '.sql';

            $defaultMysqlFilePassword = env("DEFAULT_FILE_MYSQL_PASSWORD");
            $mysqlDumpCommand = 'mysqldump  --defaults-file=' . $defaultMysqlFilePassword . ' -u ' . $dbUserName . ' -h ' . $dbHost . ' ' . $dbDatabase . '> ' . $storagePath . '/' . $fileName;

            shell_exec($mysqlDumpCommand);
            $backup = new BackupFile();
            $backup->path = $fileName;
            $backup->save();
            BackupSqlFile::dispatch($backup->id);
        }
        catch(\Exception $e){
            \Log::info($e->getMessage());
        }
    }
}
