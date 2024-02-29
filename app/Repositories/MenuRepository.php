<?php

namespace App\Repositories;
use App\Repositories\UtilsRepository;

use App\Models\Menu;
use App\Models\MenuCategory;

class MenuRepository
{
    private $utilsRepository;

    public function __construct(UtilsRepository $utilsRepo)
    {
        $this->utilsRepository = $utilsRepo;
    }

    public function getCategory()
    {
        $categories = MenuCategory::OrderBy('id', 'desc')->get();
        return $categories;
    }

    public function get()
    {
        $menu = Menu::OrderBy('id', 'desc')->paginate(10);
        return $menu;
    }

    public function find($id)
    {
        $menu = Menu::find($id);
        return $menu;
    }

    public function sync($menu)
    {
        $sync = $this->utilsRepository->getmenu($menu);

        if ($sync == false) {
            return false;
        } 
        $menu->name = $sync->name;
        $menu->is_veg = $sync->veg;
        $menu->price = $sync->price;
        $menu->description = $sync->description;
        $menu->image = $sync->image;
        $menu->qty = $sync->qty;
        $menu->update();
        return true;
    }

    public function syncAll($request)
    {
        $sync = $this->utilsRepository->getAllMenu($request);

    }
}