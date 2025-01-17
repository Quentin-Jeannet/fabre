<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(User $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(User $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    /**
     * Fonction qui retourne les utilisateurs de l'application
     */
    public function getByRoleUser(){
            return $this->createQueryBuilder('u')
            ->where('u.roles LIKE :role')
            ->andWhere('u.roles NOT LIKE :role2')
            ->orderBy('u.name', 'ASC')
            ->setParameter('role', '%ROLE_USER%')
            ->setParameter('role2', '%ROLE_ADMIN%')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * Fonction qui retourne les administrateurs de l'application
     */
    public function getByRoleAdmin(){
        return $this->createQueryBuilder('u')
        ->where('u.roles LIKE :role')
        ->andWhere('u.roles NOT LIKE :role2')
        ->orderBy('u.name', 'ASC')
        ->setParameter('role', '%ROLE_ADMIN%')
        ->setParameter('role2', '%ROLE_SUPERADMIN%')
        ->getQuery()
        ->getResult()
        ;
    }

      /**
     * Fonction qui retourne les administrateurs de l'application
     */
    public function getByRole($role){
        return $this->createQueryBuilder('u')
        ->where('u.roles LIKE :role')
        ->orderBy('u.name', 'ASC')
        ->setParameter('role', '%'.$role.'%')
        ->getQuery()
        ->getResult()
        ;
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
