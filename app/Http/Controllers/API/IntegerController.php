<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Integer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IntegerController extends Controller
{
    /**
     * get the current integer (always latest)
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function current(Request $request)
    {
        $currentInteger = Integer::latest()->first();
        return $this->sendResponse($currentInteger, 'success');
    }

    /**
     * get the next integer (+1 increment)
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function next(Request $request)
    {
        $currentInteger = Integer::latest()->first();
        $nextInteger = Integer::create([
            'integer' => $currentInteger->integer + 1
        ]);
        return $this->sendResponse($nextInteger, 'success');
    }

    /**
     * update the current integer to any integer
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request){
        $rules = [
            'updated_integer' => 'required|integer'
        ];
        $messages = array(
            'updated_integer.required' => 'Please add a new integer to reset current integer'
        );
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $updatedInteger = Integer::create([
            'integer' => $request->updated_integer
        ]);

        return $this->sendResponse($updatedInteger, 'success');
    }

    /**
     * error response method.
     * @param $error
     * @param array $errorMessages
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    /**
     * success response method.
     * @param $result
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }
}
