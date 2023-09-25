<?php
$this->registerJsFile('@web/js/collapse.js');
?>
<style>
    .form-control {
        background: white !important;
    }
</style>
<div class="row menu-mob">
    <div class="col-lg-9 content-block p-4">
        <form>
            <div class="collapse-val" id="collapse-1">
                <h2>Личные данные</h2>
                <div class="form-group row">
                    <div class="img-load-block position-relative">
                        <div class="round-plus">
                            <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.811 28.616V0.584H17.187V28.616H11.811ZM0.163 17.16V12.104H28.835V17.16H0.163Z" fill="#4D954C"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Имя</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Фамилия</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Электронная почта</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Телефон для СМС уведомлений</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Язык</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Часовой пояс</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Город проживания</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Компания</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Позиция</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="collapse-val" id="collapse-2" style="display: none">
                <h2>Безопасность</h2>
            </div>
            <div class="collapse-val" id="collapse-3" style="display: none">
                <h2 class="mb-4">Уведомления</h2>
                <div class="button-profile-block mb-2">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">Новые сообщения в чате</label>
                    </div>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                            <label class="form-check-label" for="inlineCheckbox1">Электронная почта</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                            <label class="form-check-label" for="inlineCheckbox2">SMS</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                            <label class="form-check-label" for="inlineCheckbox2">Телефон</label>
                        </div>
                    </div>
                </div>
                <div class="button-profile-block">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">Результаты проверки ДЗ</label>
                    </div>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                            <label class="form-check-label" for="inlineCheckbox1">Электронная почта</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                            <label class="form-check-label" for="inlineCheckbox2">SMS</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                            <label class="form-check-label" for="inlineCheckbox2">Телефон</label>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="button-profile-block">
                <div>
                    <button class="btn-green">Удалить аккаунт</button>
                </div>
                <div>
                    <button class="btn-green drop-button">Отмена</button>
                    <button class="btn-green">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-3 pl-2">
        <div class="content-menu content-block">
            <ul class="list-group">
                <li class="list-group-item collapse-opt active" data-trigger="collapse-1">Личные данные</li>
                <li class="list-group-item collapse-opt" data-trigger="collapse-2">Безопасность</li>
                <li class="list-group-item collapse-opt" data-trigger="collapse-3">Уведомления</li>
            </ul>
        </div>
    </div>
</div>
