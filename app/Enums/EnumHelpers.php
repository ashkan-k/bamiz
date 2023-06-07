<?php


namespace App\Enums;


class EnumHelpers
{
    static $UserLevelEnum = ['user', 'staff', 'admin', 'restaurant_manager'];
    static $PlaceTypesEnum = ['restaurant', 'cafe', 'hotel'];
    static $ArticleStatusEnum = ['draft', 'publish', 'done'];
    static $CommentStatusEnum = ['pending', 'approved', 'reject'];
    static $TicketStatusEnum = ['waiting', 'answered', 'close'];
}
