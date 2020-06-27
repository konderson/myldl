
@foreach($services as $serv)
                

	            	                            <div class="advert-row">
                    <div class="date"><span>{{ Carbon\Carbon::parse($serv->created_at)->format('d.m') }}</span></div>
                        <a class="advert-row-body-title" href="/usluga/{{$serv->id}}">{{$serv->title}}</a>
                    <div class="image">
                        <img src="{{asset('storage/help/'.$serv->getPhoto($serv->images))}}"/>
                    </div>
                    <div class="advert-row-body">
                        <p class="adv-info">{{ substr($serv->description, 0, 150)}}...</p>
                        <div class="price-info">
                            <p>Город: <span>{{$serv->city}}</span></p>
                        </div>
                    </div>
                </div>
	            	                            
	            @endforeach
	            <div class="advert-pages">
	            {{ $services->links('paginate') }}
</div>