<?php
/**
 * Date: 5/31/16
 *
 * @author Portey Vasil <portey@gmail.com>
 */

namespace Youshido\Silex\Provider;


use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Youshido\GraphQL\Execution\Processor;
use Youshido\GraphQL\Schema\AbstractSchema;

class GraphQLControllerProvider implements ControllerProviderInterface
{

    /** @var  AbstractSchema */
    protected $schema;

    public function __construct(AbstractSchema $schema)
    {
        $this->schema = $schema;
    }

    /**
     * @inheritdoc
     */
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];

        $controllers
            ->before(function (Request $request) {
                if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                    $data = json_decode($request->getContent(), true);
                    $request->request->replace(is_array($data) ? $data : []);
                }
            })
            ->match('/', function (Application $app, Request $request) {
                $query     = $request->get('query', '');
                $variables = $request->get('variables', []);

                $processor = new Processor($this->schema);
                $processor->processPayload($query, $variables);

                return $app->json($processor->getResponseData());
            });

        return $controllers;
    }
}
