<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Menu;
use App\Message;
use Auth;
class NavigationComposer
{
    public function compose(View $view)
    {
        $menuitems = Menu::isLive()
            ->ofSort(['parent_id' => 'asc', 'sort_order' => 'asc'])
            ->get();

        $menuitems = $this->buildTree($menuitems);
         $message_unread=0;
         if(Auth::check())
         {
        $message_unread = Message::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', auth()->id())
            ->where('read', 0)
            ->groupBy('from')
            ->count();
         }
        return $view->with(['menuitems'=>$menuitems,'count_unread'=>$message_unread]);
    }

    public function buildTree($items)
    {
        $grouped = $items->groupBy('parent_id');

        foreach ($items as $item) {
            if ($grouped->has($item->id)) {
                $item->children = $grouped[$item->id];
            }
        }

        return $items->where('parent_id', null);
    }
}