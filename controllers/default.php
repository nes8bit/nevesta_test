<?php

use \Doctrine\ORM\Tools\Pagination\Paginator;
use \Doctrine\ORM\Query\Expr;

$this->respond('GET', '/?', function ($request, $response, $service, $app) {
    $service->layout('views/layout.phtml');
    $itemsPerPage = 20;

    // Tags params
    $addTags = $request->param('add_tags', array());
    $excludeTags = $request->param('exclude_tags', array());
    $currentPage = $request->param('page', 1);
    $order = $request->param('order', 'created');

    $qb = $app->em->createQueryBuilder();

    $qb->select('p')
        ->from('Photo', 'p')
        ->innerJoin('p.tags', 'tags')
        ->groupBy('p.id');

    if (!empty($addTags)) {
        $qb->andWhere(
            $qb->expr()->in(
                'tags.id',
                $addTags
            )
        );
        $qb->having(
            $qb->expr()->eq(
                $qb->expr()->countDistinct('tags.id'),
                count($addTags)
            )
        );
    }

    if (!empty($excludeTags)) {
        $excludeExpr = $qb->expr()->in('exclude.id', $excludeTags);
        $qb->leftJoin('p.excludedTags', 'exclude', 'WITH', $excludeExpr);
        $qb->andHaving(
            $qb->expr()->eq(
                $qb->expr()->countDistinct('exclude.id'),
                0
            )
        );
    }

    switch ($order) {
        case 'popular':
            $qb->orderBy('p.likeCount', 'DESC');
            break;
        case 'created':
            $qb->orderBy('p.createdAt', 'DESC');
            break;
    }

    //Pagination
    $qb->setFirstResult(($currentPage - 1) * $itemsPerPage);
    $qb->setMaxResults($itemsPerPage);
    $query = $qb->getQuery();

    $paginator = new Paginator($query, $fetchJoinCollection = false);
    $pages = ceil(count($paginator) / $itemsPerPage);

    // Render
    $service->render(
        'views/gallery.phtml',
        array(
            'photos' => $paginator,
            'currentPage' => $currentPage,
            'pages'  => $pages,
            'title'  => 'Галлерея фотографий',
        )
    );
});
