@foreach($diaries as $diary)
				        <div class="advert-row news-row">
                    <div class="date"><span>{{ Carbon\Carbon::parse($diary->created_at)->format('d.m') }}</span></div>
                    <div class="advert-row-body news-row-body">
                        <a class="advert-row-body-title" href="/diary/item/{{$diary->id}}">{{$diary->name}}</a>
                        <p class="adv-info">{!!  strip_tags (mb_substr($diary->text, 0, 150))!!}....</p>
                    </div>
                    <div class="deal-views" style="margin-top: 0px; margin-left: 7%; margin-right: 0%;">
                        <img src="https://myldl.ru/static/images/like.png"/>
                        <span class="like_c">{{$diary->likeCount($diary->id)}}</span>
                        <img src="https://myldl.ru/static/images/dislike.png"/>
                        <span class="dislike_c">{{$diary->dislikeCount($diary->id)}}</span>
                        <span>Коментарии ({{$diary->getCount($diary->id)}})</span>
                    </div>
					</div>
			 @endforeach

			 