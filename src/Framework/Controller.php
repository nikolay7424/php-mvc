<?php

declare(strict_types=1);

namespace Framework;

abstract class Controller
{
    protected Request $request;
    protected TemplateViewerInterface $viewer;

    protected Response $response;

    /**
     * @param Response $response
     */
    public function setResponse(Response $response): void
    {
        $this->response = $response;
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    /**
     * @param TemplateViewerInterface $viewer
     */
    public function setViewer(TemplateViewerInterface $viewer): void
    {
        $this->viewer = $viewer;
    }

    protected function view(string $template, array $data = []): Response
    {
        $this->response->setBody($this->viewer->render($template, $data));

        return $this->response;
    }

    protected function redirect(string $url): Response
    {
        $this->response->redirect($url);
        return $this->response;
    }
}