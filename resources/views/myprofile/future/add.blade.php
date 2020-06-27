 @extends('layouts.frontend.app')
@section('title','Люди для людей')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')
<main class="col-xs-12">
          <div class="sm-breadcrumb">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li><li><a href="profile/index">Профиль</a></li><li class="active">Добавить будущее дело</li>    </ol>
</div>
<section>
    <div class="people-outside future-page-add moya-anketa">
		
  @include('myprofile.left')
        <form class="right" action="/future_business/store" method="post" id="add_f_business_true">
              {{ csrf_field()}}
            <input type="hidden" name="ci_csrf_token" value="">
            <div class="field-for-edit">
                <span class="edit-label">Название</span>
                <input type="text" class="tfi" id="fName" name="title" value=""/>
                <span class="error"></span>
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Описание</span>
                <textarea class="form-control" rows="8" id="fDesc" name="description"></textarea>
                <span class="error"></span>
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Требуемые ресурсы</span>
                <textarea class="form-control" rows="8" id="fRes" name="resource"></textarea>
                <span class="error"></span>
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Планируемая дата</span>
                <div class="input-group date" id="datepick">
                                                            <input type="text" id="fDate" class="form-control tfi" name="date_begin" style="float: none" value="" />
                    <span class="input-group-addon">
                                        <span class="date-calendar"></span>
                                    </span>
                </div>
                <span class="error"></span>
            </div>

            <div class="field-for-edit" style="margin-top: 25px;">
                <button type="submit" class="btn btn-default tab-btn save">Сохранить</button>
                <button type="button" class="btn btn-default tab-btn cancel" onclick="javascript:location.href = '/profile/future_business'">Отменить</button>
            </div>
        </form>
</section>
<script>
    $(document).ready(function () {
        $('#fDate').datetimepicker({
            sideBySide: true,
            format: "L",
            locale: "ru"
        })
    });
</script>
<style>
    .bootstrap-datetimepicker-widget {
        width: 100%;
        border: 2px solid #99ca3d;
        position: relative;
    }
    .bootstrap-datetimepicker-widget ul {
        list-style: none;
        padding: 0;
    }
</style>      
    @push('js')
       
 @endpush
 
 
 
@endsection