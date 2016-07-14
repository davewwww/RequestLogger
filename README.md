RequestLogger
=============

:TODO:


Example phpunit:
----------------
after the $this->client->request(); call

```php
$path = $this->client->getKernel()->getLogDir() .'/requestlogs.log';
$storage = new LogDirStorage($path);
$storage->addEntry(ReqresFactory::create($this->client->getInternalRequest(), $this->client->getInternalResponse()));
```