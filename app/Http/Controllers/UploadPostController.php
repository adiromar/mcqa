<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UploadPost;
// use Session;
class UploadPostController extends Controller
{
  
    public function uploadFile(Request $request){

    if ($request->input('submit') != null ){

      $file = $request->file('file');

      // File Details 
      $filename = $file->getClientOriginalName();
      $extension = $file->getClientOriginalExtension();
      $tempPath = $file->getRealPath();
      $fileSize = $file->getSize();
      $mimeType = $file->getMimeType();

      // Valid File Extensions
      $valid_extension = array("csv");

      // 2MB in Bytes
      $maxFileSize = 2097152; 

      // Check file extension
      if(in_array(strtolower($extension),$valid_extension)){

        // Check file size
        if($fileSize <= $maxFileSize){

          // File upload location
          $location = 'uploads/questions';

          // Upload file
          $file->move($location,$filename);

          // Import CSV to Database
          $filepath = public_path($location."/".$filename);

          // Reading file
          $file = fopen($filepath,"r");

          $importData_arr = array();
          $i = 0;

          while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
             $num = count($filedata );
             
             // Skip first row (Remove below comment if you want to skip the first row)
             if($i == 0){
                $i++;
                continue; 
             }
             for ($c=0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata [$c];
             }
             $i++;
          }
          fclose($file);
          // echo '<pre>';
          // print_r($importData_arr);
          // Insert to MySQL database
         foreach($importData_arr as $importData){

            $insertData = array(
               "category_id"=>$importData[0],
               "post_name"=>$importData[1],
               "category_name"=>$importData[2],
               "option_a"=>$importData[3],
               "option_b"=>$importData[4],
               "option_c"=>$importData[5],
               "option_d"=>$importData[6],
               "correct_option"=>$importData[7],
               "created_at"=>'2019-03-29 07:08:08',
               "updated_at"=>'2019-03-29 07:08:08'
             );
            // print_r($insertData);die;
            UploadPost::insertData($insertData);

          }
          return redirect()->action('PostsController@index')->with('success', 'Upload Successful.');
          // Session::flash('message','Import Successful.');
        }else{
          return redirect()->action('PostsController@index')->with('warning', 'File too large. File must be less than 2MB.');
          // Session::flash('message','File too large. File must be less than 2MB.');
        }

      }else{
        return redirect()->action('PostsController@index')->with('danger', 'Invalid File Extension.');
         // Session::flash('message','Invalid File Extension.');
      }

    }else{
        return redirect()->action('PostsController@index')->with('warning', 'Please Upload a File.');
    }

    // Redirect to index
    return redirect()->action('PostsController@index');
  }



//   upload in category table

  public function uploadCategory(Request $request){

    if ($request->input('upload') != null ){

      $file = $request->file('file');

      // File Details 
      $filename = $file->getClientOriginalName();
      $extension = $file->getClientOriginalExtension();
      $tempPath = $file->getRealPath();
      $fileSize = $file->getSize();
      $mimeType = $file->getMimeType();

      // Valid File Extensions
      $valid_extension = array("csv");

      // 2MB in Bytes
      $maxFileSize = 2097152; 

      // Check file extension
      if(in_array(strtolower($extension),$valid_extension)){

        // Check file size
        if($fileSize <= $maxFileSize){

          // File upload location
          $location = 'uploads/category';

          // Upload file
          $file->move($location,$filename);

          // Import CSV to Database
          $filepath = public_path($location."/".$filename);

          // Reading file
          $file = fopen($filepath,"r");

          $importData_arr = array();
          $i = 0;

          while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
             $num = count($filedata );
             
             // Skip first row (Remove below comment if you want to skip the first row)
             if($i == 0){
                $i++;
                continue; 
             }
             for ($c=0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata [$c];
             }
             $i++;
          }
          fclose($file);
          // echo '<pre>';
          // print_r($importData_arr);
          // Insert to MySQL database
          $slug = '';
         foreach($importData_arr as $importData){
          $slug = str_replace(' ', '_', $importData[0]);
          $slug = strtolower($slug);
            $insertData = array(
               "category_name"=>$importData[0],
               "slug"=>$slug,
               "created_at"=>'2019-03-29 07:08:08',
               "updated_at"=>'2019-03-29 07:08:08'
             );
            // print_r($insertData);die;
            UploadPost::insertcat($insertData);

          }

          // Session::flash('message','Import Successful.');
          return redirect()->action('CategoryController@index')->with('success', 'Category Upload Successful.');
        }else{
          return redirect()->action('CategoryController@index')->with('warning', 'File too large. File must be less than 2MB.');
          // Session::flash('message','File too large. File must be less than 2MB.');
        }

      }else{
        return redirect()->action('CategoryController@index')->with('danger', 'Invalid File Extension');
         // Session::flash('message','Invalid File Extension.');
      }

    }else{
        return redirect()->action('CategoryController@index')->with('danger', 'Error Occurred While Upload.');
    }
    // Redirect to index
    return redirect()->action('CategoryController@index');
  }
}
