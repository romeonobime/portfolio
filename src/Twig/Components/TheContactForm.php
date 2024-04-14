<?php

namespace App\Twig\Components;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

#[AsLiveComponent]
class TheContactForm extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp]
    public ?Contact $initialFormData = null;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(ContactType::class, $this->initialFormData);
    }

    #[LiveAction]
    public function contact(MailerInterface $mailer, EntityManagerInterface $entityManager)
    {
        $this->submitForm();

        /** @var Contact $contact */
        $contact = $this->getForm()->getData();
        $contactName = $contact->getName();
        $contactEmail = $contact->getEmail();
        $contactMessage = $contact->getMessage();

        $emailBody = "Email: $contactEmail\n\nMessage: $contactMessage";
        $emailSubject = 'You received a message from ' . $contactName . ' from your Portfolio';

        $email = (new Email())
            ->from('romeo.nobime@protonmail.com')
            ->to('romeo.nobime@protonmail.com')
            ->subject($emailSubject)
            ->text($emailBody);

        $mailer->send($email);

        $entityManager->persist($contact);
        $entityManager->flush();
    }
}
