<?php

namespace Painel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Painel\Http\Controllers\Controller;
use Painel\Http\Requests;
use Painel\Http\Requests\NewsRequest;
use Painel\Repositories\EmailRepository;
use Painel\Repositories\NewsRepository;
use Painel\Services\EmailService;
use Painel\Services\NewsService;


class EmailController extends Controller
{
    private $emailRepository;
    private $emailService;
    private $newsRepository;
    private $newsService;

    public function __construct(EmailRepository $emailRepository, EmailService $emailService, NewsRepository $newsRepository, NewsService $newsService)
    {
        $this->emailRepository = $emailRepository;
        $this->emailService = $emailService;
        $this->newsRepository = $newsRepository;
        $this->newsService = $newsService;
    }

    public function successConfirmation()
    {
        return view('email.success-confirmation');
    }
    public function emailConfirmation($id)
    {
        $this->emailRepository->find($id);

        $this->emailService->updateStatusConfirmation($id);
        
        return redirect()->route('emails.success');
    }

    public function editStatusEmail($id)
    {
        $emails =  $this->emailRepository->find($id);

        return view('admin.email.edit', compact('emails'));
    }

    public function updateStatusEmail($id)
    {
        $this->emailRepository->update();
    }

    public function show()
    {
        $emails = $this->emailRepository->paginate(10);

        return view('admin.email.list', compact('emails'));
    }

    public function sendEmail(NewsRequest $request)
    {
        $return = $this->newsService->createNews($request->all());

        $this->emailService->sendService($return);

        return redirect()->route('admin.painel.news.list');
    }

    public function updateSendEmail(NewsRequest $request, $id)
    {
        $this->newsService->updateNews($request->all(), $id);

        $this->emailService->sendService($request->all());

        return redirect()->route('admin.painel.news.list');
    }

   

}
