<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Speciality;
use App\Security\EmailVerifier;
use Symfony\Component\Mime\Email;
use App\Form\RegistrationFormType;
use App\Security\AppAuthenticator;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @route("/testmail", name="test_mail")
     */
    public function testMail(MailerInterface $mailer){
        $email = (new TemplatedEmail())
        ->from('no-reply@nerlyfe-investigator-meeting.com')
        ->to('quentin@graphikchannel.com')
        ->subject('subject')
        ->htmlTemplate('mail/isAttentingMeeting.html.twig');
        $mailer->send($email);

        return $this->redirectToRoute('app_front');
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, AppAuthenticator $authenticator, EntityManagerInterface $entityManager, MailerInterface $mailer, TranslatorInterface $translator): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = 'Nerlyfe';
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $plainPassword
                )
            );
            $user->setIsVerified(true);
            if($form->getData()->getSpeciality()->getSlug() == "data_manager"){
                $user->setRoles(['ROLE_USER', 'ROLE_DATA_MANAGER']);
            }
            if($form->getData()->getSpeciality()->getSlug() == "physician"){
                $user->setRoles(['ROLE_USER', 'ROLE_PHYSICIAN']);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            $subject = $translator->trans('mail.subject');

            if($user->getIsAttendingMeeting() == true){
                $email = (new TemplatedEmail())
                ->from('hello@example.com')
                ->to($user->getEmail())
                ->subject($subject)
                ->htmlTemplate('mail/isAttentingMeeting.html.twig');
                $mailer->send($email);
            }else{
                $email = (new TemplatedEmail())
                ->from($this->getParameter('app.mailFrom'))
                ->to($user->getEmail())
                ->subject($subject)
                ->htmlTemplate('mail/isNotAttentingMeeting.html.twig');
                $mailer->send($email);
            }



            // generate a signed url and email it to the user
            // $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
            //     (new TemplatedEmail())
            //         ->from(new Address('no-reply@nerlyfe-investigator-meeting.com', 'no-reply'))
            //         ->to($user->getEmail())
            //         ->subject('Please Confirm your Email')
            //         ->htmlTemplate('registration/confirmation_email.html.twig')
            // );
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_front');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/speciality-slug/{id}", name="app_speciality_slug")
     */
    public function specialitySlug(Speciality $speciality){
        return New JsonResponse($speciality->getSlug());
    }

    /**
     * @Route("/verify/email", name="app_verify_email")
     */
    public function verifyUserEmail(Request $request, TranslatorInterface $translator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('app_register');
    }

}
