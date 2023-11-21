<!DOCTYPE html>
<html>

<head>
    <title>WorkingHours </title>
    <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
</head>

<body>
    <div class="container" style="width: 768px;>
        <div class="main">
            <div class='menu'>
                @if (!isset($user))
                    <form method="POST" action="{{ route('enter') }}" accept-charset="utf-8">
                        @csrf
                        <label class="conf-step__label" for="mail">
                            <h4>{{ __('Введите имя пользователя') }}</h4>
                            <input id="name" class="conf-step__input @error('name') is-invalid @enderror"
                                name="name">
                        </label>
                        <h6>(*Введенное имя автоматически регистрируется и авторизируется в системе, при повторном вводе зарегистрированного пользователя, происходит его авторизация)</h6>
                        <div class="conf-step__buttons">
                            <input type="submit" value="Войти"
                                class="conf-step__button-accent
                       conf-step__button"
                                data-bs-dismiss="modal">
                        </div>
                    </form>
                @else
                    <div class="conf-step__label ">
                        <h4 class="active_client">Авторизированный пользователь {{ $user->name }}<h4>
                                <div>
                                    <a class="exit" style="text-decoration:none;" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                                        {{ __('Сменить пользователя') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                              </div>
                    </div>
                @endif
            </div>
        <div class="card bg-light mt-3">
            <div class="card-header">
                <h4>WorkingHours</h4>
            </div>
            <div class="card-body">
                @if (isset($user))
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
                    <button class="btn btn-success">
                        Имортировать файл
                    </button>
                </form>
                @endif
                <table class="table  table-bordered mt-3 table table-sm">
                    <tr >
                        <th class="text-center">ID</th>
                        <th class="text-center">Имя</th>
                        <th class="text-center">Часы</th>
                        <th class="text-center">Работает</th>
                        @if (isset($user))
                        <th class="text-center">Управление</th>
                        @endif
                    </tr>
                    @foreach ($workers as $worker)
                        <tr>
                            <td class="text-center">{{ $worker->id }}</td>
                            <td class="text-center">{{ $worker->name }}</td>
                            <td class="text-center">{{ $worker->working->hours}}</td>
                            @if ($worker->working->working === 0)
                            <td class="text-center">Нет</td>
                            @else
                            <td class="text-center">Да</td>
                            @endif
                            @if (isset($user))
                            @if ($worker->working->working === 0)
                            <td class="text-center" ><button class="btn btn-success"><a style="text-decoration:none; color:white;" href="{{ route('startEnd', $worker->working->id) }}">Сотрудник приступил к работе</a></button></td>
                            @else
                            <td class="text-center" ><button class="btn btn-primary"><a style="text-decoration:none; color:white;" href="{{ route('startEnd', $worker->working->id) }}">Сотрудник закончил работу</a></button></td>
                            @endif
                            @endif
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

</div>
    <script src="{{ asset('index/js/accordeon.js') }}" defer></script>
</body>

</html>
