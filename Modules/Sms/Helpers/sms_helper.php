<?php

namespace Modules\Sms\Helpers;

class sms_helper
{
    public static $SMS_PATTERNS = [
        'verify_user' => "کاربر گرامی کد تایید شما:\n %s",

        'reserve_success_manager' => "مدیریت گرامی یک رزرو برای %s %s توسط کاربر %s برای تاریخ %s ثبت شد.",
        'reserve_success_user' => "کاربر گرامی رزرو %s %s برای تاریخ %s با موفقیت انجام شد و هماهنگی لازم برای پذیرایی از شما انجام خواهد شد. سپاس از انتخاب شما \n بامیز",
        'reserve_success_restaurant_manager' => "مدیر گرامی یک رزرو برای مرکز %s توسط کاربر %s برای تاریخ %s به ثبت رسید. برای مشاهده جزییات رزرو وارد پنل خود شوید. \n بامیز",
    ];
}
