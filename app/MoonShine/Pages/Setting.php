<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Enums\StatusEnum;
use App\Models\Setting as ModelsSetting;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Http\Responses\MoonShineJsonResponse;
use MoonShine\Laravel\TypeCasts\ModelCaster;
use MoonShine\Support\Enums\FormMethod;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\UI\Fields\Color;
use MoonShine\UI\Fields\Enum;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Range;

class Setting extends Page
{
    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle()
        ];
    }

    public function getTitle(): string
    {
        return $this->title ?: 'Settings';
    }

    public function getSetting()
    {
        return ModelsSetting::first();
    }

    public function store()
    {
        $this->form()->apply(fn(ModelsSetting $item) => $item->save());

        return MoonShineJsonResponse::make()->toast('Saved');
    }

    public function form(): FormBuilder
    {
        return FormBuilder::make(
                fields: [
                    Grid::make([
                        Column::make(
                            [
                                Box::make([
                                    Color::make(__('Background color'), 'background_color'),
                                    Checkbox::make(__('Toggle'), 'toggle'),
                                ]),
                            ], 
                            colSpan: 6, 
                            adaptiveColSpan: 6
                        ),
                        Column::make(
                            [
                                Box::make([
                                    Enum::make(__('Type'), 'type')->attach(StatusEnum::class),
                                    Password::make(__('Password'), 'password'),
                                    Phone::make(__('Phone'), 'phone')->mask('9 (999) 999 99-99'),
                                    Flex::make([
                                        Number::make(__('Age from'), 'age_from'),
                                        Number::make(__('Age To'), 'age_to')
                                    ])
                                ])
                            ], 
                            colSpan: 6, 
                            adaptiveColSpan: 6
                        )
                    ])

                ],
            )
                ->asyncMethod('store')
                ->fillCast($this->getSetting(), new ModelCaster(ModelsSetting::class));
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
	{
		yield $this->form();
	}
}
