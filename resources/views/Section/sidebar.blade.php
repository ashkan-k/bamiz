<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">بامیز</li>
                <li class="@if(str_starts_with(\Illuminate\Support\Facades\Route::current()->getName(), 'dashboard')) active @endif">
                    <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> داشبورد</a>
                </li>
                <li class="@if(str_starts_with(\Illuminate\Support\Facades\Route::current()->getName(), 'profile')) active @endif">
                    <a href="{{ route('profile') }}"><i class="fa fa-user-circle-o"></i> پروفایل</a>
                </li>

                @if(auth()->user()->is_staff())
                    {{--//////////////////////////////////////////////////--}}

                    <li class="submenu">
                        <a href="#"><i class="fa fa-map" aria-hidden="true"></i> <span>شهرو استان</span> <span
                                class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="{{ route('provinces.index') }}">استان ها</a></li>
                            <li><a href="{{ route('cities.index') }}">شهر ها</a></li>
                        </ul>
                    </li>

                    {{--//////////////////////////////////////////////////--}}

                    <li class="submenu">
                        <a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> <span>زمان کاری میزبان ها</span>
                            <span
                                class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="{{ route('worktimes.index') }}">لیست زمان های کاری</a></li>
                            <li><a href="{{ route('worktimes.create') }}">افزودن زمان کاری</a></li>
                        </ul>
                    </li>

                    {{--//////////////////////////////////////////////////--}}


                    <li class="submenu">
                        <a href="#"><i class="fa fa-newspaper-o" aria-hidden="true"></i>
                            <span>مقالات و اخبار بامیز</span>
                            <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="{{ route('articles.index') }}">لیست مقالات و اخبار</a></li>
                            <li><a href="{{ route('articles.create') }}">افزودن مقاله و اخبار</a></li>
                        </ul>
                    </li>

                    {{--//////////////////////////////////////////////////--}}
                @endif

                <li class="submenu">
                    <a href="#"><i class="fa fa-coffee" aria-hidden="true"></i> <span>مراکز بامیز</span> <span
                            class="menu-arrow"></span></a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('places.index') }}">لیست مراکز</a></li>
                        @if(auth()->user()->is_staff())
                            <li><a href="{{ route('places.create') }}">افزودن مرکز جدید</a></li>
                        @endif
                    </ul>
                </li>


                @if(auth()->user()->is_staff())
                    {{--//////////////////////////////////////////////////--}}

                    <li class="submenu">
                        <a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>دسته بندی بامیز</span> <span
                                class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="{{ route('categories.index') }}">لیست دسته بندی</a></li>
                            <li><a href="{{ route('categories.create') }}">افزودن دسته بندی</a></li>
                        </ul>
                    </li>

                    {{--//////////////////////////////////////////////////--}}

                    <li class="submenu">
                        <a href="#"><i class="fa fa-user" aria-hidden="true"></i> <span>کاربران بامیز</span> <span
                                class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="{{ route('users.index') }}">لیست کاربران</a></li>
                            <li><a href="{{ route('users.create') }}">افزودن کابر جدید</a></li>
                            {{--                        <li><a href="{{ route('block_users.index') }}">لیست کاربران مسدودی</a></li>--}}
                        </ul>
                    </li>

                    {{--//////////////////////////////////////////////////--}}

                    <li class="submenu">
                        <a href="#"><i class="fa fa-handshake-o" aria-hidden="true"></i> <span>همکاری بامیز</span> <span
                                class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="{{ route('cooperations.index') }}">لیست درخواست ها</a></li>
                            <li><a href="{{ route('cooperations.create') }}">افزودن درخواست</a></li>
                        </ul>
                    </li>

                    {{--//////////////////////////////////////////////////--}}

                    <li class="submenu">
                        <a href="#"><i class="fa fa-comment" aria-hidden="true"></i> <span>نظرات بامیز</span> <span
                                class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="{{ route('comments.index') }}">نظرات</a></li>
                            <li><a href="{{ route('comments.index') }}?status=pending">در انتظارها</a></li>
                            <li><a href="{{ route('comments.index') }}?status=approved">تایید شده ها</a></li>
                            <li><a href="{{ route('comments.index') }}?status=reject">تایید نشده ها</a></li>
                        </ul>
                    </li>

                    {{--//////////////////////////////////////////////////--}}

                    <li class="submenu">
                        <a href="#"><i class="fa fa-heart" aria-hidden="true"></i> <span>علاقه کاربران بامیز</span>
                            <span
                                class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="{{ route('wishlists.index') }}">لیست علاقه مندی ها</a></li>
                        </ul>
                    </li>

                    {{--//////////////////////////////////////////////////--}}

                    {{--                <li class="menu-title">سطح دسترسی و مقام ها</li>--}}

                    {{--                <li class="submenu">--}}
                    {{--                    <a href="#"><i class="fa fa-cog" aria-hidden="true"></i> <span>لیست دسترسی ها بامیز</span> <span--}}
                    {{--                            class="menu-arrow"></span></a>--}}
                    {{--                    <ul class="list-unstyled" style="display: none;">--}}
                    {{--                        <li><a href="{{ route('permissions.index') }}">لیست دسترسی ها</a></li>--}}
                    {{--                        <li><a href="{{ route('permissions.create') }}">افزودن دسترسی جدید</a></li>--}}
                    {{--                    </ul>--}}
                    {{--                </li>--}}

                    {{--                <li class="submenu">--}}
                    {{--                    <a href="#"><i class="fa fa-black-tie" aria-hidden="true"></i> <span>مقام ها بامیز</span> <span--}}
                    {{--                            class="menu-arrow"></span></a>--}}
                    {{--                    <ul class="list-unstyled" style="display: none;">--}}
                    {{--                        <li><a href="{{ route('roles.index') }}">لیست مقام های بامیز</a></li>--}}
                    {{--                        <li><a href="{{ route('roles.create') }}">افزودن مقام جدید</a></li>--}}
                    {{--                    </ul>--}}
                    {{--                </li>--}}

                    {{--                <li class="submenu">--}}
                    {{--                    <a href="#"><i class="fa fa-user-circle-o" aria-hidden="true"></i> <span>کاربران دارای مقام</span>--}}
                    {{--                        <span class="menu-arrow"></span></a>--}}
                    {{--                    <ul class="list-unstyled" style="display: none;">--}}
                    {{--                        <li><a href="{{ route('roles_users.index') }}">لیست کاربران مقام دار</a></li>--}}
                    {{--                        <li><a href="{{ route('roles_users.create') }}">اعطای مقام به کاربر</a></li>--}}
                    {{--                    </ul>--}}
                    {{--                </li>--}}

                    {{--//////////////////////////////////////////////////--}}

                    <li class="menu-title">رزرو ها</li>

                    <li class="submenu">
                        <a href="#"><i class="fa fa-ticket" aria-hidden="true"></i> <span>مناسبت ها (انواع رزرو)</span>
                            <span
                                class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="{{ route('reserve-types.index') }}">لیست مناسبت ها</a></li>
                            <li><a href="{{ route('reserve-types.create') }}">افزودن مناسبت</a></li>
                        </ul>
                    </li>

                    <li class="submenu">
                        <a href="#"><i class="fa fa-ticket" aria-hidden="true"></i> <span>رزرو های بامیز</span> <span
                                class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="{{ route('reserves.index') }}">لیست رزرو ها</a></li>
                            <li><a href="{{ route('reserves.index') }}?status=1">لیست رزرو ها موفق</a></li>
                            <li><a href="{{ route('reserves.index') }}?status=0">لیست رزرو ها ناموفق</a></li>
                            <li><a href="{{ route('reserves.create') }}">افزودن رزرو</a></li>
                        </ul>
                    </li>

                    <li class="submenu">
                        <a href="#"><i class="fa fa-gift" aria-hidden="true"></i> <span>تشریفات بامیز</span> <span
                                class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="{{ route('options.index') }}">لیست تشریفات</a></li>
                            <li><a href="{{ route('options.create') }}">افزودن تشریفات جدید</a></li>
                        </ul>
                    </li>

                    {{--//////////////////////////////////////////////////--}}

                    <li class="menu-title">تیکت ها</li>

                    <li class="submenu">
                        <a href="#"><i class="fa fa-ticket" aria-hidden="true"></i> <span>دسته بندی تیکت ها</span> <span
                                class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="{{ route('ticket-categories.index') }}">لیست دسته بندی ها</a></li>
                            <li><a href="{{ route('ticket-categories.create') }}">افزودن دسته بندی</a></li>
                        </ul>
                    </li>

                    <li class="submenu">
                        <a href="#"><i class="fa fa-ticket" aria-hidden="true"></i> <span>تیکت ها</span> <span
                                class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="{{ route('tickets.index') }}">همه تیکت ها</a></li>
                            <li><a href="{{ route('tickets.index') }}?status=waiting">در انتظار ها</a></li>
                            <li><a href="{{ route('tickets.index') }}?status=answered">پاسخ داده شده ها</a></li>
                            <li><a href="{{ route('tickets.index') }}?status=close">بسته ها</a></li>
                        </ul>
                    </li>

                    {{--//////////////////////////////////////////////////--}}

                    <li class="submenu">
                        <a href="#"><i class="fa fa-phone" aria-hidden="true"></i> <span>تماس با ما بامیز</span> <span
                                class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="{{ route('contact_us.index') }}">لیست تماس با ما</a></li>
                        </ul>
                    </li>

                    {{--//////////////////////////////////////////////////--}}

                    <li class="submenu">
                        <a href="#"><i class="fa fa-paypal" aria-hidden="true"></i> <span>پرداخت ها بامیز</span> <span
                                class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="{{ route('payments.index') }}">لیست پرداخت ها</a></li>
                        </ul>
                    </li>

                    {{--                --}}{{--                ///////////////////////////////////////////////////////////--}}

                    {{--                <li class="submenu">--}}
                    {{--                    <a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> <span>مدیریت کش ها</span> <span--}}
                    {{--                            class="menu-arrow"></span></a>--}}
                    {{--                    <ul class="list-unstyled" style="display: none;">--}}
                    {{--                        <li><a href="{{ route('caches.delete') }}">حذف کش ها</a></li>--}}
                    {{--                    </ul>--}}
                    {{--                </li>--}}

                    {{--                --}}{{--                ////////////////////////////////////////////////////////////////////////////--}}

                    <li class="submenu">
                        <a href="#"><i class="fa fa-cog" aria-hidden="true"></i> <span>تنظیمات بامیز</span> <span
                                class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a href="{{ route('settings.index') }}">لیست تنظیمات</a></li>
                            <li><a href="{{ route('settings.index') }}">افزودن تنظیمات</a></li>
                        </ul>
                    </li>
                    {{--//////////////////////////////////////////////////--}}
                @endif

            </ul>
        </div>
    </div>
</div>
