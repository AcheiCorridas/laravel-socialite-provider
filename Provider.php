<?php

namespace SocialiteProviders\AcheiCorridas;

use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;

class Provider extends AbstractProvider
{
    /**
     * Unique Provider Identifier.
     */
    public const IDENTIFIER = 'ACHEICORRIDAS';

    const ISSUER = 'https://v2.acheicorridas.com.br';

    /**
     * {@inheritdoc}
     */
    protected $scopes = [
//        'identify',
//        'email',
    ];

    /**
     * {@inheritdoc}
     */
    protected $scopeSeparator = ' ';

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(
            config('services.acheicorridas.issuer', self::ISSUER) . '/oauth/authorize',
            $state
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return config('services.acheicorridas.issuer', self::ISSUER) . '/oauth/token';
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get(
            config('services.acheicorridas.issuer', self::ISSUER) . '/api/v2/user',
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                ],
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        $user = $user['data'];

        return (new User())->setRaw($user)->map([
            'id'       => $user['id'],
//            'nickname' => sprintf('%s#%s', $user['username'], $user['discriminator']),
            'name'     => $user['name'],
            'email'    => $user['email'] ?? null,
//            'avatar'   => $this->formatAvatar($user),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }

    public static function additionalConfigKeys()
    {
//        return ['allow_gif_avatars', 'avatar_default_extension'];
        return [];
    }
}
