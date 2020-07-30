<?php

namespace App\Http\Controllers;

use App\Services\StatusService;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 * path="/api/createStatus",
 * summary="LinkStatus",
 * description="link status with user",
 * operationId="authLogin",
 * tags={"auth"},
 * security={ {"bearer": {} }},
 *      * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"status","phone_number"},
 *       @OA\Property(property="phone_number", type="string", example="+201096444782"),
 *       @OA\Property(property="status", type="string", format="password", example="test status"),
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

class StatusController extends Controller
{
    protected $statusService;

    public function __construct(StatusService $statusService)
    {
        $this->statusService = $statusService;
    }

    public function createStatus(Request $request){
        $request->validate([
            'phone_number' => 'Required',
            'status' => 'Required',
        ]);
        $response = $this->statusService->createStatus($request);
        return $response;
    }
}
