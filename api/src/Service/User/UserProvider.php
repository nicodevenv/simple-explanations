<?php

	namespace App\Service\User;

	use App\Entity\User;
	use App\Repository\UserRepository;
	use App\Service\AbstractProvider;
	use Doctrine\ORM\EntityManagerInterface;

	/**
	 * @method UserRepository getRepository()
	 */
	class UserProvider extends AbstractProvider
	{
		public function __construct(EntityManagerInterface $entityManager)
		{
			parent::__construct($entityManager, User::class);
		}

		/**
		 * @return User|null
		 * @throws \Doctrine\ORM\NonUniqueResultException
		 */
		public function findOneByUsername(string $username): ?User
		{
			$this->getRepository()->init();
			$this->getRepository()
				->whereUsername(
					$this->getRepository()->getQueryBuilder(),
					$this->getRepository()->getAlias(),
					$username
				);

			return $this->getRepository()->getQueryBuilder()
				->getQuery()
				->getOneOrNullResult();
		}

		/**
		 * @return User|null
		 * @throws \Doctrine\ORM\NonUniqueResultException
		 */
		public function findOneByUsernameAndPassword(string $username, string $password): ?User
		{
			$this->getRepository()->init();
			$this->getRepository()
			     ->whereUsername(
				     $this->getRepository()->getQueryBuilder(),
				     $this->getRepository()->getAlias(),
				     $username
			     )
			     ->wherePassword(
				     $this->getRepository()->getQueryBuilder(),
				     $this->getRepository()->getAlias(),
				     $password
			     );

			return $this->getRepository()->getQueryBuilder()
			            ->getQuery()
			            ->getOneOrNullResult();
		}
	}
