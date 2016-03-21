<?php

namespace Okta;

use GuzzleHttp\Client as GuzzleClient;

use Okta\Resource\App;
use Okta\Resource\Authentication;
use Okta\Resource\Event;
use Okta\Resource\Factor;
use Okta\Resource\Group;
use Okta\Resource\Role;
use Okta\Resource\Schema;
use Okta\Resource\Session;
use Okta\Resource\User;

/**
 * Okta\Client class
 *
 * @author Chris Kankiewicz <ckankiewicz@io.com>
 */
class Client {

    /**
     * @var object Instance of GuzzleHttp\Client object
     */
    protected $client;

    /**
     * @var object Instance of Okta\Resource\App object
     */
    public $app;

    /**
     * @var object Instance of Okta\Resource\Authentication object
     */
    public $auth;

    /**
     * @var object Instance of Okta\Resource\Event object
     */
    public $event;

    /**
     * @var object Instance of Okta\Resource\Factor object
     */
    public $factor;

    /**
     * @var object Instance of Okta\Resource\Group object
     */
    public $group;

    /**
     * @var object Instance of Okta\Resource\Role object
     */
    public $role;

    /**
     * @var object Instance of Okta\Resource\Schema object
     */
    public $schema;

    /**
     * @var object Instance of Okta\Resource\Session object
     */
    public $session;

    /**
     * @var object Instance of Okta\Resource\User object
     */
    public $user;

    /**
     * Okta\Client constructor method
     *
     * @param string $org       Your organization's subdomain (tenant)
     * @param string $key       Your Okta API key
     * @param array  $headers   Array of headers in header_name => value format
     * @param bool   $bootstrap If true, bootstrap Okta resource properties
     */
    public function __construct($org, $key, array $headers = [], $bootstrap = true) {

        $this->client = new GuzzleClient ([
            'base_uri'   => 'https://' . $org . '.okta.com/api/v1/',
            'exceptions' => false,
            'headers'    => array_merge([
                'Authorization' => 'SSWS ' . $key,
                'Content-Type'  => 'application/json'
            ], $headers)
        ]);

        if ($bootstrap) $this->bootstrap();

    }

    /**
     * Bootstraps all Okta\Resources for easy access
     *
     * @return object This Okta\Client object
     */
    protected function bootstrap() {

        $this->app     = new App($this);
        $this->auth    = new Authentication($this);
        $this->event   = new Event($this);
        $this->factor  = new Factor($this);
        $this->group   = new Group($this);
        $this->role    = new Role($this);
        $this->schema  = new Schema($this);
        $this->session = new Session($this);
        $this->user    = new User($this);

        return $this;

    }

    /**
     * Return $this->client property
     *
     * @return GuzzleClient GuzzleHttp\Client object
     */
    public function client() {
        return $this->client;
    }

}
