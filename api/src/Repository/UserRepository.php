<?php

	namespace App\Repository;

	use Doctrine\ORM\EntityRepository;
	use Doctrine\ORM\QueryBuilder;

	class UserRepository extends EntityRepository
	{
		/** @var QueryBuilder */
		private $queryBuilder;

		/** @var string */
		private $alias;

		public function getQueryBuilder(): QueryBuilder
		{
			return $this->queryBuilder;
		}

		public function getAlias(): string
		{
			return $this->alias;
		}

		public function init(string $alias = 'u')
		{
			$this->alias = $alias;
			$this->queryBuilder = $this->createQueryBuilder($alias);
		}

		public function whereUsername(QueryBuilder $qb, string $alias, string $username): UserRepository
		{
			$qb
				->andWhere($alias . '.username = :username')
				->setParameter('username', $username);

			return $this;
		}

		public function wherePassword(QueryBuilder $qb, string $alias, string $password): UserRepository
		{
			$qb
				->andWhere($alias . '.password = :password')
				->setParameter('password', $password);

			return $this;
		}
	}
