<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleHttpRequest;
use Modules\Seller\Entities\SellerAuth;

if (!function_exists('numberRandom')) {
    function numberRandom($count = 6)
    {
        $numbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $randomNumber = '';
        for ($i = 1; $i <= $count; $i++) {
            shuffle($numbers);
            $randomNumber .= $numbers[0];
        }
        return $randomNumber;
    }
}

if (!function_exists('getAppPrefix')) {
    function getAppPrefix()
    {
        return strtoupper(substr(env('APP_NAME', 'ME'), 0, 2));
    }
}

if (!function_exists('isEmail')) {
    function isEmail($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}

if (!function_exists('isMobile')) {
    function isMobile($value)
    {
        if (preg_match("~^09\d{9}$~", $value)) {
            return true;
        }

        return false;
    }
}

if (!function_exists('getUserNameFromEmail')) {
    function getUserNameFromEmail($email)
    {
        return $username = Str::before($email, '@');
    }
}

if (!function_exists('getClientId')) {
    function getClientId()
    {
        $client_agent = $_SERVER['HTTP_USER_AGENT'];
        $user_ip = $_SERVER['REMOTE_ADDR'];
        return $user_ip . '_' . strtolower(md5($client_agent));
    }
}

if (!function_exists('sendSMS')) {
    function sendSMS($txt = '', $phoneNumber = '', $verifyCode = false)
    {
        if ($verifyCode) {
            $url = 'http://RestfulSms.com/api/Token';
            $data = [
                "UserApiKey" => getSetting('userApiKey'),
                "SecretKey" => getSetting('secretKey'),
            ];
            $headers = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ];
            $client = new Client([
                'headers' => $headers,
                'form_params' => $data
            ]);
            $response = new GuzzleHttpRequest('POST', $url);
            $response = $client->send($response);
            if ($response) {
                $response = json_decode($response->getBody()->getContents(), true);
                if ($response) {
                    $url_2 = 'http://RestfulSms.com/api/UltraFastSend';
                    $smsToken = $response['TokenKey'];
                    $data_2 = [
                        "ParameterArray" => [
                            [
                                "Parameter" => "VerificationCode",
                                "ParameterValue" => $txt
                            ]
                        ],
                        "Mobile" => $phoneNumber,
                        "TemplateId" => "18231"
                    ];
                    $headers_2 = [
                        'Content-Type' => 'application/json',
                        'x-sms-ir-secure-token' => $smsToken
                    ];
                    $client_2 = new Client([
                        'headers' => $headers_2,
                        'form_params' => $data_2
                    ]);
                    $response_2 = new GuzzleHttpRequest('POST', $url_2);
                    $response_2 = $client_2->send($response_2);
                    if ($response_2) {
                        return true;
                    }
                }
            }
        } else {
            ini_set("soap.wsdl_cache_enabled", "0");
            try {
                $sms_client = new SoapClient('http://api.payamak-panel.com/post/send.asmx?wsdl', array('encoding' => 'UTF-8'));
                $parameters['username'] = getSetting('sms_username');
                $parameters['password'] = getSetting('sms_password');
                $parameters['to'] = $phoneNumber;
                $parameters['from'] = "50001060659520";
                $parameters['text'] = $txt;
                $parameters['isflash'] = false;
                $sms_client->SendSimpleSMS2($parameters)->SendSimpleSMS2Result;
                Log::info($sms_client->SendSimpleSMS2($parameters)->SendSimpleSMS2Result);
            } catch (SoapFault $ex) {
                Log::error('error = ' . $ex->faultstring);
            }
        }
    }
}

if (!function_exists('paginate')) {
    function paginate($items, $perPage)
    {
        $pageStart = request('page', 1);
        $offSet = ($pageStart * $perPage) - $perPage;
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, TRUE);

        return new Illuminate\Pagination\LengthAwarePaginator(
            $itemsForCurrentPage, count($items), $perPage,
            Illuminate\Pagination\Paginator::resolveCurrentPage(),
            ['path' => Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );
    }
}

if (!function_exists('toGregorian')) {
    function toGregorian($date, $delimiter = '-', $fullDate = false)
    {
        $date = explode($delimiter, $date);
        $date = implode($delimiter, \Morilog\Jalali\CalendarUtils::toGregorian($date[0], $date[1], $date[2]));
        return $date = $fullDate
            ? $date . ' ' . now()->format('H:i:s')
            : $date;

    }
}

if (!function_exists('getSetting')) {
    function getSetting($settingName)
    {
        return \App\Models\Setting::where('name', $settingName)->pluck('value')->first();

    }
}

if (!function_exists('setEnvironmentValue')) {
    function setEnvironmentValue($values = [])
    {
        Artisan::call('config:clear');
        $path = base_path('.env');
        if (file_exists($path)) {
            if (count($values) > 0) {
                foreach ($values as $envKey => $envValue) {
                    $oldEnvValue = $envKey . '=' . env($envKey);
                    $newEnvValue = $envKey . '=' . $envValue;
                    file_put_contents($path, str_replace(
                        "$oldEnvValue", $newEnvValue, file_get_contents($path)
                    ));
                }
            }
        }


        /*  $envFile = app()->environmentFilePath();
          $str = file_get_contents($envFile);

          if (count($values) > 0) {
              foreach ($values as $envKey => $envValue) {
                  //$str .= "\n"; // In case the searched variable is in the last line without \n
                  $keyPosition = strpos($str, "{$envKey}=");
                  $endOfLinePosition = strpos($str, "\n", $keyPosition);
                  $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                  // If key does not exist, add it
                  if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                      // $str .= "{$envKey}={$envValue}\n";
                  } else {
                      if (is_string($envValue)) {
                          $str = str_replace($oldLine, "{$envKey}='{$envValue}'", $str);
                      } else {
                          $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                      }

                  }

              }
          }

          $str = substr($str, 0, -1);
          if (!file_put_contents($envFile, $str)) return false;
          return true;*/

    }
}

if (!function_exists('unNumberFormat')) {
    function unNumberFormat($string)
    {
        return intval(str_replace(',', '', $string));
    }
}

if (!function_exists('checkForInstall')) {
    function checkForInstall()
    {
        return true;
        /*  $install = true;
          if (env('DB_DATABASE')) {
              try {
                  DB::connection()->getPdo();
                  if (Schema::hasTable('users')) {
                      if (DB::table('users')->count()) {
                          $install = false;
                      }
                  } else {
                      $install = true;
                  }
              } catch (\Exception $e) {
                  $install = true;
              }

          }
          return $install;*/

        return env('APP_ENV', 'local') == 'local' ?? false;
    }
}

if (!function_exists('makeCustomRuleByConditions')) {
    function makeCustomRuleByConditions($rules = [], $conditions = [])
    {
        unset($rules['required']);
        unset($rules['nullable']);
        $checkConditionRequired = $conditions[0] == $conditions[1];
        if ($checkConditionRequired) {
            $rules[] = 'required';
        } else {
            $rules = 'nullable';
        }


        return $rules;
    }
}

if (!function_exists('httpResponse')) {
    function HttpResponse($text, $code = 200)
    {
        switch ($code) {
            case 200:
            {
                return response([
                    "data" => $text,
                    'status' => 200,
                ], 200);
                break;
            }
            case 400:
            {
                return response([
                    "error" => $text,
                    'status' => 400,
                ], 400);
                break;
            }
            case 408:
            case 401:
            {
                return response([
                    "error" => $text,
                    'status' => $code,
                ], $code);
                break;
            }
            case 422:
            {
                return response([
                    "message" => "The given data was invalid.",
                    'errors' => [
                        "text" => [$text],
                    ],
                    'status' => 422,
                ], 422);
                break;
            }
            case 500:
            {
                return response([
                    "error" => 'خطای در سرور رخ داده است',
                    'status' => 500,
                ], 500);
                break;
            }
            default :
            {
                return response([
                    'error' => 'سرور از درسترس خارج است.',
                    'status' => 503
                ], 503);
                break;
            }
        }
    }
}

if (!function_exists('sellerAuth')) {
    function sellerAuth()
    {
        if (request()->header('token')) {
            /** @var SellerAuth $sellerAuth */
            $sellerAuth = SellerAuth::where('api_token', request()->header('token'))->first();
            if ($sellerAuth) {
                return $sellerAuth->seller;
            }
        }
        return null;
    }
}




