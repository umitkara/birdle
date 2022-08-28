<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Media extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Spatie\MediaLibrary\MediaCollections\Models\Media::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('UUId', 'uuid')->hideFromIndex()->hideWhenUpdating()->hideWhenCreating(),
            Text::make('Name'),
            Text::make('File Type', function () {
                return $this->extension;
            }),
            Text::make('File Size', function () {
                $rawSize = $this->size;
                $size = $rawSize / 1000;
                $size = round($size, 2);
                if ($size > 1000) {
                    $size = $size / 1000;
                    $size = round($size, 2);
                    $size = $size . ' MB';
                } else {
                    $size = $size . ' KB';
                }
                return $size;
            }),
            Text::make('Raw Size', 'size')->hideFromIndex(),
            Text::make('File Path', function () {
                return $this->getPath();
            })->hideFromIndex(),
            Image::make('File', function () {
                return $this->id . '/' . $this->file_name;
            })->hideFromIndex()->disableDownload(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
