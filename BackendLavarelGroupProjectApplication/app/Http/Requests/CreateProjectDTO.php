<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class CreateProjectDTO
{
    public $ProjectName;
    public $ProjectDescription;

    public function __construct($ProjectName, $ProjectDescription)
    {
        $this->ProjectName = $ProjectName;
        $this->ProjectDescription = $ProjectDescription;
    }

    public static function fromRequest(Request $request)
    {
        return new self(
            $request->input('ProjectName'),
            $request->input('ProjectDescription')
        );
    }
}
