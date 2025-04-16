<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use MoonShine\EasyMde\Fields\Markdown;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Post>
 */
class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';
    
    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make(__('Title'), 'title'),
            Image::make(__('Images'), 'images')->multiple()
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make(__('Title'), 'title'),
                Markdown::make(__('Content'), 'content'),
                Image::make(__('Images'), 'images')
                    ->dir('posts/images')
                    ->removable()
                    ->multiple()

            ])
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make(__('Title'), 'title'),
            Text::make(__('Content'), 'content'),
            Image::make(__('Images'), 'images')->multiple()
        ];
    }

    /**
     * @param Post $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
