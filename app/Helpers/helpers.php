<?php

   function getFolder()
    {
        return app()->getLocale() === 'ar' ? 'css-rtl' : 'css';
    }

    function uploadImage($folder, $image)
    {
        $image->store('/', $folder);
        $filename = $image->hashName();
       return $folder.'/'.$filename;
    }
   function deleteOldImage($folder,$oldimg)
   {
       \Illuminate\Support\Facades\Storage::disk($folder)->delete($oldimg);
   }
