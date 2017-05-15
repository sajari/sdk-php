<?php

namespace Sajari;

interface Opt
{
    /**
     * Apply configuration to the Client
     * @param Client $c Client to apply the configuration to.
     */
    public function Apply(Client $c);
}
