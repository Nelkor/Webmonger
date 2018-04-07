<button id="btn-auth" class="btn btn-outline-dark" style="margin-bottom:10px">ВХОД</button>
<div id="auth" style="margin-bottom:10px;display:none">
    <input type="text" id="auth-name" class="form-control" placeholder="Ваше имя">
    <input type="password" id="auth-pass" class="form-control" placeholder="Пароль" style="margin:5px 0">
    <button class="btn btn-sm btn-dark form-control">ВОЙТИ</button>
    <div id="auth-hint" class="text-center text-danger" style="display:none;margin-top:5px"></div>
</div>
<button id="btn-reg" class="btn btn-outline-dark">РЕГИСТРАЦИЯ</button>
<div id="reg" style="margin-top:10px;display:none">
    <input type="text" id="reg-name" data-reg="name" class="form-control" placeholder="Придумайте имя">
    <div id="name-hint" class="text-center" style="display:none"></div>
    <input type="password" id="reg-pass" data-reg="pass" class="form-control" placeholder="Придумайте пароль" style="margin-top:5px">
    <div id="pass-hint" class="text-center" style="display:none"></div>
    <input type="email" id="reg-gmail" data-reg="gmail" class="form-control" placeholder="Ваш gmail" style="margin-top:5px">
    <div id="gmail-hint" class="text-center" style="display:none"></div>
    <label style="width:100%;margin-bottom:0">Необязательно:
        <input type="password" id="reg-repeat" data-reg="repeat" class="form-control" placeholder="Повторите пароль">
    </label>
    <div id="repeat-hint" class="text-center" style="display:none;margin-bottom:5px"></div>
    <button class="btn btn-sm btn-dark form-control" style="margin-top:5px">ЗАРЕГИСТРИРОВАТЬСЯ</button>
    <div id="reg-hint" class="text-center text-danger" style="display:none;margin-top:5px"></div>
</div>