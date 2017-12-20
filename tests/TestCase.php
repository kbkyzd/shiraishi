<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Call the given URI with a JSON request.
     *
     * @param  string  $method
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $headers
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    public function json($method, $uri, array $data = [], array $headers = [])
    {
        $files = $this->extractFilesFromDataArray($data);

        $content = json_encode($data);

        $headers = array_merge([
            'CONTENT_LENGTH' => mb_strlen($content, '8bit'),
            'CONTENT_TYPE' => 'application/json',
            'Accept' => 'application/x.shiraishi.v1+json',
        ], $headers);

        return $this->call(
            $method, $uri, [], [], $files, $this->transformHeadersToServerVars($headers), $content
        );
    }
}
