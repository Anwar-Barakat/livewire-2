<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class UpdateSettings extends Component
{
    public $state = [];

    public function mount()
    {
        $settings = Setting::first();
        if ($settings)
            $this->state = $settings->toArray();
    }

    public function updateSettings()
    {
        $settings = Setting::first();
        if ($settings)
            $settings->update($this->state);
        else
            Setting::create($this->state);

        Cache::forget('settings');

        $this->dispatchBrowserEvent('updated', ['message' => "Settings updated Successfully"]);
    }

    public function render()
    {
        return view('livewire.admin.settings.update-settings');
    }
}