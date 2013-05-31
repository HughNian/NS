<?php
/***********************************************************
*
* 项目用CONSTANTS定义
*
**********************************************************/

/********************* API接口返回值  *************************/
define('RE_SUCCESS', 1000); //操作成功

/**
 * 系统错误码
 */
define('OFFSET_RE_SUCCESS',         RE_SUCCESS);
define('RE_COMMON_ERROR_DATA',      OFFSET_RE_SUCCESS+1);    //提交的JSON无法解析
define('RE_COMMON_UNKNOWN_CMD',     OFFSET_RE_SUCCESS + 2);  // 接口中提交了未知的CMD操作
define('RE_COMMON_UNKNOWN_OPT',     OFFSET_RE_SUCCESS + 3);  // 接口中提交了未知的OPT操作
define('RE_COMMON_ILLEGAL_DATA',    OFFSET_RE_SUCCESS + 7);  // 提交的JSON中data部分数据不合法，无法正常解析
define('RE_COMMON_INCORRECT_ARGS',  OFFSET_RE_SUCCESS + 9);  // 错误的参数信息
define('RE_COMMON_ERROR_UID',       OFFSET_RE_SUCCESS + 10); // 错误的用户编号