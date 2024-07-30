<?php

namespace App\Core\Http;

use Router\Http\Request as HttpRequest;

class Request extends HttpRequest
{

    public function __construct(
        private readonly Validator $validator)
    {
        parent::__construct($method, $uri, $headers, $body, $parsedBody, $queryParams, $serverParams, $uploadedFiles);
    }

    public function validate(array $rules, array $messages = [])
    {
        $this->validator->validate($this->getParsedBody(), $rules, $messages);
    }
}