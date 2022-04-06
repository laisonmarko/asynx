<?php

namespace App\Http\Controllers;
use App\Http\Traits\ApiTrait;
use App\Http\Traits\DbTrait;

use Illuminate\Http\Request;

class TicketStateController extends Controller
{
    use ApiTrait;
    use DbTrait;

    /**
     * returns a list of all priorities constant identifiers
     */
    public function index()
    {
        try {
            $ticket_states = $this->getTicketStates();

            $message = 'SUCCESS';
            $remark = 'all ticket_states fetched';
            $data = $ticket_states;
            $errors = null;
            $statusCode = 200;

            return $this->apiResponse($message, $remark, $data, $errors, $statusCode);

        } catch (\Throwable $th) {
            $message = 'FAILED';
            $remark = 'something went wrong';
            $data = null;
            $errors = $th;
            $statusCode = 500;

            return $this->apiResponse($message, $remark, $data, $errors, $statusCode);
        }
    }
}
