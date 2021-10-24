<?php declare(strict_types=1);

namespace Core\Entity;

use Core\Common\Doctrine\SoftDeletes;
use DateTimeImmutable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
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
	 * @OneToOne(targetEntity="Role")
	 * @JoinColumn(name="role_ref", referencedColumnName="id")
	 */
	protected Role $role;

	/**
	 * @Column(type="datetime_immutable")
	 */
	protected DateTimeImmutable $created_at;

	/**
	 * @Column(type="datetime_immutable")
	 */
	protected DateTimeImmutable $updated_at;

	/**
	 * @Column(type="datetime_immutable", nullable=true)
	 */
	protected DateTimeImmutable $deleted_at;

	public function __construct()
	{
		$this->created_at = new DateTimeImmutable();
		$this->updated_at = new DateTimeImmutable();
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
	 * @return Role
	 */
	public function getRole(): Role
	{
		return $this->role;
	}

	/**
	 * @param Role $role
	 */
	public function setRole(Role $role): void
	{
		$this->role = $role;
	}

	/**
	 * @return DateTimeImmutable
	 */
	public function getCreatedAt(): DateTimeImmutable
	{
		return $this->created_at;
	}

	/**
	 * @return DateTimeImmutable
	 */
	public function getUpdatedAt(): DateTimeImmutable
	{
		return $this->updated_at;
	}

	/**
	 * @return DateTimeImmutable
	 */
	public function getDeletedAt(): DateTimeImmutable
	{
		return $this->deleted_at;
	}

}