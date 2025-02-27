<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class TranslationToggle extends Widget
{
    protected static string $view = 'filament.admin.widgets.translation-toggle';

    public function getViewData(): array
    {
        return [
            'currentLocale' => session('locale', 'en'),
            'locales' => ['en', 'id'],
        ];
    }

    public $localEn;
    public $localId;

    public function mount()
    {
        $locale = App::getLocale();
        if ($locale == 'id') $this->localId = 'id';
        else $this->localEn = 'en';
    }

    public function switchLocale($locale)
    {
        if ($locale == 'id') $this->localEn = '';
        else $this->localId = '';

        $validLocales = ['en', 'id'];
        if (in_array($locale, $validLocales)) {
            App::setLocale($locale);
            Session::put('locale', $locale);
            App::setLocale($locale);

            return redirect('/');
        }
    }
}
