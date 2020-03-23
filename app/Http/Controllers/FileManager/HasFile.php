<?php


namespace App\Http\Controllers\FileManager;


use App\Attachment;
use App\Http\Resources\AttchmentResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait HasFile
{
    public function hasFiles(Request $request) : bool
    {
        return count($request->allFiles()) > 0;
    }

    public function saveFiles(Model $model, array $files)
    {
        try{
            foreach ($files as $file){
                    $attachment = new Attachment();
                    $attachment->model = self::getModelName($model);
                    $attachment->model_id =$model->id;
                    $attachment->attachment = $file->getClientOriginalName();

                    if (Storage::disk('public')->exists("attachments/".self::getModelName($model)."/" . $model->id . '/' . $attachment->attachment))
                        $attachment->attachment = uniqid().'.'.$file->getClientOriginalExtension();

                    Storage::disk('public')->put("attachments/".self::getModelName($model)."/" . $model->id . '/' . $attachment->attachment, file_get_contents($file));
                    $attachment->save();
            }
            return count($files);
        }catch (\Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function getFiles(Model $model)
    {
        return AttchmentResource::collection(Attachment::where([
            'model' => self::getModelName($model),
            'model_id' => $model->id
        ])->get());
    }

    /**
     * @param Model $model
     * @return string
     */
    public static function getModelName(Model $model) : string
    {
        $class_parts = explode('\\', get_class($model));
        return end($class_parts);
    }
}
