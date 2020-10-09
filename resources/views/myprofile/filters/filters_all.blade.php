                       <tr>
                            <th>Фото:</th>
                            <th>Название события:</th>
                            <th>Раздел:</th>
                            <th>Дата:</th>
                        </tr>
                        @foreach($events as $event)
                            <tr>
                            <td style="width: 100px;"><img src="{{asset('storage/avatar/'.$event->user->person->avatar)}}" style="max-width: 100px;"></td>
                            <td>{!!$event->title!!}</td>
                            <td><span class="table-span-bold">Мои связи444</span></td>
                            <td><span class="table-span-bold">{{$event->created_at}}</span></td>
                        </tr>
                        @endforeach
                         <p style="display:none" id="counter">1</p>
                