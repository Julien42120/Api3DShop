<?php

namespace App\Security;

use App\Repository\UserRepository;
use Symfony\Bundle\SecurityBundle\Security\UserAuthenticator;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpClientKernel;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class AppAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    private UrlGeneratorInterface $urlGenerator;
    private UserRepository $userRepository;
    private UserAuthenticator $userAuthenticator;
    private HttpClientInterface $httpClient;

    public function __construct(UrlGeneratorInterface $urlGenerator, UserRepository $userRepository, UserAuthenticatorInterface $userAuthenticator, HttpClientInterface $httpClient)
    {
        $this->urlGenerator = $urlGenerator;
        $this->userRepository = $userRepository;
        $this->userAuthenticator = $userAuthenticator;
        $this->httpClient = $httpClient;
    }

    public function authenticate(Request $request): Passport
    {
        $client = HttpClient::create();
        $email = $request->request->get('email', '');
        $userRepository = $this->userRepository;
        $request->getSession()->set(Security::LAST_USERNAME, $email);
        // $response = $client->request(
        //     'POST',
        //     'https://3dshopapi.fr' . $this->urlGenerator->generate('authentication_token'),
        //     [
        //         'body' => ['email' => $email, 'password' => $request->request->get('password')],
        //     ]
        // );
        new RedirectResponse($this->urlGenerator->generate('authentication_token'), 301, [
            'method' => 'POST'
        ]);
        // dd($response->toArray());
        $badge =  new UserBadge($email, function ($userIdentifier) use ($email, $userRepository) {
            return $userRepository->findOneBy(['email' => $userIdentifier]);
        });
        $passport =  new Passport(
            $badge,
            new PasswordCredentials($request->request->get('password', '')),
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
            ]
        );
        return $passport;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        // For example:
        return new RedirectResponse($this->urlGenerator->generate('admin'));
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
