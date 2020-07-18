@foreach($users as $user)

								<tr>
									<td>{{$user->id}}</td>
									<td>{{$user->name}}</td>
									<td><a href="/admin/user/edit/{{$user->id}}">{{$user->email}}</a></td>
									<td>{{$user->mob_tel}}</td>
									<td>{{ Carbon\Carbon::parse($user->created_at)->format('d.m.Y') }}</td>
									@if(!empty($user->person->active))
									@if($user->person->active==3)
									<td><img src="{{asset('asset/admin/resources/images/icons/cross_circle.png')}}" title="Заблокирован по собственному желанию" />
									</td>
									@endif
									
										@if($user->person->active==2)
									<td><img src="{{asset('asset/admin/resources/images/icons/cross_circle.png')}}" title="Заблокирован" />
									</td>
									@endif
										@if($user->person->active==1)
									<td><img src="{{asset('asset/admin/resources/images/icons/tick_circle.png')}}" title="Активный" />
									</td>
									@endif
								
										@if($user->person->active==0)
									<td><img src="{{asset('asset/admin/resources/images/icons/exclamation.png')}}" title="Не подтвержден" />
									</td>
									@endif
									
									@endif
									<td>
										<!-- Icons -->
										<a href="#messages_send" rel="modal" onclick="show_email_name('<? echo $user->email?>', '<? echo $user->name?>')" title="Отправить сообщение"><img src="{{asset('asset/admin/resources/images/icons/mail.png')}}" alt="Edit" /></a>&nbsp;&nbsp;&nbsp;
										<a href="user/edit/{{$user->id}}" title="Редактировать"><img src="{{asset('asset/admin/resources/images/icons/pencil.png')}}" alt="Edit" /></a>&nbsp;&nbsp;&nbsp;
										<a data-action="delete" href="http://test.myldl.ru/admin/user_delete/11836" title="Удалить"><img src="http://test.myldl.ru/application/views/admin/resources/images/icons/cross.png" alt="Delete" /></a>
									</td>
								</tr>
							@endforeach
							