<h1 align="center">
  The Boring Translator
</h1>
<p align="center">This is a simple API that translate sentences to multiple languages</p>

### Prerequisites
 - **Linux**
 - [**Git**](https://www.atlassian.com/git/tutorials/install-git)
 - [**Sail**](https://laravel.com/docs/8.x/sail#installation) or [**Docker**](https://docs.docker.com/engine/installation/)

### Set up (using Sail)
1. Put your Google Cloud key file at this path: `~/.config/google_keyfile.json` 
2. Run `sail up`
3. Migrations & Seeds `sail artisan migrate --seed`
4. The previous command will also output two access tokens you can use to access the api.

You can now access the api here (by default): [http://localhost](http://localhost/api)

### Notes
* Translations are auto-updated from GoogleCloud, only after you:
    1. Created a key
    2. Created at least a translation for that key
* To export the translations call `POST /export`. You will get the link to download, while the export will happen in the background.
* I did not use Transformers on intention. It breaks the MVC a bit but project requirements does not make them mandatory at the moment.

### Documentation
You can view the full API documentation here: [here](https://documenter.getpostman.com/view/273833/TW6up91U)

<h2 align="center"> Thank you! </h2>
<h3> Provided by Victor Timoftii </h3>
