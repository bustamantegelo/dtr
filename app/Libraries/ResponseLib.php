<?php

namespace App\Libraries;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

/**
 * ResponseLib
 * @package App\Libraries
 * @author  John Paul Salvosa <john08@simplexi.com.ph>
 * @since   01/02/2019
 * @version 1.0
 */
class ResponseLib
{
    /** Definition of Constants */
    const APP_TYPE_JS = 'javascript';
    const CODE = 'code';
    const DATA = 'data';
    const ERROR = 'error';
    const MESSAGE = 'message';
    const EMPTY_ARRAY = [];
    const EMPTY_STRING = '';
    const MSG_OK = 'Successful Request';
    const MSG_BAD_REQUEST = 'The request could not be understood by the server due to malformed syntax. The client SHOULD NOT repeat the request without modifications.';
    const MSG_FORBIDDEN = 'You don\'t have permission to access on this server. Additionally, a 403 Forbidden error was encountered while trying to use an ErrorDocument to handle the request.';
    const MSG_NOT_FOUND = 'We can\'t seem to find the page you\'re looking for';
    const MSG_INTERNAL_SERVER = 'The server encountered an unexpected condition which prevented it from fulfilling the request.';

    /**
     * Exception codes
     * @var array
     */
    private static $aExceptionCodes = [
        Response::HTTP_TOO_MANY_REQUESTS
    ];

    /**
     * Set errors
     * insert code & message into an array with proper format
     * then categorize it by view or json.
     * @param string $iCode
     * @param string $sMessage
     * @param bool   $bView
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public static function setErrors($iCode, $sMessage, $bView = false)
    {
        $aData = self::formatResponse(self::EMPTY_ARRAY, $iCode, $sMessage);
        return self::categorizeResponse($aData, $bView);
    }

    /**
     * Filter between error and successful response,
     * check data if it's in proper format,
     * insert it into an array with proper format if it isn't
     * then categorize it by view or json.
     * @param mixed  $mData
     * @param string $sView
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public static function filterResponse($mData, $sView = '')
    {
        if ($sView === self::APP_TYPE_JS) {
            return self::loadResponse($mData);
        }
        $bCorrectFormat = self::checkResponse($mData) !== true;
        $iCode = $bCorrectFormat ? Response::HTTP_OK : $mData[self::CODE];
        $sMessage = $bCorrectFormat ? self::MSG_OK : $mData[self::MESSAGE];
        $mData = $bCorrectFormat ? $mData : $mData[self::DATA];
        $aData = self::formatResponse($mData, $iCode, $sMessage);
        $bView = $sView === self::EMPTY_STRING ? false : true;
        return self::categorizeResponse($aData, $bView, $sView);
    }

    /**
     * Check response if it is in proper format
     * @param mixed $mData
     * @return bool
     */
    private static function checkResponse($mData)
    {
        $aOffsets = [self::CODE, self::DATA, self::MESSAGE];
        $bCorrectFormat = true;
        for ($i = 0; $i < count($aOffsets); $i++) {
            $sOffset = $aOffsets[$i];
            $bExists = !array_key_exists($sOffset, $mData);
            $bCorrectFormat = $bExists ? false : $bCorrectFormat;
        }
        return $bCorrectFormat;
    }

    /**
     * Format response with data
     * @param mixed  $mData
     * @param int    $iCode
     * @param string $sMessage
     * @return array
     */
    private static function formatResponse($mData, $iCode, $sMessage)
    {
        $aStatusTexts = Response::$statusTexts;
        $bCommonStatusCode = array_key_exists($iCode, $aStatusTexts);
        $iCode = $bCommonStatusCode ? $iCode : Response::HTTP_INTERNAL_SERVER_ERROR;
        if ($iCode !== Response::HTTP_OK) {
            Log::error($sMessage);
            $mData = self::getData($iCode, $aStatusTexts);
            $sMessage = self::getMessage($iCode, $aStatusTexts);
            $iCode = self::getCode($iCode);
        }
        return [self::CODE => $iCode, self::DATA => $mData, self::MESSAGE => $sMessage];
    }

    /**
     * Get response code
     * @param int $iCode
     * @return int
     */
    private static function getCode($iCode)
    {
        return in_array($iCode, self::$aExceptionCodes) ? Response::HTTP_OK : $iCode;
    }

    /**
     * Get response data
     * @param int   $iCode
     * @param array $aStatusTexts
     * @return int
     */
    private static function getData($iCode, $aStatusTexts)
    {
        return in_array($iCode, self::$aExceptionCodes) ? $iCode : $aStatusTexts[$iCode];
    }

    /**
     * Get response message
     * @param int $iCode
     * @param array $aStatusTexts
     * @return mixed|string
     */
    private static function getMessage($iCode, $aStatusTexts)
    {
        $aMessage = [
            Response::HTTP_BAD_REQUEST       => self::MSG_BAD_REQUEST,
            Response::HTTP_FORBIDDEN         => self::MSG_FORBIDDEN,
            Response::HTTP_NOT_FOUND         => self::MSG_NOT_FOUND,
            Response::HTTP_TOO_MANY_REQUESTS => $aStatusTexts[Response::HTTP_TOO_MANY_REQUESTS]
        ];
        return isset($aMessage[$iCode]) ? $aMessage[$iCode] : self::MSG_INTERNAL_SERVER;
    }

    /**
     * @param array  $aData
     * @param bool   $bView
     * @param string $sView
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    private static function categorizeResponse($aData, $bView, $sView = '')
    {
        $sCode = $aData[self::CODE];
        return $bView === false ? self::fetchResponse($aData, $sCode) : self::viewResponse($aData, $sCode, $sView);
    }

    /**
     * Load response file
     * @param string $sScript
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    private static function loadResponse($sScript)
    {
        $aHeaders = [
            'Content-Type' => 'application/javascript'
        ];
        return response($sScript)->withHeaders($aHeaders);
    }

    /**
     * Fetch response
     * @param array  $aData
     * @param string $sCode
     * @return \Illuminate\Http\JsonResponse
     */
    private static function fetchResponse($aData, $sCode)
    {
        return response()->json($aData, $sCode);
    }

    /**
     * Fetch response
     * @param array  $aData
     * @param string $sCode
     * @param string $sView
     * @return \Illuminate\Http\Response
     */
    private static function viewResponse($aData, $sCode, $sView)
    {
        $bSuccess = $sCode === Response::HTTP_OK;
        $bExceptedCode = in_array($aData[self::DATA], self::$aExceptionCodes);
        $sView = $bSuccess && !$bExceptedCode ? $sView : self::ERROR;
        return response()->view($sView, $aData, $sCode);
    }
}
