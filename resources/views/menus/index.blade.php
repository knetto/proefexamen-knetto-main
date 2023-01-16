@extends('layouts.app')
<div class="backgroundMenu">
    @section('content')
        <h3 class="menukaartTitle">Menukaart</h3>
        @if (!$menucards)
            <p>Geen menu gevonden</p>
        @else
            @foreach ($menucards as $menu)
                <?php
                $dishesId = explode(',', $menu->dishes_id);
                ?>
            @endforeach
            {{-- voorgerechten --}}
            <div class="row menukaartGerechten">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 category">
                    @if (Auth::check())
                        <h3 class="menuCategory">Voorgerechten <button id="clickpopup" class="clickpopup buttonAddDish"><i
                                    class="fa-regular fa-square-plus"></i></button></h3>
                        <div class="popup" id="popup">
                            <div class="popup-content">
                                <div class="close" align="right" title="Close">X</div>
                                <div class="content">
                                    <h3 class="menuCategoryNoEdit text-center">Voorgerechten</h3>
                                    @foreach ($dishes as $dish)
                                        @if ($dish->category_id == 1)
                                            @if (!in_array("$dish->id", $dishesId))
                                                <div class="adDishItem"> {{ $dish->name }}
                                                    <!-- Update Form -->
                                                    <form
                                                        action="{{ action('\App\Http\Controllers\menucardController@update', ['menu' => $menu->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <input type="hidden" name="old_string" class="form-control"
                                                                value="{{ $menu->dishes_id }}">
                                                        </div>
                                                        <?php
                                                        //nieuwe array maken waar het id van degenen die weg moet niet meer in zit
                                                        $array = $dishesId;
                                                        
                                                        $value = $dish->id;
                                                        
                                                        array_push($array, $value);
                                                        
                                                        $string = implode(',', $array);
                                                        ?>
                                                        <div class="form-group">
                                                            <input type="hidden" name="new_string" class="form-control"
                                                                value="{{ $string }}">
                                                        </div>

                                                        @if (Auth::check())
                                                            <!-- Submit Button -->
                                                            <button type="submit" class="buttonDeleteDish">
                                                                <i class="fa-regular fa-square-plus"></i>
                                                            </button>
                                                </div>
                                            @endif
                                            </form>
                                        @endif
                                    @endif
                    @endforeach
                </div>
            </div>
    </div>

    <script>
        var modal = document.getElementById("popup");
        var btn = document.getElementById("clickpopup");
        var cls = document.getElementsByClassName("close")[0];
        btn.onclick = function() {
            modal.style.display = "block";
        }
        cls.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@else
    <h3 class="menuCategoryNoEdit">Voorgerechten</h3>
    @endif

    @for ($i = 0; $i <= count($dishesId) - 1; $i++)
        @if ($dishes[$dishesId[$i] - 1]['category_id'] == 1)
            <!-- Update Form -->
            <form action="{{ action('\App\Http\Controllers\menucardController@update', ['menu' => $menu->id]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <input type="hidden" name="old_string" class="form-control" value="{{ $menu->dishes_id }}">
                </div>

                <?php
                //nieuwe array maken waar het id van degenen die weg moet niet meer in zit
                $array = $dishesId;
                $value = $dishes[$dishesId[$i] - 1]['id'];
                
                unset($array[array_search($value, $array)]);
                $string = implode(',', $array);
                ?>
                <div class="form-group">
                    <input type="hidden" name="new_string" class="form-control" value="{{ $string }}">
                </div>

                @if (Auth::check())
                    <!-- Submit Button -->
                    <button type="submit" class="buttonDeleteDish">
                        <i class="fa-regular fa-square-minus"></i>
                    </button>
                @endif
            </form>
            @if (Auth::check())
                <div class="dishes"> {{ $dishes[$dishesId[$i] - 1]['name'] }} </div>
                <div class="dishesDescription"> {{ $dishes[$dishesId[$i] - 1]['description'] }}
                    {{ '€' }}{{ $dishes[$dishesId[$i] - 1]['price'] }}</div>

                <br>
            @else
                <div class="dishesNoEdit"> {{ $dishes[$dishesId[$i] - 1]['name'] }} </div>
                <div class="dishesDescription"> {{ $dishes[$dishesId[$i] - 1]['description'] }}
                    {{ '€' }}{{ $dishes[$dishesId[$i] - 1]['price'] }}</div>
                <br>
            @endif
        @endif
    @endfor
    </div>

    {{-- hoofdgerechten --}}
    <div class="col-xs-12 col-md-12 col-lg-4 category">
        @if (Auth::check())
            <h3 class="menuCategory">Hoofdgerechten <button id="clickpopup2" class="clickpopup2 buttonAddDish"><i
                        class="fa-regular fa-square-plus"></i></button></h3>
            <div class="popup2" id="popup2">
                <div class="popup-content2">
                    <div class="close2" align="right" title="Close2">X</div>
                    <div class="content2">
                        <h3 class="menuCategoryNoEdit text-center">Hoofdgerechten</h3>
                        @foreach ($dishes as $dish)
                            @if ($dish->category_id == 2)
                                @if (!in_array("$dish->id", $dishesId))
                                    <div class="adDishItem"> {{ $dish->name }}
                                        <!-- Update Form -->
                                        <form
                                            action="{{ action('\App\Http\Controllers\menucardController@update', ['menu' => $menu->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <input type="hidden" name="old_string" class="form-control"
                                                    value="{{ $menu->dishes_id }}">
                                            </div>
                                            <?php
                                            //nieuwe array maken waar het id van degenen die weg moet niet meer in zit
                                            $array = $dishesId;
                                            
                                            $value = $dish->id;
                                            
                                            array_push($array, $value);
                                            
                                            $string = implode(',', $array);
                                            ?>
                                            <div class="form-group">
                                                <input type="hidden" name="new_string" class="form-control"
                                                    value="{{ $string }}">
                                            </div>

                                            @if (Auth::check())
                                                <!-- Submit Button -->
                                                <button type="submit" class="buttonDeleteDish">
                                                    <i class="fa-regular fa-square-plus"></i>
                                                </button>
                                    </div>
                                @endif
                                </form>
                            @endif
                        @endif
        @endforeach
    </div>
    </div>
    </div>

    <script>
        var modal2 = document.getElementById("popup2");
        var btn2 = document.getElementById("clickpopup2");
        var cls2 = document.getElementsByClassName("close2")[0];
        btn2.onclick = function() {
            modal2.style.display = "block";
        }
        cls2.onclick = function() {
            modal2.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal2) {
                modal2.style.display = "none";
            }
        }
    </script>
@else
    <h3 class="menuCategoryNoEdit">Hoofdgerechten</h3>
    @endif

    @for ($i = 0; $i <= count($dishesId) - 1; $i++)
        @if ($dishes[$dishesId[$i] - 1]['category_id'] == 2)
            <!-- Update Form -->
            <form action="{{ action('\App\Http\Controllers\menucardController@update', ['menu' => $menu->id]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <input type="hidden" name="old_string" class="form-control" value="{{ $menu->dishes_id }}">
                </div>

                <?php
                //nieuwe array maken waar het id van degenen die weg moet niet meer in zit
                $array = $dishesId;
                $value = $dishes[$dishesId[$i] - 1]['id'];
                unset($array[array_search($value, $array)]);
                $string = implode(',', $array);
                
                ?>
                <div class="form-group">
                    <input type="hidden" name="new_string" class="form-control" value="{{ $string }}">
                </div>

                @if (Auth::check())
                    <!-- Submit Button -->
                    <button type="submit" class="buttonDeleteDish">
                        <i class="fa-regular fa-square-minus"></i>
                    </button>
                @endif
            </form>
            @if (Auth::check())
                <div class="dishes"> {{ $dishes[$dishesId[$i] - 1]['name'] }} </div>
                <div class="dishesDescription"> {{ $dishes[$dishesId[$i] - 1]['description'] }}
                    {{ '€' }}{{ $dishes[$dishesId[$i] - 1]['price'] }}</div>
                <br>
            @else
                <div class="dishesNoEdit"> {{ $dishes[$dishesId[$i] - 1]['name'] }} </div>
                <div class="dishesDescription"> {{ $dishes[$dishesId[$i] - 1]['description'] }}
                    {{ '€' }}{{ $dishes[$dishesId[$i] - 1]['price'] }}</div>
                <br>
            @endif
        @endif
    @endfor
    </div>
    {{-- nagerechten --}}
    <div class="col-xs-12 col-md-12 col-lg-4 category">
        @if (Auth::check())
            <h3 class="menuCategory">Nagerechten <button id="clickpopup3" class="clickpopup3 buttonAddDish"><i
                        class="fa-regular fa-square-plus"></i></button></h3>
            <div class="popup3" id="popup3">
                <div class="popup-content3">
                    <div class="close3" align="right" title="Close3">X</div>
                    <div class="content3">
                        <h3 class="menuCategoryNoEdit text-center">Nagerechten</h3>
                        @foreach ($dishes as $dish)
                            @if ($dish->category_id == 3)
                                @if (!in_array("$dish->id", $dishesId))
                                    <div class="adDishItem"> {{ $dish->name }}
                                        <!-- Update Form -->
                                        <form
                                            action="{{ action('\App\Http\Controllers\menucardController@update', ['menu' => $menu->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <input type="hidden" name="old_string" class="form-control"
                                                    value="{{ $menu->dishes_id }}">
                                            </div>
                                            <?php
                                            //nieuwe array maken waar het id van degenen die weg moet niet meer in zit
                                            $array = $dishesId;
                                            
                                            $value = $dish->id;
                                            
                                            array_push($array, $value);
                                            
                                            $string = implode(',', $array);
                                            ?>
                                            <div class="form-group">
                                                <input type="hidden" name="new_string" class="form-control"
                                                    value="{{ $string }}">
                                            </div>

                                            @if (Auth::check())
                                                <!-- Submit Button -->
                                                <button type="submit" class="buttonDeleteDish">
                                                    <i class="fa-regular fa-square-plus"></i>
                                                </button>
                                    </div>
                                @endif
                                </form>
                            @endif
                        @endif
        @endforeach
    </div>
    </div>
    </div>

    <script>
        var modal3 = document.getElementById("popup3");
        var btn3 = document.getElementById("clickpopup3");
        var cls3 = document.getElementsByClassName("close3")[0];
        btn3.onclick = function() {
            modal3.style.display = "block";
        }
        cls3.onclick = function() {
            modal3.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal3) {
                modal3.style.display = "none";
            }
        }
    </script>
@else
    <h3 class="menuCategoryNoEdit">Nagerechten</h3>
    @endif
    @for ($i = 0; $i <= count($dishesId) - 1; $i++)
        @if ($dishes[$dishesId[$i] - 1]['category_id'] == 3)
            <!-- Update Form -->
            <form action="{{ action('\App\Http\Controllers\menucardController@update', ['menu' => $menu->id]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <input type="hidden" name="old_string" class="form-control" value="{{ $menu->dishes_id }}">
                </div>

                <?php
                //nieuwe array maken waar het id van degenen die weg moet niet meer in zit
                $array = $dishesId;
                $value = $dishes[$dishesId[$i] - 1]['id'];
                unset($array[array_search($value, $array)]);
                $string = implode(',', $array);
                ?>
                <div class="form-group">
                    <input type="hidden" name="new_string" class="form-control" value="{{ $string }}">
                </div>

                @if (Auth::check())
                    <!-- Submit Button -->
                    <button type="submit" class="buttonDeleteDish">
                        <i class="fa-regular fa-square-minus"></i>
                    </button>
                @endif
            </form>
            @if (Auth::check())
                <div class="dishes"> {{ $dishes[$dishesId[$i] - 1]['name'] }} </div>
                <div class="dishesDescription"> {{ $dishes[$dishesId[$i] - 1]['description'] }}
                    {{ '€' }}{{ $dishes[$dishesId[$i] - 1]['price'] }}</div>
                <br>
            @else
                <div class="dishesNoEdit"> {{ $dishes[$dishesId[$i] - 1]['name'] }} </div>
                <div class="dishesDescription"> {{ $dishes[$dishesId[$i] - 1]['description'] }}
                    {{ '€' }}{{ $dishes[$dishesId[$i] - 1]['price'] }}</div>
                <br>
            @endif
        @endif
    @endfor
    </div>
    {{-- koude dranken --}}
    <div class="col-xs-12 col-md-12 col-lg-4 category">
        @if (Auth::check())
            <h3 class="menuCategory">Koude dranken <button id="clickpopup4" class="clickpopup4 buttonAddDish"><i
                        class="fa-regular fa-square-plus"></i></button></h3>
            <div class="popup4" id="popup4">
                <div class="popup-content4">
                    <div class="close4" align="right" title="Close4">X</div>
                    <div class="content4">
                        <h3 class="menuCategoryNoEdit text-center">Koude dranken</h3>
                        @foreach ($dishes as $dish)
                            @if ($dish->category_id == 4)
                                @if (!in_array("$dish->id", $dishesId))
                                    <div class="adDishItem"> {{ $dish->name }}
                                        <!-- Update Form -->
                                        <form
                                            action="{{ action('\App\Http\Controllers\menucardController@update', ['menu' => $menu->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <input type="hidden" name="old_string" class="form-control"
                                                    value="{{ $menu->dishes_id }}">
                                            </div>
                                            <?php
                                            //nieuwe array maken waar het id van degenen die weg moet niet meer in zit
                                            $array = $dishesId;
                                            
                                            $value = $dish->id;
                                            
                                            array_push($array, $value);
                                            
                                            $string = implode(',', $array);
                                            ?>
                                            <div class="form-group">
                                                <input type="hidden" name="new_string" class="form-control"
                                                    value="{{ $string }}">
                                            </div>

                                            @if (Auth::check())
                                                <!-- Submit Button -->
                                                <button type="submit" class="buttonDeleteDish">
                                                    <i class="fa-regular fa-square-plus"></i>
                                                </button>
                                    </div>
                                @endif
                                </form>
                            @endif
                        @endif
        @endforeach
    </div>
    </div>
    </div>

    <script>
        var modal4 = document.getElementById("popup4");
        var btn4 = document.getElementById("clickpopup4");
        var cls4 = document.getElementsByClassName("close4")[0];
        btn4.onclick = function() {
            modal4.style.display = "block";
        }
        cls4.onclick = function() {
            modal4.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal4) {
                modal4.style.display = "none";
            }
        }
    </script>
@else
    <h3 class="menuCategoryNoEdit">Koude dranken</h3>
    @endif
    @for ($i = 0; $i <= count($dishesId) - 1; $i++)
        @if ($dishes[$dishesId[$i] - 1]['category_id'] == 4)
            <!-- Update Form -->
            <form action="{{ action('\App\Http\Controllers\menucardController@update', ['menu' => $menu->id]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <input type="hidden" name="old_string" class="form-control" value="{{ $menu->dishes_id }}">
                </div>

                <?php
                //nieuwe array maken waar het id van degenen die weg moet niet meer in zit
                $array = $dishesId;
                $value = $dishes[$dishesId[$i] - 1]['id'];
                unset($array[array_search($value, $array)]);
                $string = implode(',', $array);
                ?>
                <div class="form-group">
                    <input type="hidden" name="new_string" class="form-control" value="{{ $string }}">
                </div>

                @if (Auth::check())
                    <!-- Submit Button -->
                    <button type="submit" class="buttonDeleteDish">
                        <i class="fa-regular fa-square-minus"></i>
                    </button>
                @endif
            </form>
            @if (Auth::check())
                <div class="dishes"> {{ $dishes[$dishesId[$i] - 1]['name'] }} </div>
                <div class="dishesDescription"> {{ $dishes[$dishesId[$i] - 1]['description'] }}
                    {{ '€' }}{{ $dishes[$dishesId[$i] - 1]['price'] }}</div>

                <br>
            @else
                <div class="dishesNoEdit"> {{ $dishes[$dishesId[$i] - 1]['name'] }} </div>
                <div class="dishesDescription"> {{ $dishes[$dishesId[$i] - 1]['description'] }}
                    {{ '€' }}{{ $dishes[$dishesId[$i] - 1]['price'] }}</div>

                <br>
            @endif
        @endif
    @endfor
    </div>
    {{-- warme dranken --}}
    <div class="col-xs-12 col-md-12 col-lg-4 category">
        @if (Auth::check())
            <h3 class="menuCategory">Warme dranken <button id="clickpopup5" class="clickpopup5 buttonAddDish"><i
                        class="fa-regular fa-square-plus"></i></button></h3>
            <div class="popup5" id="popup5">
                <div class="popup-content5">
                    <div class="close5" align="right" title="Close3">X</div>
                    <div class="content5">
                        <h3 class="menuCategoryNoEdit text-center">Warme dranken</h3>
                        @foreach ($dishes as $dish)
                            @if ($dish->category_id == 5)
                                @if (!in_array("$dish->id", $dishesId))
                                    <div class="adDishItem"> {{ $dish->name }}
                                        <!-- Update Form -->
                                        <form
                                            action="{{ action('\App\Http\Controllers\menucardController@update', ['menu' => $menu->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <input type="hidden" name="old_string" class="form-control"
                                                    value="{{ $menu->dishes_id }}">
                                            </div>
                                            <?php
                                            //nieuwe array maken waar het id van degenen die weg moet niet meer in zit
                                            $array = $dishesId;
                                            
                                            $value = $dish->id;
                                            
                                            array_push($array, $value);
                                            
                                            $string = implode(',', $array);
                                            ?>
                                            <div class="form-group">
                                                <input type="hidden" name="new_string" class="form-control"
                                                    value="{{ $string }}">
                                            </div>

                                            @if (Auth::check())
                                                <!-- Submit Button -->
                                                <button type="submit" class="buttonDeleteDish">
                                                    <i class="fa-regular fa-square-plus"></i>
                                                </button>
                                    </div>
                                @endif
                                </form>
                            @endif
                        @endif
        @endforeach
    </div>
    </div>
    </div>

    <script>
        var modal5 = document.getElementById("popup5");
        var btn5 = document.getElementById("clickpopup5");
        var cls5 = document.getElementsByClassName("close5")[0];
        btn5.onclick = function() {
            modal5.style.display = "block";
        }
        cls5.onclick = function() {
            modal5.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal5) {
                modal5.style.display = "none";
            }
        }
    </script>
@else
    <h3 class="menuCategoryNoEdit">Warme dranken</h3>
    @endif
    @for ($i = 0; $i <= count($dishesId) - 1; $i++)
        @if ($dishes[$dishesId[$i] - 1]['category_id'] == 5)
            <!-- Update Form -->
            <form action="{{ action('\App\Http\Controllers\menucardController@update', ['menu' => $menu->id]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <input type="hidden" name="old_string" class="form-control" value="{{ $menu->dishes_id }}">
                </div>

                <?php
                //nieuwe array maken waar het id van degenen die weg moet niet meer in zit
                $array = $dishesId;
                $value = $dishes[$dishesId[$i] - 1]['id'];
                unset($array[array_search($value, $array)]);
                $string = implode(',', $array);
                ?>
                <div class="form-group">
                    <input type="hidden" name="new_string" class="form-control" value="{{ $string }}">
                </div>

                @if (Auth::check())
                    <!-- Submit Button -->
                    <button type="submit" class="buttonDeleteDish">
                        <i class="fa-regular fa-square-minus"></i>
                    </button>
                @endif
            </form>
            @if (Auth::check())
                <div class="dishes"> {{ $dishes[$dishesId[$i] - 1]['name'] }} </div>
                <div class="dishesDescription"> {{ $dishes[$dishesId[$i] - 1]['description'] }}
                    {{ '€' }}{{ $dishes[$dishesId[$i] - 1]['price'] }}</div>

                <br>
            @else
                <div class="dishesNoEdit"> {{ $dishes[$dishesId[$i] - 1]['name'] }} </div>
                <div class="dishesDescription"> {{ $dishes[$dishesId[$i] - 1]['description'] }}
                    {{ '€' }}{{ $dishes[$dishesId[$i] - 1]['price'] }}</div>

                <br>
            @endif
        @endif
    @endfor
    </div>
    {{-- alcoholische dranken --}}
    <div class="col-xs-12 col-md-12 col-lg-4 category">
        @if (Auth::check())
            <h3 class="menuCategory">Alcoholische dranken<button id="clickpopup6" class="clickpopup6 buttonAddDish"><i
                        class="fa-regular fa-square-plus"></i></button></h3>
            <div class="popup6" id="popup6">
                <div class="popup-content6">
                    <div class="close6" align="right" title="Close3">X</div>
                    <div class="content6">
                        <h3 class="menuCategoryNoEdit text-center">Alcoholische dranken</h3>
                        @foreach ($dishes as $dish)
                            @if ($dish->category_id == 6)
                                @if (!in_array("$dish->id", $dishesId))
                                    <div class="adDishItem"> {{ $dish->name }}
                                        <!-- Update Form -->
                                        <form
                                            action="{{ action('\App\Http\Controllers\menucardController@update', ['menu' => $menu->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <input type="hidden" name="old_string" class="form-control"
                                                    value="{{ $menu->dishes_id }}">
                                            </div>
                                            <?php
                                            //nieuwe array maken waar het id van degenen die weg moet niet meer in zit
                                            $array = $dishesId;
                                            
                                            $value = $dish->id;
                                            
                                            array_push($array, $value);
                                            
                                            $string = implode(',', $array);
                                            ?>
                                            <div class="form-group">
                                                <input type="hidden" name="new_string" class="form-control"
                                                    value="{{ $string }}">
                                            </div>

                                            @if (Auth::check())
                                                <!-- Submit Button -->
                                                <button type="submit" class="buttonDeleteDish">
                                                    <i class="fa-regular fa-square-plus"></i>
                                                </button>
                                    </div>
                                @endif
                                </form>
                            @endif
                        @endif
        @endforeach
    </div>
    </div>
    </div>

    <script>
        var modal6 = document.getElementById("popup6");
        var btn6 = document.getElementById("clickpopup6");
        var cls6 = document.getElementsByClassName("close6")[0];
        btn6.onclick = function() {
            modal6.style.display = "block";
        }
        cls6.onclick = function() {
            modal6.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal6) {
                modal6.style.display = "none";
            }
        }
    </script>
@else
    <h3 class="menuCategoryNoEdit">Alcoholische dranken</h3>
    @endif

    @for ($i = 0; $i <= count($dishesId) - 1; $i++)
        @if ($dishes[$dishesId[$i] - 1]['category_id'] == 6)
            <!-- Update Form -->
            <form action="{{ action('\App\Http\Controllers\menucardController@update', ['menu' => $menu->id]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <input type="hidden" name="old_string" class="form-control" value="{{ $menu->dishes_id }}">
                </div>

                <?php
                //nieuwe array maken waar het id van degenen die weg moet niet meer in zit
                $array = $dishesId;
                $value = $dishes[$dishesId[$i] - 1]['id'];
                unset($array[array_search($value, $array)]);
                $string = implode(',', $array);
                ?>
                <div class="form-group">
                    <input type="hidden" name="new_string" class="form-control" value="{{ $string }}">
                </div>

                @if (Auth::check())
                    <!-- Submit Button -->
                    <button type="submit" class="buttonDeleteDish">
                        <i class="fa-regular fa-square-minus"></i>
                    </button>
                @endif

            </form>
            @if (Auth::check())
                <div class="dishes"> {{ $dishes[$dishesId[$i] - 1]['name'] }} </div>
                <div class="dishesDescription"> {{ $dishes[$dishesId[$i] - 1]['description'] }}
                    {{ '€' }}{{ $dishes[$dishesId[$i] - 1]['price'] }}</div>

                <br>
            @else
                <div class="dishesNoEdit"> {{ $dishes[$dishesId[$i] - 1]['name'] }} </div>
                <div class="dishesDescription"> {{ $dishes[$dishesId[$i] - 1]['description'] }}
                    {{ '€' }}{{ $dishes[$dishesId[$i] - 1]['price'] }}</div>

                <br>
            @endif
        @endif
    @endfor

    </div>
    </div>
    @endif
    </div>
@endsection
