<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use App\Models\Setting;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\UI\Fields\Color;
use MoonShine\UI\Fields\Enum;
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Range;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Setting>
 */
class SettingResource extends ModelResource
{
    protected string $model = Setting::class;

    protected string $title = 'Settings';
    
    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Color::make(__('Background color'), 'background_color'),
            Checkbox::make(__('Toggle'), 'toggle'),
            Enum::make(__('Type'), 'type')->attach(StatusEnum::class),
            Phone::make(__('phone'), 'phone')->mask('9 (999) 999 99-99'),
            Text::make(__('age_from'), 'age_from'),
            Text::make(__('age_from'), 'age_to'),
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
                Color::make(__('Background color'), 'background_color'),
                Checkbox::make(__('Toggle'), 'toggle'),
                Enum::make(__('Type'), 'type')->attach(StatusEnum::class),
                Password::make(__('password'), 'password'),
                Phone::make(__('phone'), 'phone')->mask('9 (999) 999 99-99'),
                Range::make(__('age_from'), 'age_from')
                    ->fromTo('age_from', 'age_to')
                    ->fill([
                        'age_from' => $this->getItem()?->age_from ?? 0, 
                        'age_to' => $this->getItem()?->age_to ?? 1
                    ]),
            ])
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            Color::make(__('Background color'), 'background_color'),
            Checkbox::make(__('Toggle'), 'toggle'),
            Enum::make(__('Type'), 'type')->attach(StatusEnum::class),
            Phone::make(__('phone'), 'phone')->mask('9 (999) 999 99-99'),
            Text::make(__('age_from'), 'age_from'),
            Text::make(__('age_from'), 'age_to'),
        ];
    }

    /**
     * @param Setting $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
