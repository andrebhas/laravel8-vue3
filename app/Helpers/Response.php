<?php

function success($data = null, $status = true, $message = 'Success', $code = 200)
{
    return response()->json([
        'status' => $status,
        'status_code' => $code,
        'message' => $message,
        'data' => $data,
    ], $code);
}

function badRequest($message = null)
{
    return response()->json([
        'status' => false,
        'status_code' => 400,
        'message' => $message ?? 'Bad Request',
        'data' => null,
    ], 400);
}

function unAuthorized($message  = null)
{
    return response()->json([
        'status' => false,
        'status_code' => 401,
        'message' => $message ?? 'Unauthorized',
        'data' => null,
    ], 401);
}

function forbidden($message  = null)
{
    return response()->json([
        'status' => false,
        'status_code' => 403,
        'message' => $message ?? 'Forbidden',
        'data' => null,
    ], 403);
}

function notFound($message = null)
{
    return response()->json([
        'status' => false,
        'status_code' => 404,
        'message' => $message ?? 'Not Found',
        'data' => null,
    ], 404);
}

function notAcceptable($message = null)
{
    return response()->json([
        'status' => false,
        'status_code' => 406,
        'message' => $message ?? 'Not Acceptable',
        'data' => null,
    ], 406);
}

function internalServerError($message = null)
{
    return response()->json([
        'status' => false,
        'status_code' => 500,
        'message' => $message ?? 'Something went wrong. Please try again later',
        'data' => null,
    ], 500);
}

function paging($data)
{
    return response()->json($data, 200);
}
