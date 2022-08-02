<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\Requirement ;
use App\Http\Requests\Insertrequirement;


trait ImageTrait {

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function saveImage(Request $request) {
                

        $mediaAdd = new Media();        
        if($request->hasfile('media')){
            $file= $request->file('media');
            $original_file_name =$request->media->getClientOriginalName();
            $image_mimetype = $request->media->getClientMimeType();
            $image_name   = time().'_'.$request->media->getClientOriginalName();
            $image_path = public_path(). Requirement::FILE_PATH;
            request()->media->move($image_path, $image_name);
        
            $mediaAdd->name = $image_name;
            $mediaAdd->path = Requirement::FILE_PATH . $image_name;
            $mediaAdd->original_name = $original_file_name;
            $mediaAdd->mime_type = $image_mimetype;
            
            $mediaAdd->save();
        }

        return $mediaAdd ;
    }


    }

