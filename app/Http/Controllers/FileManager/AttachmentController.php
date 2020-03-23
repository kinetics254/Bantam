<?php

namespace App\Http\Controllers\FileManager;

use App\Attachment;
use App\Http\Controllers\BaseController;
use App\Http\Resources\AttchmentResource;
use Illuminate\Http\Request;

class AttachmentController extends BaseController
{
   public function __construct($model = Attachment::class, $resource = AttchmentResource::class)
   {
       parent::__construct($model, $resource);
   }

}
