      @foreach($users as $user)
	                        <a href="/user/{{$user->user_id}}}" class="person">
                        <div class="person-photo" style="background-image: url(/storage/avatar/{{$user->avatar}})">
                            @if(!$user->isOnline())
                            <span class="offline status" style="background-color: #ca3d3d;" title="Офлайн"></span>
                            @else
                            <span class="status" title="Онлайн"></span>
                            @endif
                            </div>
                        <span>{{$user->name}}</span>
                    </a>
	       @endforeach
	              
	         <span  id="cf" style="display:none">{{$count}}</span>