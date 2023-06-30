<?php


namespace App\Enums;


class EnumHelpers
{
    static $UserLevelEnum = ['user', 'staff', 'admin', 'restaurant_manager'];
    static $PlaceTypesEnum = ['restaurant', 'cafe', 'hotel'];
    static $ArticleStatusEnum = ['draft', 'publish', 'done'];
    static $CommentStatusEnum = ['pending', 'approved', 'reject'];
    static $CommentScoreEnum = [1, 2, 3, 4, 5];
    static $WorkTimeItemsEnum = ['شنبه', 'یکشنبه', 'دو شنبه', 'سه شنبه', 'چهار شنبه', 'پنچ شنبه', 'جمعه'];
    static $TicketStatusEnum = ['waiting', 'answered', 'close'];
    static $ReserveTypesEnum = ['table_for_food', 'work_appointment', 'table_for_birth_day_with_food', 'table_for_birth_day_without_food'];
}
