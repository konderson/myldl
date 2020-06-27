<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Menu;


class MenuController extends Controller
{
    public function index()
    {
        $output="<tr>
				<td valign='top'>
				    <ul class='tree_lvl_2'>";
				    
         $menues_main=Menu::where('parent_id',null)->orderBy('sort_order','asc')->get();
         $sub_menus=Menu::where('parent_id','>','0')->get();
         foreach( $menues_main as $menu_m)
         {
             $output.="<li><a id='$menu_m->id' url='$menu_m->url'>$menu_m->name</a> (
             ) +
				        <ul class='subnav'>";
				        foreach($sub_menus as $s_menu)
				        {
				            if($s_menu->parent_id==$menu_m->id)
				            {
				               $output.="<li><a href='$s_menu->url'>$s_menu->name</a></li>
				               ";
				            }
				        }
				        $output.="</ul></li>";
         }
        $output.="</ul></td>";
        
        return view('admin.menu.index',compact('output'));
    }
    
    public function store(Request $request)
    {
        $menu=new Menu();
        if(isset($request->p_id))
        {
           $menu->parent_id=$request->p_id;
        }
        else{
            $menu->parent_id=null;
        }
        $menu->name=$request->nazva;
        $menu->live=$request->active;
        $menu->url=$request->banner;
        $menu->save();
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $menu=Menu::findOrFail($request->p_id);
        $menu->name=$request->nazva;
        $menu->live=$request->active;
        $menu->url=$request->banner;
        $menu->save();
        return redirect()->back();
    }
}