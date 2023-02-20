@if ($message = Session::get('success'))
    <div class="alert uk-alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <p class="uk-text-large">{{ $message }}</p>
    </div>
@endif


@if ($message = Session::get('error'))
    <div class="alert uk-alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <p class="uk-text-large">{{ $message }}</p>
    </div>
@endif


@if ($message = Session::get('warning'))
    <div class="alert uk-alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <p class="uk-text-large">{{ $message }}</p>
    </div>
@endif


@if ($message = Session::get('info'))
    <div class="alert uk-alert-primary alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <p class="uk-text-large">{{ $message }}</p>
    </div>
@endif


@if ($errors->any())
    <div class="alert uk-alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <p class="uk-text-large">Analise os erros abaixo</p>
    </div>
@endif
