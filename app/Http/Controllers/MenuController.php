<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;


class MenuController extends Controller
{
    private $menuRepository;

    public function __construct(MenuRepository $menuRepo)
    {
        $this->menuRepository = $menuRepo;
    }

    public function index(Request $request)
    {
        $menuLists = $this->menuRepository->get($request);
        $categories = $this->menuRepository->getCategory()->pluck('category','category');
        return view('pages/menu/index', compact('menuLists','categories'));
    }

    public function sync($id)
    {
        // try {
            $menu = $this->menuRepository->find($id);
            if (!$menu) {
                return back()->with('error', 'Not Found');
            }
            $menu = $this->menuRepository->sync($menu);
            if ($menu == false) {
                return back()->with('error', 'Not Found');
            }
            return redirect()->route('menu.index')->with('success', 'Menu synced successfully.');
        // } catch (\Throwable $th) {
        //     return redirect()->route('menu.index')->with('error', 'Menu synced Failed.');
        // }
    }

    public function syncAll(Request $request)
    {
        try {
            $menu = $this->menuRepository->syncAll($request);
            
            return redirect()->route('menu.index')->with('success', 'Menu synced successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('menu.index')->with('error', 'Menu synced Failed.');
        }

    }
}