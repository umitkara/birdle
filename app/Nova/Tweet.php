<?php

namespace App\Nova;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasManyThrough;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Tweet extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Tweet::class;

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
            BelongsTo::make('User', 'user', 'App\Nova\User')->sortable(),
            Textarea::make('Tweet Body', 'body')->rules('string', 'max:240', 'nullable'),
            Select::make('Tweet Type', 'type')
                ->options([
                    'tweet' => 'Tweet',
                    'reply' => 'Reply',
                    'retweet' => 'Retweet',
                    'quote' => 'Quote',
                ]),
            // number of likes
            Number::make('Likes', function () {
                return $this->likes()->count();
            }),
            Number::make('Retweets', function () {
                return $this->retweets()->count();
            }),
            Number::make('Replies', function () {
                return $this->replies()->count();
            }),
            DateTime::make('Created At')->sortable()->hideWhenUpdating()->default(function () {
                return now();
            }),
            DateTime::make('Updated At')->hideFromIndex()->default(function () {
                return now();
            }),
            Number::make('Original Tweet ID', 'original_tweet_id')->min(0)->hideFromIndex(),
            Number::make('Parent Tweet ID', 'parent_id')->min(0)->hideFromIndex(),
            HasMany::make('Likes', 'likes', 'App\Nova\Like')->hideWhenCreating()->hideWhenUpdating(),
            HasMany::make('Replies', 'replies', 'App\Nova\Tweet')->hideWhenCreating()->hideWhenUpdating(),
            HasMany::make('Media', 'media', 'App\Nova\Media')->hideWhenCreating()->hideWhenUpdating(),
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
