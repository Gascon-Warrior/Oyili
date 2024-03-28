<?php

namespace App\Repository;

use App\Entity\ClientCase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClientCase>
 *
 * @method ClientCase|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientCase|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientCase[]    findAll()
 * @method ClientCase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientCaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientCase::class);
    }

    /**
     * Trouve les cas clients associés au slug donné, incluant les informations telles que les vidéos promues, le logo, la tagline, 
     * les avis des clients, la présentation du projet, les médias associés (vidéos et images).
     *
     * @param string $slug Le slug du nom de l'entreprise du client.
     * @return array Un tableau contenant les informations des cas clients trouvés.
     */
    public function findClientCases($slug): array
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('c.logo', 'c.tagline', 'c.clientFeedback', 'cc.presentation', 'v.label', 'v.vimeoId', 'v.caption', 'p.alt', 'p.pictureFileName')
            ->from('App\Entity\ClientCase', 'cc')
            ->where("c.slug = '$slug'")
            ->join('cc.client', 'c')
            ->leftJoin('c.videos', 'v', 'WITH', 'v.isPromoted = 1')
            ->where('v.isPromoted = 1')
            ->leftJoin('c.pictures', 'p', 'WITH', 'p.isPromoted = 1')
            ->where('p.isPromoted = 1')
            ->getQuery()
            ->getResult();
    }

    /**
     * Trouve les videos de couverture, les photos des cas client, la presenation..
     *
     * @param sting $slug Le slug du nom de l'entreprise du client
     * @return array Un tableau contenant les informations des cas clients trouvés.
     */
    public function findVideoCoverAndPictures($slug): array
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('c.logo', 'c.tagline', 'c.workPresentation', 'p.pictureFileName', 'p.alt', 'v.vimeoId', 'cc.presentation')
            ->from('App\Entity\ClientCase', 'cc')
            ->join('cc.client', 'c')
            ->join('c.videos', 'v')
            ->join('c.pictures', 'p')
            ->where("c.slug = '$slug'")
            ->andWhere('v.is_cover = 1')
            ->getQuery()
            ->getResult();
    }
    //    /**
    //     * @return ClientCase[] Returns an array of ClientCase objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ClientCase
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
