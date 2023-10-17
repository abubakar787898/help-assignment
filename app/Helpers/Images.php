<?php

namespace App\Helpers;

use TheSeer\Tokenizer\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;


class Images
{
    // public static function upload_images($original_path, $large_path, $medium_path, $small_path, $request_file, $id, $table_field, $table_name)
    public static function upload_images($original_path, $large_path, $medium_path, $small_path, $request_file, $id, $table_field, $table_name)
    {

        // To increasew memory for larger image
        ini_set('memory_limit', '256M');

        // saving new file extention .png to have minimumal size
        $extension = ".png";

        $file_name = $request_file->getClientOriginalName();
        $file_name = pathinfo($file_name, PATHINFO_FILENAME);
        $file_name = $id . '-' . time() . '-' . $file_name . $extension;

        //Original
        //Log::debug("creating dir");

        self::createDirecrtory(public_path()."/". $original_path);

        $image = ImageManagerStatic::make($request_file);
        $savedImageUri = public_path()."/" . $original_path . "/" . $file_name;
        
        $image = ImageManagerStatic::make($request_file)->save($savedImageUri, 100, 'jpg');

        $path = Storage::disk('s3')->putFileAs($original_path, $savedImageUri, $file_name);
        //$path ? Log::debug('upload to ' . $original_path . "/" . $file_name) : Log::error('Error to ' . $original_path . "/" . $file_name);

        //Log::debug("savedImageUri after DS upload");
        //Log::debug($savedImageUri);

        // $path = Storage::disk('s3')->putFileAs($original_path, $request_file, $file_name);
        $path = Storage::disk('s3')->putFileAs($original_path, $savedImageUri, $file_name);
        //$path ? Log::debug('upload to ' . $original_path . "/" . $file_name) : Log::error('Error to ' . $original_path . "/" . $file_name);

        //Log::debug("savedImageUri after DS upload");
        //Log::debug($savedImageUri);

        // Log::debug($storagePath);
        //Log::debug('$storagePath');
        // Large Size Image Path
        ImageManagerStatic::make($request_file)->resize(1400, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })
            // ->encode('jpg', 60)
            ->save($savedImageUri, 100, 'jpg');
        // $storagePath = Storage::disk('s3')->put("{$large_path}/{$file_name}", $lgImage, 'public');
        $path = Storage::disk('s3')->putFileAs($large_path, $savedImageUri, $file_name);
        //$path ? Log::debug('upload to ' . $large_path) : Log::error('Error to ' . $large_path);

        //Medium Size Image Path
        ImageManagerStatic::make($request_file)->resize(900, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($savedImageUri, 100, 'jpg');
        // $storagePath = Storage::disk('s3')->put("{$medium_path}/{$file_name}", $mdImage, 'public');
        // $storagePath ? Log::debug('upload to ' . $medium_path) : Log::error('Error to ' . $medium_path);
        $path = Storage::disk('s3')->putFileAs($medium_path, $savedImageUri, $file_name);
        //$path ? Log::debug('upload to ' . $medium_path) : Log::error('Error to ' . $medium_path);

        //Small Size Image Path
        ImageManagerStatic::make($request_file)->resize(400, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($savedImageUri, 100, 'jpg');

        $path = Storage::disk('s3')->putFileAs($small_path, $savedImageUri, $file_name);
        //$path ? Log::debug('upload to ' . $small_path) : Log::error('Error to ' . $small_path);

        self::update_data($table_name, $table_field, $file_name, $id);

        $image->destroy();
        unlink($savedImageUri);
    }

    public static function update_data($table_name, $table_field, $file_name, $id)
    {
        DB::table($table_name)->where('id', $id)->update([$table_field => $file_name]);
    }

    public static function createDirecrtory($path)
    {
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
    }
    // public static function delete_images_by_name($original_path, $large_path, $medium_path, $small_path, $file_name)
    /**
     * forst arguemnts changed to array so we can send paths array
    */
    public static function delete_images_by_name($paths, $file_name=null)
    {
        try {

            if ($file_name !== '') {

                foreach($paths as $path) {

                    $path = $path . "/" . $file_name;
                    if (Storage::disk('s3')->exists($path)) Storage::disk('s3')->delete($path);

                }

                // $path = $large_path . "/" . $file_name;
                // if (Storage::disk('s3')->exists($path)) Storage::disk('s3')->delete($path);

                // $path = $medium_path . "/" . $file_name;
                // if (Storage::disk('s3')->exists($path)) Storage::disk('s3')->delete($path);

                // $path = $small_path . "/" . $file_name;
                // if (Storage::disk('s3')->exists($path)) Storage::disk('s3')->delete($path);
            }
        } catch (Exception $exception) {

            //Log::debug("Fil existing error" . public_path() . $paths[0] . $file_name);
            //Log::debug("Exceptio nemssage" . $exception->getMessage());
        }
    }
}
