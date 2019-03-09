<?php

	namespace App\Service\User\Account;

	use App\Entity\User;
	use App\Service\AbstractService;
	use App\Service\User\UserPersister;
	use App\Service\User\UserProvider;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

	/**
	 * @method UserProvider getProvider()
	 * @method UserPersister getPersister()
	 */
	class AccountService extends AbstractService
 	{
 		private const USERNAME_MINIMUM_LENGTH = 3;
 		private const PASSWORD_MINIMUM_LENGTH = 4;

		public function __construct(UserProvider $provider, UserPersister $persister, ObjectNormalizer $normalizer)
		{
			parent::__construct($provider, $persister, $normalizer);
		}

		/**
		 * @param User $user
		 *
		 * @throws AccountException
		 */
		public function registerUser(User $user): void
		{
			$this->checkRegisterData($user);

			$this->getPersister()->save($user);
		}

		/**
		 * @param string $username
		 * @param string $password
		 *
		 * @return User
		 * @throws AccountException
		 */
		public function loginUser(string $username, string $password): User
		{
			$user = $this->getProvider()->findOneByUsernameAndPassword($username, $password);

			if (null === $user) {
				throw new AccountException('User not found', Response::HTTP_BAD_REQUEST);
			}

			return $user;
		}

		/**
		 * @throws AccountException
		 */
		private function checkRegisterData(User $user): void
		{
			if (null !== $this->getProvider()->findOneByUsername($user->getUsername())) {
				throw new AccountException('Username already in use', Response::HTTP_BAD_REQUEST);
			}

			if (null === $user->getUsername() || strlen($user->getUsername()) < self::USERNAME_MINIMUM_LENGTH) {
				throw new AccountException(sprintf('Username length must be > %s', self::USERNAME_MINIMUM_LENGTH), Response::HTTP_BAD_REQUEST);
			}

			if (null === $user->getPassword() || strlen($user->getPassword()) < self::PASSWORD_MINIMUM_LENGTH) {
				throw new AccountException(sprintf('Password length must be > %s', self::PASSWORD_MINIMUM_LENGTH), Response::HTTP_BAD_REQUEST);
			}
		}
	}
