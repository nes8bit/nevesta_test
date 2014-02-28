<?php

$this->respond('GET', '/?', function ($request, $response, $service, $app) {
    $addTags = $request->param('add_tags', array());
    $excludeTags = $request->param('exclude_tags', array());

    $tagsRep = $app->em->getRepository("Tag");
    $tags = $tagsRep->findAll();

    $service->tags = $tags;

    $qb = $app->em->createQueryBuilder();

    if (!empty($addTags)) {
        $service->addTags = $tagsRep->findBy(array('id' => $addTags));
    }

    if (!empty($excludeTags)) {
        $service->excludeTags = $tagsRep->findBy(array('id' => $excludeTags));
    }
});
