<?php

namespace App\Classes;

class ErrorMessages
{
    public const NOT_FOUND = 404;
    public const NOT_FOUND_MSG = 'Resource not found!';

    public const CAN_NOT_DELETE = 1000;
    public const CAN_NOT_DELETE_MSG = 'Resource could not be deleted!';

    public const CAN_NOT_CREATE = 1001;
    public const CAN_NOT_CREATE_MSG = 'Resource could not be created!';

    public const CAN_NOT_UPDATE = 1002;
    public const CAN_NOT_UPDATE_MSG = 'Resource could not be updated!';
}
