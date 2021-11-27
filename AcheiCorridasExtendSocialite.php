<?php

namespace SocialiteProviders\AcheiCorridas;

use SocialiteProviders\Manager\SocialiteWasCalled;

class AcheiCorridasExtendSocialite
{
    /**
     * Register the provider.
     *
     * @param \SocialiteProviders\Manager\SocialiteWasCalled $socialiteWasCalled
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('acheicorridas', Provider::class);
    }
}
