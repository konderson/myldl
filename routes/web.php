<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('welcome');
});

Route::get('/','MainController@index')->name('main.index')->middleware(['verified']);
Route::get('/search','MainController@search')->name('search');
Route::get('/site_rules','MainController@site_rules');

Route::get('/profile/index','ProfileController@index')->name('profile.index')->middleware(['verified','auth']);
Route::get('/profile/profile_view','ProfileController@profileView')->name('profile.view')->middleware(['verified','auth']);;
Route::get('/profile/edit','ProfileController@profileEdit')->name('profile.edit')->middleware(['verified','auth']);;
Route::put('/profile/edit/{id}','ProfileController@profileUpdate')->name('profile.update')->middleware(['verified','auth']);;
Route::post('/profile/avatar/ajax_upload','ProfileController@ajax_upload_avatar')->middleware(['verified','auth']);

Route::get('/profile/settings','ProfileController@settings')->middleware(['verified','auth']);;
Route::post('/profile/settings/check_psw','ProfileController@check_psw')->middleware(['verified','auth']);;
Route::post('/profile/settings/password','ProfileController@chengePsw')->middleware(['verified','auth']);;
Route::get('/profile/block','ProfileController@UBlockAccount')->middleware(['verified','auth']);
Route::get('/profile/unblockblock_owner','ProfileController@UnBlockAccount')->middleware(['auth']);
Route::get('/profile/delete','ProfileController@DeleteAccount')->middleware(['verified','auth']);


Route::get('/affairs','DelaController@all')->name('dala.all');
Route::get('/profile/mydelo','DelaController@mydelo')->name('profile.mydelo')->middleware(['verified','auth']);;
Route::get('/profile/add_delo','DelaController@addDelo')->name('profile.adddelo')->middleware(['verified','auth']);;
Route::post('/profile/store_delo','DelaController@addStore')->name('profile.delo.store')->middleware(['verified','auth']);;
Route::get('/profile/edit/delo/{id}','DelaController@edit')->name('profile.delo.edit')->middleware(['verified','auth']);;
Route::get('/profile/delete/delo/{id}','DelaController@delete')->name('profile.delo.delete')->middleware(['verified','auth']);;
Route::put('/profile/delo/upload','DelaController@update')->name('profile.update.edit')->middleware(['verified','auth']);;
Route::post('/profile/ajax_dela','DelaController@ajaxDela')->name('profile.delo.ajax')->middleware(['verified','auth']);;
Route::post('/profile/ajax_upload','DelaController@ajax_upload_avatar')->name('profile.ajax_upload_avatar')->middleware(['verified','auth']);;
Route::get('/profile/ajax_lenta','ProfileController@ajaxFilter')->middleware(['verified','auth']);;
Route::get('/profile/ajax_lenta_all','ProfileController@ajaxFilterAll')->middleware(['verified','auth']);;




Route::get('/profile/add_idea','IdieController@add')->name('profile.add.idea')->middleware(['verified','auth']);;
Route::post('/profile/idea/store','IdieController@store')->name('profile.store.idea')->middleware(['verified','auth']);;
Route::get('/profile/edit_idea/{id}','IdieController@edit')->name('profile.edit.idea')->middleware(['verified','auth']);;
Route::put('/profile/idea/update','IdieController@update')->name('profile.idea.upload')->middleware(['verified','auth']);;
Route::get('/profile/ideas','IdieController@myIdea')->name('profile.myidea')->middleware(['verified','auth']);;
Route::get('/profile/delete/{id}','IdieController@delete')->name('profile.delete')->middleware(['verified','auth']);;


Route::get('/delo/{id}','DelaController@getDelo')->name('delo.get');
Route::get('/profile/izbranniye_dela','DelaController@featureds')->name('delo.featureds')->middleware(['verified','auth']);;
Route::get('/profile/delete/delo/izbranoe/{id}','DelaController@deleteFeatured')->middleware(['verified','auth']);;
Route::post('/profile/izbranniye_dela/add','DelaController@addFeatureds')->name('delo.featureds.add')->middleware(['verified','auth']);;
Route::get('/test/coment','CommentDelaController@test')->name('delo.coment');
Route::post('/test/coment','CommentDelaController@addcomment')->name('delo.coment.store');
Route::post('/test/coment/get','CommentDelaController@getComent')->name('delo.coment.get');
Route::post('/test/coment/getcount','CommentDelaController@getCount')->name('delo.coment.getcount');


Route::get('/profile/add_vzaimopomosh','HelpController@add')->name('help.add')->middleware(['verified','auth']);;
Route::post('/help/save','HelpController@store')->middleware(['verified','auth']);;
Route::post('/help/ajax_upload','HelpController@ajax_upload_avatar')->name('help.ajax_upload_avatar')->middleware(['verified','auth']);;
Route::post('/help/ajax_delete','HelpController@ajax_delete_photo')->name('help.ajax_delete_avatar')->middleware(['verified','auth']);;
Route::post('/help/ajax_reploadupload','HelpController@ajax_reploadupload')->name('profile.ajax_reploadupload')->middleware(['verified','auth']);;
Route::get('/profile/vzaimopomoshi','HelpController@myhelp')->name('help.my')->middleware(['verified','auth']);;
Route::put('/profile/update/{id}','HelpController@update')->name('profile.help.update')->middleware(['verified','auth']);;
Route::get('/profile/edit/{id}','HelpController@edit')->name('profile.help.edit')->middleware(['verified','auth']);;
Route::get('/searche/{id}','HelpController@getHelp')->name('profile.help.get')->middleware(['verified','auth']);;
Route::post('/help/coment','CommentHelpController@addcomment')->name('help.coment.store')->middleware(['verified','auth']);;
Route::post('/help/coment/get','CommentHelpController@getComent')->name('help.coment.get')->middleware(['verified','auth']);;
Route::post('/help/coment/getcount','CommentHelpController@getCount')->name('help.coment.getcount')->middleware(['verified','auth']);;
Route::get('/poiski','HelpController@getAllpoiski')->name('profile.help.poiski');
Route::get('/search/poiski/','HelpController@filterPoiski')->name('profile.help.poiski.filter');
Route::get('/hochu_pom','HelpController@getAllwont')->name('profile.help.hochu_pom');
Route::get('/search/hochu_pom/','HelpController@filter')->name('profile.help.hochu_pom.filter')->middleware(['verified','auth']);;
Route::get('/naxodki','HelpController@getAllNahodki')->name('profile.help.naxodki');
Route::get('/search/naxodki/','HelpController@filterNahodki')->name('profile.help.nahodki.filter');

Route::get('/profile/uslugi','ServiceController@myservice')->name('service.my')->middleware(['verified','auth']);;
Route::get('/profile/add_usluga','ServiceController@add')->name('service.add')->middleware(['verified','auth']);;
Route::post('/service/save','ServiceController@store')->middleware(['verified','auth']);;
Route::post('/service/ajax_upload','ServiceController@ajax_upload_photo')->name('service.ajax_upload_avatar')->middleware(['verified','auth']);;
Route::post('/service/ajax_delete','ServiceController@ajax_delete_photo')->name('service.ajax_delete_avatar')->middleware(['verified','auth']);;
Route::get('/close_usluga/{id}','ServiceController@close_serv')->name('service.add')->middleware(['verified','auth']);;
Route::get('/open_usluga/{id}','ServiceController@open_serv')->name('service.add')->middleware(['verified','auth']);;
Route::get('/del_usluga/{id}','ServiceController@deleteServ')->name('service.del')->middleware(['verified','auth']);;
Route::put('/usluga/update/{id}','ServiceController@update')->name('profile.service.update')->middleware(['verified','auth']);;
Route::get('/service/edit/{id}','ServiceController@edit')->name('profile.service.edit')->middleware(['verified','auth']);;
Route::get('/usluga/{id}','ServiceController@getService')->name('profile.service.get')->middleware(['verified','auth']);;
Route::post('/service/coment','ComentServiceController@addcomment')->name('serv.coment.store')->middleware(['verified','auth']);;
Route::post('/service/coment/get','ComentServiceController@getComent')->name('serv.coment.get');
Route::post('/service/coment/getcount','ComentServiceController@getCount')->name('hserv.coment.getcount');
Route::get('/search/service/','ServiceController@filter')->name('profile.service.filter');
Route::get('/services','ServiceController@getAllservice')->name('profile.service.all');


Route::get('/profile/future_business','FutureController@myfuture')->name('future.my')->middleware(['verified','auth']);;
Route::get('/profile/future_business/add','FutureController@add')->name('future.add')->middleware(['verified','auth']);;
Route::post('/future_business/store','FutureController@store')->name('future.store')->middleware(['verified','auth']);;
Route::get('/profile/future_business/edit/{id}','FutureController@edit')->name('future.edit')->middleware(['verified','auth']);;
Route::put('/profile/future_business/ubdate/{id}','FutureController@update')->name('future.update')->middleware(['verified','auth']);;
Route::get('/profile/future_business/delete/{id}','FutureController@delete')->name('future.delete')->middleware(['verified','auth']);;
Route::get('/profile/future_business/index/{id}','FutureController@index')->name('future.index')->middleware(['verified','auth']);;
Route::post('/future_business/coment','ComentFetureController@addcomment')->name('future.coment.store')->middleware(['verified','auth']);;
Route::post('/future_business/coment/get','ComentFetureController@getComent')->name('future.coment.get')->middleware(['verified','auth']);;
Route::post('/future_business/coment/getcount','ComentFetureController@getCount')->name('future.coment.getcount')->middleware(['verified','auth']);;

Route::get('/interview','InterviewController@index')->name('interview');
Route::get('/interview/item/{id}','InterviewController@item')->name('interview.item');
Route::post('/iv/coment','CommentInterController@addcomment')->name('inter.coment.store');
Route::post('/iv/coment/get','CommentInterController@getComent')->name('inter.coment.get');
Route::post('/iv/coment/getcount','CommentInterController@getCount')->name('inter.coment.getcount');

Route::get('/news','NewsController@index')->name('news');
Route::get('/news/item/{id}','NewsController@item')->name('news.item');
Route::post('/news/coment','CommentNewsController@addcomment')->name('news.coment.store');
Route::post('/news/coment/get','CommentNewsController@getComent')->name('news.coment.get');
Route::post('/news/coment/getcount','CommentNewsController@getCount')->name('news.coment.getcount');

Route::get('/diary','DiaryController@index')->name('diary');
Route::get('/diary/item/{id}','DiaryController@item')->name('diary.item');
Route::post('/diary/coment','CommentDiaryController@addcomment')->name('diary.coment.store');
Route::post('/diary/coment/get','CommentDiaryController@getComent')->name('diary.coment.get');
Route::post('/diary/coment/getcount','CommentDiaryController@getCount')->name('diary.coment.getcount');



Route::get('/projects','ProjectController@index')->name('project');
Route::get('/project/item/{id}','ProjectController@item')->name('project.item');
Route::post('/project/coment','CommentProjectController@addcomment')->name('project.coment.store');
Route::post('/project/coment/get','CommentProjectController@getComent')->name('project.coment.get');
Route::post('/project/coment/getcount','CommentProjectController@getCount')->name('project.coment.getcount');


Route::post('/like/store','LikeController@store')->name('like.store.like');
Route::post('/like/store/dislike','LikeController@storeDisLike')->name('like.store.dislike');
Route::post('/like/count/dis','LikeController@dislikeCount')->name('like.count.dis');
Route::post('/like/count/like','LikeController@likeCount')->name('like.count.like');
Route::post('/view/store','ViewController@store')->name('view.store.view');
Route::post('/view/count/view','ViewController@viewCount')->name('view.count.view');

Route::get('/ajax_get_country','MainController@ajax_get_country')->name('ajax.get_country');
Route::post('/ajax/check_auth','MainController@checkAuth')->name('ajax.get_country');
Route::get('/ajax_get_city/{id}','MainController@ajax_get_city')->name('ajax.get_cuty');
Route::get('/ajax_get_region/{id}','MainController@ajax_get_region')->name('ajax.get_region');
Route::post('/parse/href','MainController@parseHref')->name('ajax.parse.href');
Route::get('/error/auth','MainController@error')->name('error.auth');
Route::get('/error/block','MainController@errorBlock');
Route::get('/error/ublock','MainController@errorUBlock');
Route::get('/error/delete','MainController@errorDelete');
Route::get('/about','MainController@about');

Route::get('/send-email', 'MainController@testSend');

Route::post('/answer/add', 'AnswerController@add')->name('adminpanel.answer.add');
Route::get('/poll/view/{id}','AnswerController@show')->name('poll.show');
Route::get('/poll','AnswerController@all')->name('poll.all');
Route::post('/poll/coment','CommentPollController@addcomment')->name('poll.coment.store');
Route::post('/poll/coment/get','CommentPollController@getComent')->name('poll.coment.get');
Route::post('/poll/coment/getcount','CommentPollController@getCount')->name('poll.coment.getcount');

Route::post('/send/complaint','ComplaintController@addComplaint');

Route::get('/users','MainController@getUser');
Route::get('/user/{id}','MainController@getUserIndex');
Route::get('/users/online','MainController@getOnline');
Route::get('/search/user/','MainController@filter');
Route::post('/users/add/frend','FrendController@add')->middleware(['verified','auth']);
Route::get('/profile/relation/','FrendController@getFrend')->middleware(['verified','auth']);
Route::get('/del/frend/{id}','FrendController@delete');
Route::get('/frend/is_online','FrendController@isOnline');
Route::get('/frend/all','FrendController@ajaxAllFrend');


Route::post('/appeal/add','AppealController@store')->middleware(['verified','auth']);


Route::post('/profile/relation/search','FrendController@searchFrend')->middleware(['verified','auth']);;

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['admin']], function () {

Route::get('/index', 'MainController@index')->name('adminpanel');
Route::get('user/filter', 'MainController@filter')->name('adminpanel.user.filter');
Route::get('/user/delete/{id}', 'MainController@delete')->name('adminpanel.user.delete');
Route::get('user/edit/{id}', 'MainController@edit')->name('adminpanel.user.edit');
Route::put('/admin/upadete/user/','MainController@update')->name('adminpanel.profile.update');

Route::get('/delo/index', 'DeloController@index')->name('adminpanel.delo');
Route::put('/admin/upadete/delo/','DeloController@update')->name('adminpanel.delo.update');
Route::get('delo/edit/{id}', 'DeloController@edit')->name('adminpanel.delo.edit');
Route::get('delo/delete/{id}', 'DeloController@delete')->name('adminpanel.delo.delete');
Route::put('/admin/upadete/delo/','DeloController@update')->name('adminpanel.delo.update');


Route::get('/service/index', 'ServiceController@index')->name('adminpanel.service');
Route::put('/admin/upadete/service/','ServiceController@update')->name('adminpanel.service.update');
Route::get('service/edit/{id}', 'ServiceController@edit')->name('adminpanel.service.edit');
Route::get('service/delete/{id}', 'ServiceController@delete')->name('adminpanel.service.delete');

Route::get('/hochu_pom/index', 'HelpController@HochyPomIndex')->name('adminpanel.hochu_pom');
Route::put('/admin/upadete/hochu_pom/','HelpController@HochyPompUdate')->name('adminpanel.hochu_pom.update');
Route::get('hochu_pom/edit/{id}', 'HelpController@HochyPomEdit')->name('adminpanel.hochu_pom.edit');
Route::get('hochu_pom/delete/{id}', 'HelpController@HochyPomDelete')->name('adminpanel.hochu_pom.delete');



Route::get('/poiski/index', 'HelpController@NeedPomIndex')->name('adminpanel.poiski');
Route::put('/admin/upadete/poiski/','HelpController@NeedPomUdate')->name('adminpanel.poiski.update');
Route::get('poiski/edit/{id}', 'HelpController@NeedPomEdit')->name('adminpanel.poiski.edit');
Route::get('poiski/delete/{id}', 'HelpController@NeedPomDelete')->name('adminpanel.poiski.delete');



Route::get('/naxodki/index', 'HelpController@NahodkiIndex')->name('adminpanel.naxodki');
Route::put('/admin/upadete/naxodki/','HelpController@NahodkiUdate')->name('adminpanel.naxodki.update');
Route::get('naxodki/edit/{id}', 'HelpController@NahodkiEdit')->name('adminpanel.naxodki.edit');
Route::get('naxodki/delete/{id}', 'HelpController@NahodkiDelete')->name('adminpanel.naxodki.delete');


Route::get('/future/index', 'FutureController@index')->name('adminpanel.future');
Route::put('/admin/upadete/future/','FutureController@update')->name('adminpanel.future.update');
Route::get('future/edit/{id}', 'FutureController@edit')->name('adminpanel.future.edit');
Route::get('/admin/future/delete/{id}', 'FutureController@delete')->name('adminpanel.future.delete');


Route::get('/interview/add', 'InterViewController@add')->name('adminpanel.interview.add');
Route::post('/interview/store', 'InterViewController@store')->name('adminpanel.interview.store');
Route::get('/interview/index', 'InterViewController@index')->name('adminpanel.interview');
Route::put('/admin/upadete/interview/','InterViewController@update')->name('adminpanel.interview.update');
Route::get('interview/edit/{id}', 'InterViewController@edit')->name('adminpanel.interview.edit');
Route::get('/admin/interview/delete/{id}', 'InterViewController@delete')->name('adminpanel.interview.delete');


Route::get('/tag/add', 'TagController@add')->name('adminpanel.tag.add');
Route::post('/tag/store', 'TagController@store')->name('adminpanel.tag.store');
Route::get('/tag/index', 'TagController@index')->name('adminpanel.tag');
Route::put('/admin/upadete/tag/','TagController@update')->name('adminpanel.tag.update');
Route::get('tag/edit/{id}', 'TagController@edit')->name('adminpanel.tag.edit');
Route::get('/admin/tag/delete/{id}', 'TagController@delete')->name('adminpanel.tag.delete');


Route::get('/news/add', 'NewsController@add')->name('adminpanel.news.add');
Route::post('/news/store', 'NewsController@store')->name('adminpanel.news.store');
Route::get('/news/index', 'NewsController@index')->name('adminpanel.news');
Route::get('/admin/news/edit_flag', 'NewsController@change_flag')->name('adminpanel.news.edit.flag');
Route::put('/updete/news/','NewsController@update')->name('adminpanel.news.update');
Route::get('/news/edit/{id}', 'NewsController@edit')->name('adminpanel.news.edit');
Route::get('/admin/news/delete/{id}', 'NewsController@delete')->name('adminpanel.news.delete');
Route::post('/news/upload', 'NewsController@upload')->name('adminpanel.news.upload');





Route::get('/diary/add', 'DiaryController@add')->name('adminpanel.diary.add');
Route::post('/diary/store', 'DiaryController@store')->name('adminpanel.diary.store');
Route::get('/diary/index', 'DiaryController@index')->name('adminpanel.diary');
Route::put('/updete/diary/','DiaryController@update')->name('adminpanel.diary.update');
Route::get('/diary/edit/{id}', 'DiaryController@edit')->name('adminpanel.diary.edit');
Route::get('/admin/diary/delete/{id}', 'DiaryController@delete')->name('adminpanel.diary.delete');





Route::get('/project/add', 'ProjectController@add')->name('adminpanel.project.add');
Route::post('/project/store', 'ProjectController@store')->name('adminpanel.project.store');
Route::get('/project/index', 'ProjectController@index')->name('adminpanel.project');
Route::put('/project/diary/','ProjectController@update')->name('adminpanel.project.update');
Route::get('/project/edit/{id}', 'ProjectController@edit')->name('adminpanel.project.edit');
Route::get('/admin/project/delete/{id}', 'ProjectController@delete')->name('adminpanel.project.delete');



Route::get('/seotext/index', 'SeoTextController@index')->name('adminpanel.seo_text');
Route::put('/seotext/update/','SeoTextController@update')->name('adminpanel.seo_text.update');
Route::get('/seotext/edit/{id}', 'SeoTextController@edit')->name('adminpanel.seo_text.edit');




Route::get('/razdel/add', 'RazdelController@add')->name('adminpanel.razdel.add');
Route::post('/razdel/store', 'RazdelController@store')->name('adminpanel.razdel.store');
Route::get('/razdel/index', 'RazdelController@index')->name('adminpanel.razdel');
Route::put('/razdel/diary/','RazdelController@update')->name('adminpanel.razdel.update');
Route::get('/razdel/edit/{id}', 'RazdelController@edit')->name('adminpanel.razdel.edit');
Route::get('/razdel/show/{id}', 'RazdelController@show')->name('adminpanel.razdel.show');
Route::get('/admin/razdel/delete/{id}', 'RazdelController@delete')->name('adminpanel.razdel.delete');

Route::get('/menu', 'MenuController@index')->name('adminpanel.menu');
Route::post('/menu/store', 'MenuController@store')->name('adminpanel.menu.store');
Route::post('/menu/edit', 'MenuController@update')->name('adminpanel.menu.update');



Route::get('/appeil/index/user', 'AppeilController@getUserAppeil')->name('adminpanel.appeil.user');
Route::get('/appeil/index/delo', 'AppeilController@getDeloAppeil')->name('adminpanel.appeil.delo');
Route::get('/appeil/show/{id}', 'AppeilController@show');
Route::post('/appeil/chenge_status', 'AppeilController@chengeStatus')->name('adminpanel.appeal.status');

Route::get('/event_ribbon_profile', 'EventController@index');
Route::get('/get/event/type', 'EventController@index');
Route::get('/event_ribbon_profile_set/{id}', 'EventController@edit');
Route::put('/event_ribbon_profile/update', 'EventController@update');
Route::get('/event_ribbon_profile_del/{id}', 'EventController@delete');


Route::get('/comment/news', 'CommentController@getNewsComment');
Route::get('/comment/project', 'CommentController@getProjectComment');
Route::get('/comment/diary', 'CommentController@getDiaryComment');
Route::get('/comment/poll', 'CommentController@getPollComment');
Route::get('/comment/future', 'CommentController@getFutureComment');
Route::get('/comment/dela', 'CommentController@getDeleComment');
Route::get('/comment/help', 'CommentController@getHelpComment');
Route::get('/comment/service', 'CommentController@getServiceComment');
Route::get('/comment/interview', 'CommentController@getInterComment');
Route::get('/comment/com_del', 'CommentController@delete');
Route::post('/comment/filter', 'CommentController@filter');





Route::get('/social_questions/add/{id}', 'SQuestionsController@add')->name('adminpanel.sq.add');
Route::get('/social_questions/delete/{id}', 'SQuestionsController@delete')->name('adminpanel.sq.delete');
Route::post('/social_questions/store', 'SQuestionsController@store')->name('adminpanel.sq.store');
Route::get('/social_questions/result/{id}', 'SQuestionsController@getResult')->name('adminpanel.sq.result');
Route::get('/social_q_archive', 'SQuestionsController@getArhive')->name('adminpanel.sq.arhive');
Route::post('/ajax_social_questions_settings', 'SQuestionsController@setings');




});







Route::get('/contacts','MessageController@get')->middleware(['verified','auth']);;
Route::get('/profile/messages','MessageController@index')->middleware(['verified','auth']);;
Route::get('/conversation/{id}','MessageController@getMessagesFor')->middleware(['verified','auth']);;
Route::post('/read','MessageController@read')->middleware(['verified','auth']);;
Route::post('/conversation/send','MessageController@save')->middleware(['verified','auth']);;
Route::post('/contact/delete','MessageController@deleteContact')->middleware(['verified','auth']);;
Route::post('/message/delete','MessageController@deleteMessage')->middleware(['verified','auth']);;
Route::get('/activate/{id}/{token}', 'VertifyController@activation')->name('activation');
Route::post('/check/email', 'MainController@checkEmail');

Route::get('/import/user','ImportController@importUser');
Route::get('/import/dela','ImportController@importDela');
Route::get('/import/dela/coment','ImportController@comentImportDela');
Route::get('/import/dela/like','ImportController@likeImportDela');
Route::get('/import/dela/featured','ImportController@importFeaturedVsPartic');
Route::get('/import/services','ImportController@importSevices');
Route::get('/import/serv/coment','ImportController@comentImportServ');

Route::get('/import/news','ImportController@importNews');
Route::get('/import/news/coment','ImportController@comentImportNews');
Route::get('/import/news/like','ImportController@likeImportNews');

Route::get('/import/help','ImportController@importHelp');
Route::get('/import/help/view','ImportController@importHelpView');
Route::get('/import/help/coment','ImportController@importHelpComent');

Route::get('/import/diary','ImportController@importDiary');
Route::get('/import/diary/coment','ImportController@importDiaryComent');
Route::get('/import/diary/like','ImportController@importDiaryLike');


Route::get('/import/project','ImportController@importProject');
Route::get('/import/project/coment','ImportController@importProjectComent');
Route::get('/import/project/like','ImportController@importProjectLike');

Route::get('/import/inter','ImportController@importInterview');
Route::get('/import/inter/coment','ImportController@importInterviewComent');
Route::get('/import/inter/like','ImportController@importInterviewLike');

Route::get('/import/seotext','ImportController@importSeoText');

Route::get('/import/squest','ImportController@importSQuest');
Route::get('/import/answer','ImportController@importAnswer');


Auth::routes();
//Route::get('/', 'MainController@index');
//Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');