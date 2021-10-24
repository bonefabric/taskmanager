<?php declare(strict_types=1);

namespace Core\Entity;

use Core\Common\Doctrine\SoftDeletes;
use DateTimeImmutable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use JsonSerializable;

/**
 * @Entity(repositoryClass="Core\Repository\RoleRepository")
 * @Table(name="roles")
 */
class Role implements JsonSerializable
{
	use SoftDeletes;

	/**
	 * @Id
	 * @GeneratedValue(strategy="AUTO")
	 * @Column(type="integer")
	 */
	protected int $id;

	/**
	 * @Column(type="string", length=50, unique=true)
	 */
	protected string $name;

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
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
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
	 * @return ?DateTimeImmutable
	 */
	public function getDeletedAt(): ?DateTimeImmutable
	{
		return $this->deleted_at ?? null;
	}

	/**
	 * @return array
	 */
	public function jsonSerialize(): array
	{
		return [
			'id' => $this->getId(),
			'name' => $this->getName(),
			'created_at' => $this->getCreatedAt(),
			'updated_at' => $this->getUpdatedAt(),
			'deleted_at' => $this->getDeletedAt(),
		];
	}
}