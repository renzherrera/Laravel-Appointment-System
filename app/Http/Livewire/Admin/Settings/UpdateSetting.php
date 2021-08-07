<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class UpdateSetting extends Component
{
    public $state = [];
    public function mount() {
      $setting = Setting::first();

      if($setting){
         $this->state = $setting->toArray();
      }
    }
    public function render()
    {
        return view('livewire.admin.settings.update-setting');
    }

    public function updateSetting() {

        $setting = Setting::first();

        if($setting){
            $setting->update($this->state);
            $this->dispatchBrowserEvent('updated',['message'=> 'Settings updated successfully!']);

        }else{
            Setting::create($this->state);
            $this->dispatchBrowserEvent('updated',['message'=> 'Settings created successfully!']);

        }

        Cache::forget('setting');


    }
}
