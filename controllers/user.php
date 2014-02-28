<?php

$this->respond('POST', '/user/?', function ($request, $response, $service, $app) {
    $service->startSession();
    $userId = (int) $request->param('user_id');
    $user = $app->em->find("User", $userId);
    if ($user) {
        $_SESSION['user_id'] = $userId;
    } else {
        unset($_SESSION['user_id']);
    }
    $response->redirect('/');
});

$this->respond('*', function ($request, $response, $service, $app) {
    $service->startSession();
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    if ($userId) {
        $service->user = $app->em->find("User", $userId);
    }
});
