                   @foreach($events as $event)
                            <tr>
                            <td><img src="{{asset('storage/avatar/'.$event->user->person->avatar)}}" style="max-width: 100px;"></td>
                            <td>{!!$event->title!!}</td>
                            <td><span class="table-span-bold">Мои связи</span></td>
                            <td><span class="table-span-bold">{{$event->created_at}}</span></td>
                        </tr>
                        @endforeach