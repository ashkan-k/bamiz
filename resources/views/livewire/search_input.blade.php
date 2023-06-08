<div class="col-3 {{ isset($class) ? $class : 'col-lg-4' }}">
    <label for="search" style="margin-right: 15px !important;">جستجو</label>
    <input style="margin-bottom: 30px !important" id="search_text"
           wire:model.debounce.400="search" type="text" name="search"
{{--           onkeydown="$('#search_text').keypress(function (e) {--}}
{{--                            if (e.which == 13) {--}}
{{--                                $('#search').submit();--}}
{{--                                return false;    //<---- Add this line--}}
{{--                            }--}}
{{--                        })"--}}
           class="form-control rounded"
           placeholder="کلمه مورد نظر را وارد کنید">
</div>
