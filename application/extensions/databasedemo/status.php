<?php

// Status codes
CondDefine('STATUS_OK', 0);
// SQL errors
CondDefine('STATUS_SQL_ERROR', 1000);
// restserver errors
CondDefine('STATUS_INVALID_ACTION', 2000);
// sendmail errors
CondDefine('STATUS_TEMPLATE_CAN_NOT_LOADED', 3000);
// DatabaseDemo errors
CondDefine('STATUS_VERSION_NOTFOUND', 30000);

// status message language keys
CondDefine('STATUS', array(
    STATUS_OK => 'STATUS_OK',
    STATUS_SQL_ERROR => 'STATUS_SQL_ERROR',
    STATUS_INVALID_ACTION => 'STATUS_INVALID_ACTION',
    STATUS_TEMPLATE_CAN_NOT_LOADED => 'STATUS_TEMPLATE_CAN_NOT_LOADED',
    STATUS_VERSION_NOTFOUND => 'STATUS_VERSION_NOTFOUND',
));