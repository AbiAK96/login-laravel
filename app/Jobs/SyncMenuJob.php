<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Menu;

class SyncMenuJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $menu;

    public function __construct($menu)
    {
        $this->menu = $menu;
    }

    public function handle()
    {
        $existingMenu = Menu::where('api_id',$this->menu->id)->first();
        if ($existingMenu) {
            $existingMenu->name = $this->menu->name;
            $existingMenu->is_veg = $this->menu->veg;
            $existingMenu->price = $this->menu->price;
            $existingMenu->description = $this->menu->description;
            $existingMenu->image = $this->menu->image;
            $existingMenu->qty = $this->menu->qty;
            $existingMenu->update();
        } else {
            $newMenu = new Menu();
            $newMenu->name = $this->menu->name;
            $newMenu->is_veg = $this->menu->veg;
            $newMenu->price = $this->menu->price;
            $newMenu->description = $this->menu->description;
            $newMenu->image = $this->menu->image;
            $newMenu->qty = $this->menu->qty;
            $newMenu->save();
        }
    }
}
