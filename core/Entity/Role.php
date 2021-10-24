<?php declare(strict_types=1);

namespace Core\Entity;

use Core\Common\Doctrine\SoftDeletes;
use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity(repositoryClass="Core\Repository\RoleRepository")
 * @Table(name="roles")
 */
class Role
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

}