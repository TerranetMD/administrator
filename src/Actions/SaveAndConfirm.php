<?php

namespace Terranet\Administrator\Actions;

use App\Models\Duplicate;
use App\Models\Place;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Terranet\Administrator\Contracts\Module;
use Terranet\Administrator\Traits\Actions\BatchSkeleton;
use Terranet\Administrator\Traits\Actions\Skeleton;

class SaveAndConfirm
{

    use Skeleton, BatchSkeleton;

    /**
     * Delete collection elements.
     *
     * @param Model $eloquent
     * @param Request $request
     *
     * @return mixed
     */
    public function handle(Model $eloquent, Request $request)
    {
        $placeData = $request->all();

        foreach ($placeData as $key => $place) {
            if ($key === "collection") {

                foreach ($place as $id) {
                    echo "ID: " . $id . "\n";
                    $duplicate = Duplicate::find($id);
                    if ($duplicate) {

                        $newPlace = new Place();
                        $newPlace->title = $duplicate->title;
                        $newPlace->description = $duplicate->description;
                        $newPlace->city_id = $duplicate->city_id;
                        $newPlace->tag_id = $duplicate->tag_id;
                        $newPlace->spend_time = $duplicate->spend_time;
                        $newPlace->save();

                        $duplicate->delete();

                        //echo "Создано новое место с ID: " . $newPlace->id . " из дубликата с ID: " . $duplicate->id . "\n";
                    }

                }
                //dd('');
            }
        }


        return $place;
    }

    /**
     * Удаляет дубликаты для данного места.
     *
     * @param int $placeId
     * @return void
     */
    protected function removeDuplicates(int $placeId)
    {
        Duplicate::where('place_id', $placeId)->delete();
    }

    /**
     * Проверяет, авторизовано ли сохранение.
     *
     * @param Model $eloquent
     * @return bool
     */
    protected function canSave(Model $eloquent)
    {
        /** @var Module $resource */
        $resource = app('scaffold.module');

        return $resource->actions()->authorize('save', $eloquent);
    }

    /**
     * Получает коллекцию для сохранения.
     *
     * @param Model $eloquent
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model[]
     */
    protected function fetchForDelete(Model $eloquent, Request $request)
    {
        return $eloquent->newQueryWithoutScopes()
            ->whereIn('id', $request->get('collection', []))
            ->get();
    }

    /**
     * @return string
     */
    protected function icon()
    {
        return 'fa-plus';
    }

}
