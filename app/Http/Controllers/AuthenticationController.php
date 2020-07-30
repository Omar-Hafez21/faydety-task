<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Propaganistas\LaravelPhone\PhoneNumber;
use LVR\CountryCode\Two;

/**
 * @OA\Post(
 * path="/api/registration",
 * summary="Register",
 * description="Login by phone number, password",
 * operationId="authLogin",
 * tags={"auth"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"password","first_name","last_name","country_code","gender","birthdate","avatar","phone_number"},
 *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
 *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
 *       @OA\Property(property="avatar", type="string", format="base64", example="data:image/jpeg;base64, yourSuperLongStringBinary"),
 *     @OA\Property(property="first_name", type="string", example="ahmed"),
 *     @OA\Property(property="last_name", type="string", example="adel"),
 *     @OA\Property(property="birthdate", type="string", example="+201095222457"),
 *     @OA\Property(property="phone_number", type="string", format="E.164", example="+201095222457"),
 *     @OA\Property(property="country_code", type="string", example="EG"),
 *    ),
 * ),
 * @OA\Response(
 *    response=422,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
 *        )
 *     )
 * )
 */

/**
 * @OA\Post(
 * path="/api/signIn",
 * summary="LinkStatus",
 * description="link status with user",
 * operationId="authLogin",
 * tags={"auth"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"password","phone_number"},
 *       @OA\Property(property="phone_number", type="string", example="+201095111472"),
 *       @OA\Property(property="password", type="string", format="password", example="123456"),
 *    ),
 * ),
 * @OA\Response(
 *    response=401,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong phone number address or password. Please try again")
 *        )
 *     )
 * )
 */

class AuthenticationController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function registration(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required|phone:AUTO|min:10|max:15',
            'phone_number' => 'numeric|unique:users',
            'country_code' => ['required', new Two],
            'gender' => [
                'required',
                Rule::in(['male','female']),
            ],
            'birthdate' => 'required|date|date_format:Y-m-d|before:today',
            'avatar' => 'required|mimes:jgp,jpeg,png',
            'email' => 'nullable|email|unique:users',
            'password' => 'required'
        ]);

        $valid_number_in_country = PhoneNumber::make($request->phone_number)->isOfCountry($request->country_code);
        if($valid_number_in_country){
            $response = $this->userService->signUp($request);
            return response()->json([$response],201);
        }else{
            return response()->json(['errors' => 'not_exist'],406);
        }
    }

    public function signIn(Request $request){

        $request->validate([
           'phone_number' => 'required',
           'password' => 'required',
        ]);
        $check = Auth::attempt( ['phone_number'=>$request->phone_number, 'password'=>$request->password],true );
        $response = $this->userService->logIn($check);
        return $response;
    }

}

