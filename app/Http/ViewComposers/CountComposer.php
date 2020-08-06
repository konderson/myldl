<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Menu;
use App\Message;
use Auth;
use App\Frend;
use App\Service;
use App\Dela;
use App\Help;
use App\DeloFeatured;
class CountComposer
{
    public function compose(View $view)
    {
        $c_frend=Frend::where('user_id',Auth::user()->id)->count();
		$c_serv=Service::where('user_id',Auth::user()->id)->count();
		$c_dala=Dela::where('user_id',Auth::user()->id)->count();
		$c_help=Help::where('user_id',Auth::user()->id)->count();
		$c_fdelo=DeloFeatured::where('user_id',Auth::user()->id)->count();
		 $c_message = Message::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', auth()->id())
            ->where('read', 0)
            ->groupBy('from')
            ->count();
         
        return $view->with(['c_frend'=>$c_frend,'c_serv'=>$c_serv,'c_dala'=>$c_dala,'c_help'=>$c_help,'c_fdelo'=>$c_fdelo,'c_message'=>$c_message]);
    }

    
}