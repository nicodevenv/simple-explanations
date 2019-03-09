<?php

	namespace App\Controller;

	use App\Entity\User;
	use App\Service\User\Account\AccountService;
	use Symfony\Component\HttpFoundation\JsonResponse;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Serializer\Exception\ExceptionInterface;

	class UserController extends AbstractController
	{
		public function registerAction(Request $request, AccountService $accountService)
		{
			try {
				/** @var User $user */
				$user = $accountService->getNormalizer()->denormalize($this->getPostData($request), User::class, 'json');
				$accountService->registerUser($user);

				return new JsonResponse($accountService->getNormalizer()->normalize($user, 'array'), Response::HTTP_OK);
			} catch(ExceptionInterface $e) {
				return new JsonResponse([
					'code' => $e->getCode(),
					'message' => $e->getMessage(),
				], $e->getCode());
			} catch(\Exception $e) {
				return new JsonResponse([
					'code' => $e->getCode(),
					'message' => $e->getMessage(),
				], $e->getCode());
			}
		}

		public function loginAction(Request $request, AccountService $accountService)
		{
			try {
				/** @var User $user */
				$user = $accountService->getNormalizer()->denormalize($this->getPostData($request), User::class, 'json');
				$dbUser = $accountService->loginUser($user->getUsername(), $user->getPassword());

				return new JsonResponse($accountService->getNormalizer()->normalize($dbUser, 'array'), Response::HTTP_OK);
			} catch(ExceptionInterface $e) {
				return new JsonResponse([
					'code' => $e->getCode(),
					'message' => $e->getMessage(),
				], $e->getCode());
			} catch(\Exception $e) {
				return new JsonResponse([
					'code' => $e->getCode(),
					'message' => $e->getMessage(),
				], $e->getCode());
			}
		}
	}
