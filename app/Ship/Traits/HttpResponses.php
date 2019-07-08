<?php

namespace App\Ship\Traits;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait HttpResponses {

	public function badRequest($message = null)
	{
		throw new BadRequestHttpException($message);
	}


	public function unauthorized($message = null)
	{
		throw new UnauthorizedHttpException('challenge', $message);
	}


	public function forbidden($message = null)
	{
		throw new AccessDeniedHttpException($message);
	}


	public function notFound($message = null)
	{
		throw new NotFoundHttpException($message);
	}


	public function unprocessableEntity($data)
	{
		throw new UnprocessableEntityHttpException($data);
	}


	public function serviceUnavailable($data)
	{
		throw new ServiceUnavailableHttpException(null, $data);
	}


	public function success($message = 'ok', $data = null)
	{
		$result = [
			'message' => $message,
			'data' => null,
		];

		if ($data instanceOf Model || $data instanceOf Collection || $data instanceOf EloquentCollection) {
			$result['data'] = $data->toArray();
		}

		if (is_array($data)) {
			$result['data'] = $data;
		}

		if ($data instanceOf \stdClass) {
			$result['data'] = (Array) $data;
		}

		if (is_string($data)) {
			$result['data'] = $data;
		}

		return $result;
	}

    public function importFinish($message = 'ok', $data = null)
    {
        $result = [
            'message' => $message,
            'failed_for_import' => null,
        ];

        if ($data instanceOf Model || $data instanceOf Collection || $data instanceOf EloquentCollection) {
            $result['failed_for_import'] = $data->toArray();
        }

        if (is_array($data)) {
            $result['failed_for_import'] = $data;
        }

        if ($data instanceOf \stdClass) {
            $result['failed_for_import'] = (Array) $data;
        }

        if (is_string($data)) {
            $result['failed_for_import'] = $data;
        }

        return $result;
	}
}
