<?php

	namespace App\Controller;

	use Symfony\Component\HttpFoundation\JsonResponse;
	use Symfony\Component\HttpFoundation\Response;

	class DefaultController extends AbstractController
	{
		public function healthAction()
		{
			return new JsonResponse([
				'message' => 'Api is running',
			], Response::HTTP_OK);
		}
	}
