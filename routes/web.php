<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\BackupFile;
use App\Comment;
use App\Jobs\BackupSqlFile;
use App\Log;
use App\Notifications\InvoicePaid;
use App\User;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});
Route::post('upload', function (Request $request) {
    Storage::disk("google")->putFileAs("",$request->file('thing'),"AAA.sql");
    // dd($request->file('thing')->store("",'google'));
});

Route::get('/e',function(){
    // $a = BackupFile::first();
    // return $a;
    $a=storage_path();
    // $a = shell_exec("whoami");
    // return $a;
    // dd(realpath("."));
    $dbUserName = env('DB_USERNAME');
    $dbPassword = env('DB_PASSWORD');
    $dbDatabase = env('DB_DATABASE');
    $dbHost = env('DB_HOST');

    $date = date('Y_m_d');
    $fileName =  $dbDatabase . '_'.$date.'.sql';

    
    // $cmd = 'mysqldump  -h '.$dbHost.' -u ' . $dbUserName . ' -p ' . $dbDatabase . ' > /home/rishi/Desktop/' . $dbDatabase . '.'.$date.'.sql';
    $cmd='mysqldump  --defaults-file=/home/rishi/Desktop/.my.cnf1 -u root -h '.$dbHost.' '.$dbDatabase.'> '.$a.'/' . $fileName;
    $result = shell_exec($cmd);
    $backup = new BackupFile();
    $backup->path = $fileName;
    $backup->save();

    BackupSqlFile::dispatch($backup->id);

    // shell_exec("Root@1234");
    dd($cmd);
    // echo shell_exec("php artisan config:clear");
});