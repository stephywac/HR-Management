<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('editor');
    }

    public function codeRun()
    {

        //if (isset($_POST['code']) === true) {
            //$code = (string) $_POST['code'];
           
           
        //     $code = trim($code);
        
           
        //     ob_start();
        //     eval($code);
        //     $buffer = ob_get_clean();
        
         
        //     $error = error_get_last();
        //     if($error > 0) {
             
        //         $error['error'] = getErrorName($error['type']);
        //         $jsonError = json_encode($error, true);
                
        //         echo strtoupper($error['error']);
        //         header('Z-Error: '. $jsonError);
        //     } else {
        //         echo $buffer;
        //     }
        // }

        $language = strtolower($_POST['language']);
        $code = $_POST['code'];
          
        $random = substr(md5(mt_rand()), 0, 7);
        $filePath =storage_path('temp').$random . "." . $language;
        $programFile = fopen($filePath, "w");
        fwrite($programFile, $code);
        fclose($programFile);
            
        if($language == "php") {
            $output = shell_exec("php.exe $filePath");
           echo $output;
           // echo "Your Answer: $output";
        }
        if($language == "python") {
            $output = shell_exec("python.exe $filePath ");
            echo $output;
        }
        if($language == "node") {
            rename($filePath, $filePath.".js");
            $output = shell_exec("node $filePath.js ");
            echo $output;
        }
        if($language == "c") {
        //    $tempOutputFile = storage_path('test.exe');
        //     shell_exec("gcc $filePath");
        //     $output = shell_exec($tempOutputFile);
        //     echo $output;
          $tempOutputFile= Storage::disk('public')->put($random . ".exe", $filePath);
          shell_exec("gcc $filePath -o $tempOutputFile");
          $output = shell_exec($tempOutputFile);
          echo  $output;
            
        }
        if($language == "cpp") {
            // $outputExe = $random . ".exe";
            // shell_exec("g++ $filePath -o $outputExe");
            // $output = shell_exec(__DIR__ . "//$outputExe");
            // echo $output;
            $tempOutputFile= Storage::disk('public')->put($random . ".exe", $filePath);
            shell_exec("g++ $filePath -o $tempOutputFile");
            $output = shell_exec($tempOutputFile);
            echo $output;
        }
    }

 
}
