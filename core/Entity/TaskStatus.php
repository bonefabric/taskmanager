<?php

namespace Core\Entity;

use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity(repositoryClass="\Core\Repository\TaskRepository")
 * @Table(name="task_statuses")
 */
class TaskStatus
{

	/**
	 * @Id
	 * @GeneratedValue(strategy="AUTO")
	 * @Column(type="integer")
	 */
	protected int $id;

	/**
	 * @Column(type="string")
	 */
	protected string $title;

	/**
	 * @Column(type="string", length=7)
	 */
	protected string $color;

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

}