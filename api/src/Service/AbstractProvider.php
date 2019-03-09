<?php

	namespace App\Service;

	use Doctrine\ORM\EntityManagerInterface;

	class AbstractProvider
	{
		private $repository;

		public function __construct(EntityManagerInterface $entityManager, string $entityClass)
		{
			$this->repository = $entityManager->getRepository($entityClass);
		}

		protected function getRepository()
		{
			return $this->repository;
		}
	}
