<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class CreateProjectDTO
{
    public $ProjectName;
    public $ProjectDescription;
    public $publicKey;
    public $statusKey;

    public function __construct($ProjectName, $ProjectDescription, $publicKey, $statusKey)
    {
        $this->ProjectName = $ProjectName;
        $this->ProjectDescription = $ProjectDescription;
        $this->publicKey = $publicKey;
        $this->statusKey = $statusKey;
    }

    public static function fromRequest(Request $request)
    {
        return new self(
            $request->input('ProjectName'),
            $request->input('ProjectDescription'),
            $request->input('publicKey'),
            $request->input('statusKey')
        );
    }
}
