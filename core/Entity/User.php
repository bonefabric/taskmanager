<?php declare(strict_types=1);

namespace Core\Entity;

use Core\Common\Doctrine\SoftDeletes;
use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity(repositoryClass="Core\Repository\UserRepository")
 * @Table(name="users")
 */
class User
{
	use SoftDeletes;

	/**
	 * @Id
	 * @GeneratedValue(strategy="AUTO")
	 * @Column(type="integer")
	 */
	protected int $id;

	/**
	 * @Column(type="string", length=50)
	 */
	protected string $name;

	/**
	 * @Column(type="string", length=50, unique=true)
	 */
	protected string $email;

	/**
	 * @Column(type="string", length=50)
	 */
	protected string $password;

	/**
	 * @Column(type="integer")
	 * @OneToOne(targetEntity="Core\Entity\Role")
	 */
	protected int $role_ref;

	/**
	 * @Column(type="datetime")
	 */
	protected DateTime $created_at;

	/**
	 * @Column(type="datetime")
	 */
	protected DateTime $updated_at;

	/**
	 * @Column(type="datetime", nullable=true)
	 */
	protected DateTime $deleted_at;

	public function __construct()
	{
		$this->created_at = new DateTime();
		$this->updated_at = new DateTime();
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName(string $name): void
	{
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail(string $email): void
	{
		$this->email = $email;
	}

	/**
	 * @param string $password
	 */
	public function setPassword(string $password): void
	{
		$this->password = $password;
	}

	/**
	 * @return int
	 */
	public function getRoleRef(): int
	{
		return $this->role_ref;
	}

	/**
	 * @param int $role_ref
	 */
	public function setRoleRef(int $role_ref): void
	{
		$this->role_ref = $role_ref;
	}

	/**
	 * @return DateTime
	 */
	public function getCreatedAt(): DateTime
	{
		return $this->created_at;
	}

	/**
	 * @return DateTime
	 */
	public function getUpdatedAt(): DateTime
	{
		return $this->updated_at;
	}

	/**
	 * @return DateTime
	 */
	public function getDeletedAt(): DateTime
	{
		return $this->deleted_at;
	}


}