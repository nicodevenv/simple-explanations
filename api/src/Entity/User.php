<?php

	namespace App\Entity;

	use Ramsey\Uuid\Uuid;
	use Doctrine\ORM\Mapping as ORM;

	/**
	 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
	 * @ORM\HasLifecycleCallbacks()
	 */
	class User
	{
		/**
		 * @ORM\Id
		 * @ORM\Column(type="string")
		 * @var ?string
		 */
		private $uuid;

		/**
		 * @var string
		 *
		 * @ORM\Column(type="string", length=20)
		 */
		private $username = '';

		/**
		 * @var string
		 *
		 * @ORM\Column(type="string", length=255)
		 */
		private $password = '';

		/**
		 * @return mixed
		 */
		public function getUuid()
		{
			return $this->uuid;
		}

		/**
		 * @ORM\PrePersist
		 * @param mixed $uuid
		 *
		 * @return User
		 */
		public function setUuid($uuid)
		{
			if (is_string($uuid)) {
				$this->uuid = $uuid;

				return $this;
			}

			$this->uuid = Uuid::uuid4()->toString();
			return $this;
		}

		/**
		 * @return string
		 */
		public function getUsername(): string
		{
			return $this->username;
		}

		/**
		 * @param string $username
		 *
		 * @return User
		 */
		public function setUsername(string $username): User
		{
			$this->username = $username;
			return $this;
		}

		/**
		 * @return string
		 */
		public function getPassword(): string
		{
			return $this->password;
		}

		/**
		 * @param string $password
		 *
		 * @return User
		 */
		public function setPassword(string $password): User
		{
			$this->password = $password;
			return $this;
		}
	}
