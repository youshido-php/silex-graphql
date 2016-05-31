# silex-graphql

### This is a Silex controller provider to [PHP GraphQL Library](http://github.com/youshido/graphql/)

To add to your project GraphQL server, just add these lines to your php file: 

```php
$schema = new YourProjectSchema();
$app->mount('/graphql', new GraphQLControllerProvider($schema));
```

GraphQL schema definition documentation with examples you can find [here](http://github.com/youshido/graphql/)
