<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\GlobalSettings;

    use Config;
    use DB;
    use Session;

class InstallController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public  function index()
    {
        if(DB::connection()->getDatabaseName() != 'db_name')
        {
           return redirect(route('login'));
        } else {
            return redirect()->route('step0');
        }
    }

    public function step0() {
        return view('install.step0');
    }

    public function step1() {
        return view('install.step1');
    }

    public function step3(Request $request) {
        $db_connection = "";
        $data = $request->all();

        if ($data) {

            $hostname = $data['hostname'];
            $username = $data['username'];
            $password = $data['password'];
            $dbname   = $data['dbname'];
            // check db connection using the above credentials
            $db_connection = $this->check_database_connection($hostname, $username, $password, $dbname);
            if ($db_connection == 'success') {
                // proceed to step 4
                session(['hostname' => $hostname]);
                session(['username' => $username]);
                session(['password' => $password]);
                session(['dbname' => $dbname]);
                return redirect()->route('step4');
            } else {
                
                return view('install.step3', ['db_connection' => $db_connection]);
            } 
        }

        return view('install.step3', ['db_connection' => $db_connection]);
    }


    public function check_database_connection($hostname, $username, $password, $dbname) {

        $newName = uniqid('db'); //example of unique name

        Config::set("database.connections.".$newName, [
            "host"      => $hostname,
            "port"      => env('DB_PORT', '3306'),
            "database"  => $dbname,
            "username"  => $username,
            "password"  => $password,
            'driver'    => env('DB_CONNECTION', 'mysql'),
            'charset'   => env('DB_CHARSET', 'utf8mb4'),
        ]);
        try {
            DB::connection($newName)->getPdo();
            return 'success';
        } catch (\Exception $e) {
            return 'Could not connect to the database.  Please check your configuration.';
        }
    }

    public function step4(Request $request) {

        return view('install.step4');
    }


    public function confirmImport($param1='')
    {
        if ($param1 = 'confirm_import') {
            // write database.php
            $this->configure_database();

            // redirect to admin creation page
            return view('install.install');
        }
    }

    public function confirmInstall()
    {
        // run sql
        $this->run_blank_sql();

        // redirect to admin creation page
        return redirect()->route('finalizing_setup');
    }

    public function configure_database() {
        // write database.php
        // $data_db = file_get_contents('./config/database.php');
        $data_db = file_get_contents(base_path('config/database.php'));
        $data_db = str_replace('db_name',    session('dbname'),    $data_db);
        $data_db = str_replace('db_user',    session('username'),    $data_db);
        $data_db = str_replace('db_pass',    session('password'),    $data_db);
        $data_db = str_replace('db_host',    session('hostname'),    $data_db);
        file_put_contents(base_path('config/database.php'), $data_db);
        // file_put_contents('./config/database.php', $data_db);
    }

    public function run_blank_sql() {
        
        // Set line to collect lines that wrap
        $templine = '';
        // Read in entire file
        // $lines = file('./public/assets/install.sql');
        $lines = file(base_path('public/assets/install.sql'));
        // Loop through each line
        foreach ($lines as $line) {
        // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '')
                continue;
                // Add this line to the current templine we are creating
                $templine .= $line;
            // If it has a semicolon at the end, it's the end of the query so can process this templine
            if (substr(trim($line), -1, 1) == ';') {
                // Perform the query
                DB::statement($templine);
                
                // Reset temp variable to empty
                $templine = '';
            }
        }
    }

    public function finalizingSetup(Request $request) {

        $data = $request->all();
        if ($data) {

            /*session data*/
            // $session_data['session_title'] = $data['current_session'];
            // $session_data['status'] = 1;

            // $session_id = DB::table('sessions')->insertGetId(array('session_title' => $session_data['session_title'], 'status' => $session_data['status']));

            // $system_data['running_session'] = $session_id;

            $system_data['system_name']  = $data['system_name'];
            // $system_data['timezone']  = $data['timezone'];
            if (session('purchase_code')) {
                $system_data['purchase_code']  = session('purchase_code');
            }

            foreach($system_data as $key => $global_data){
                GlobalSettings::where('key', $key)->update([
                    'value' => $global_data,
                ]);
            }

            /*superadmin data*/
            $superadmin_data['name']      = $data['name'];
            // $superadmin_data['image']      = $data['image'];
            $superadmin_data['email']     = $data['email'];
            $superadmin_data['password']  = password_hash($data['password'], PASSWORD_DEFAULT);
            $superadmin_data['role_id']  = 1;
            
            User::insert($superadmin_data);


            return redirect()->route('success');

        }

        return view('install.finalizing_setup');
    }

    public function success($param1 = '') {
        $this->configure_routes();

        if ($param1 == 'login') {
            return view('auth.login');
        }

        $superadmin_email = User::first()->email;

        $page_data['email'] = $superadmin_email;
        $page_data['page_name'] = 'success';
        return view('install.success', ['admin_email' => $superadmin_email]);
    }

    public function configure_routes() {
        $data_routes = file_get_contents(base_path('routes/web.php'));
        $data_routes = str_replace("Route::get('/', 'index')",    "Route::get('/install_ended', 'index')",    $data_routes);
        file_put_contents(base_path('routes/web.php'), $data_routes);
    }
}
