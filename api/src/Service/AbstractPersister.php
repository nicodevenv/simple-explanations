<?php

	namespace App\Service;

	use Doctrine\ORM\EntityManagerInterface;

	class AbstractPersister
	{
		/** @var EntityManagerInterface */
		private $entityManager;

		public function __construct(EntityManagerInterface $entityManager)
		{
			$this->entityManager = $entityManager;
		}

		public function save($entity, bool $flush = true): void
		{
			$this->entityManager->persist($entity);

			if ($flush) {
				$this->entityManager->flush();
			}
		}
	}
