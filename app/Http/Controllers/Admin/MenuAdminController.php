<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuAdminController extends ParentAdminController
{

    public function index()
    {
        $this->data['menus'] = Menu::all();
        return view('admin.examples.menu.index',$this->data);
    }


    public function create()
    {
        return view('admin.examples.menu.create',$this->data);
    }

    public function store(StoreMenuRequest $request)
    {
        try {
            $menu = new Menu();
            $menu->name = $request->name;
            $menu->route = $request->route;
            $menu->order = $request->order;

            $menu->save();
            return redirect()->back()->with('success','You have successfully inserted a menu!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error','There was an error inserting menu!');
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $this->data['oneMenu'] = Menu::find($id);
        return view('admin.examples.menu.edit',$this->data);
    }

    public function update(StoreMenuRequest $request, $id)
    {
        try {
            $menu = Menu::find($id);
            $menu->name = $request->name;
            $menu->route = $request->route;
            $menu->order = $request->order;

            $menu->save();
            return redirect()->back()->with('success','You have successfully updated a menu!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error','There was an error updating menu!');
        }
    }

    public function destroy($id)
    {
        try {
            Menu::destroy([$id]);
            return redirect()->back()->with('success','You have successfully deleted a menu!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error','There was an error deleted menu!');
        }

    }
}
