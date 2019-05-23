<?php

namespace App\Http\Controllers\Api;

use Dingo\Api\Http\Request;

interface APIInterface
{
    public function index(Request $request);

    public function show($personalinformation);

    public function destroy($personalinformation);

    public function update(Request $request, $personalinformation);

    public function store(Request $request);
}
