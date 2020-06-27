                       <table class="table">
                        <tbody><tr>
                            <th>Фото:</th>
                            <th>Название события:</th>
                            <th>Раздел:</th>
                            <th>Дата:</th>
                        </tr>
                        @foreach($events as $event)
                            <tr>
                            <td><img src="{{asset('storage/avatar/'.$event->user->person->avatar)}}" style="max-width: 100px;"></td>
                            <td>{!!$event->title!!}</td>
                            <td><span class="table-span-bold">Мои связи</span></td>
                            <td><span class="table-span-bold">{{$event->created_at}}</span></td>
                        </tr>
                        @endforeach
                         <p style="display:none" id="counter">1</p>
                </tbody> 
                </table><button id="more_all" style="background-color: #89bc28;color:#fff;border:none;padding:5px;">Показать еще</button>