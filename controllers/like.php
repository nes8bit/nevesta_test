<?php
use Klein\Exceptions\UnhandledException;

$this->respond('GET', '/[add|remove:action]/[i:photoId]', function ($request, $response, $service, $app) {
    if ($service->user !== null) {
        $photo = $app->em->find("Photo", $request->photoId);
        switch($request->action) {
        case 'add':
            $like = new Like(
                $service->user,
                $photo
            );
            try {
                $app->em->persist($like);
                $app->em->flush();
            } catch (Exception $e) {
                $service->flash('Cant vote twice');
            }
            break;
        case 'remove':
            $like = $app->em->getRepository('Like')->
                findOneBy(
                    array(
                        'photo' => $photo->id,
                        'user' => $service->user->id
                )
            );
            if ($like) {
                try {
                    $app->em->remove($like);
                    $app->em->flush();
                } catch (Exception $e) {
                    $service->flash('Error occured');
                }
            } else {
                $service->flash('Cannot unlike');
            }
            break;
        }
    }
    $response->redirect('/');
});
