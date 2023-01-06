# langages

config/packages/translation.yaml

## choix de la langue en session
config/services.yaml

```yaml
parameters:
    # ici vos autres variables
    app.locales: [en, fr]
```
config/packages/twig.yaml
```yaml
twig:
    default_path: '%kernel.project_dir%/templates'
    debug: '%kernel.debug%'
    strict_variables: '%kernel.debug%'
    # On déclare ci-dessous le nom de la variable globale
    globals:
        locales: '%app.locales%'
```

## check des différents fichiers pouvant être modifiés dans la langue

```bash
php bin/console translation:extract --dump-messages fr
```
## appliquer les modifications

```bash
php bin/console translation:extract --force fr
```