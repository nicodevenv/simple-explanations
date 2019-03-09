<?php

	namespace App\Service;

	use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

	class AbstractService
	{
		/** @var AbstractProvider */
		private $provider;

		/** @var AbstractPersister */
		private $persister;

		/** @var ObjectNormalizer */
		private $normalizer;

		public function __construct(AbstractProvider $provider, AbstractPersister $persister, ObjectNormalizer $normalizer)
		{
			$this->provider = $provider;
			$this->persister = $persister;
			$this->normalizer = $normalizer;
		}

		/**
		 * @return AbstractProvider
		 */
		public function getProvider(): AbstractProvider
		{
			return $this->provider;
		}

		/**
		 * @return AbstractPersister
		 */
		public function getPersister(): AbstractPersister
		{
			return $this->persister;
		}

		/**
		 * @return ObjectNormalizer
		 */
		public function getNormalizer(): ObjectNormalizer
		{
			return $this->normalizer;
		}
	}
